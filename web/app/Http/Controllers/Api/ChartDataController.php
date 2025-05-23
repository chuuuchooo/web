<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FamilyPlanning;
use App\Models\ChildProfile;
use App\Models\Vaccination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartDataController extends Controller
{
    /**
     * Get Family Planning statistics
     */
    public function getFamilyPlanningStats()
    {
        // Monthly records
        $monthlyRecords = FamilyPlanning::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        // If no records, create empty data structure
        if ($monthlyRecords->isEmpty()) {
            $monthlyRecords = collect([
                (object)[
                    'month' => Carbon::now()->month,
                    'year' => Carbon::now()->year,
                    'count' => 0
                ]
            ]);
        }

        // FP Methods used
        $fpMethods = FamilyPlanning::select('fp_method', DB::raw('COUNT(*) as count'))
            ->groupBy('fp_method')
            ->get();

        // If no methods, create empty data structure
        if ($fpMethods->isEmpty()) {
            $fpMethods = collect([
                (object)[
                    'fp_method' => 'No Data',
                    'count' => 0
                ]
            ]);
        }

        // WRA vs NWRA (15-49)
        $wraCount = FamilyPlanning::whereRaw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 15 AND 49')
            ->count();
        $nwraCount = FamilyPlanning::whereRaw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) NOT BETWEEN 15 AND 49')
            ->count();

        // Status of records
        $statusCounts = [
            'Complete' => 0,
            'Partially Complete' => 0,
            'Incomplete' => 0
        ];

        // Get all records and count their status
        $records = FamilyPlanning::all();
        foreach ($records as $record) {
            $status = $record->getCompletionStatus();
            $statusCounts[$status]++;
        }

        return response()->json([
            'monthlyRecords' => $monthlyRecords,
            'fpMethods' => $fpMethods,
            'wraStats' => [
                'WRA' => $wraCount,
                'NWRA' => $nwraCount
            ],
            'statusCounts' => $statusCounts
        ]);
    }

    /**
     * Get Immunization statistics
     */
    public function getImmunizationStats()
    {
        // Monthly child records
        $monthlyRecords = ChildProfile::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        // If no records, create empty data structure
        if ($monthlyRecords->isEmpty()) {
            $monthlyRecords = collect([
                (object)[
                    'month' => Carbon::now()->month,
                    'year' => Carbon::now()->year,
                    'count' => 0
                ]
            ]);
        }

        // Vaccines given
        $vaccinesGiven = Vaccination::select('vaccine_type', 'status', DB::raw('COUNT(*) as count'))
            ->groupBy('vaccine_type', 'status')
            ->get();

        // If no vaccines, create empty data structure
        if ($vaccinesGiven->isEmpty()) {
            $vaccinesGiven = collect([
                (object)[
                    'vaccine_type' => 'No Data',
                    'status' => 'Not Completed',
                    'count' => 0
                ]
            ]);
        }

        // Records per purok
        $purokRecords = ChildProfile::select('purok', DB::raw('COUNT(*) as count'))
            ->groupBy('purok')
            ->get();

        // If no purok records, create empty data structure
        if ($purokRecords->isEmpty()) {
            $purokRecords = collect([
                (object)[
                    'purok' => 'No Data',
                    'count' => 0
                ]
            ]);
        }

        return response()->json([
            'monthlyRecords' => $monthlyRecords,
            'vaccinesGiven' => $vaccinesGiven,
            'purokRecords' => $purokRecords
        ]);
    }
} 