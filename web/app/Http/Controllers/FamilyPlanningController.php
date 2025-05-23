<?php

namespace App\Http\Controllers;

use App\Models\FamilyPlanning;
use App\Models\FamilyPlanningEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyPlanningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = FamilyPlanning::query();

        // Apply filters
        if ($request->filled('barangay')) {
            $query->filterByBarangay($request->barangay);
        }

        if ($request->filled('purok')) {
            $query->filterByPurok($request->purok);
        }

        if ($request->filled('fp_method')) {
            $query->filterByFPMethod($request->fp_method);
        }

        if ($request->filled('intended_method')) {
            $query->filterByIntendedMethod($request->intended_method);
        }

        if ($request->filled('provider')) {
            $query->filterByProvider($request->provider);
        }

        if ($request->filled('remarks')) {
            $query->filterByRemarks($request->remarks);
        }

        if ($request->filled(['start_date', 'end_date'])) {
            $query->filterByDateRange($request->start_date, $request->end_date);
        }
        
        if ($request->filled('search')) {
            $query->filterByNameSearch($request->search);
        }

        // Get unique values for filter dropdowns
        $barangays = FamilyPlanning::distinct()->pluck('barangay')->sort();
        $puroks = FamilyPlanning::distinct()->pluck('purok')->sort();
        $fpMethods = FamilyPlanning::distinct()->pluck('fp_method')->sort();
        $intendedMethods = FamilyPlanning::distinct()->pluck('intended_method')->sort();
        $providers = FamilyPlanning::distinct()->pluck('provider_name')->sort();
        $remarks = FamilyPlanning::distinct()->pluck('remarks')->sort();

        $familyPlannings = $query->latest()->paginate(10);

        return view('family-planning.index', compact(
            'familyPlannings', 
            'barangays', 
            'puroks',
            'fpMethods', 
            'intendedMethods',
            'providers', 
            'remarks'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('family-planning.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'house_lot_no' => 'required|string|max:255',
            'purok' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'intended_method' => 'required|string|max:255',
            'date_served' => 'required|date',
            'fp_method' => 'required|string|max:255',
            'provider_category' => 'required|string|max:255',
            'provider_name' => 'required|string|max:255',
            'mode_of_service_delivery' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
            'date_counselled_pregnant' => 'nullable|date',
            'other_notes' => 'nullable|string',
            'date_encoded' => 'required|date',
        ]);

        $validated['user_id'] = auth()->id();
        // Record creator
        $validated['created_by_user_id'] = auth()->id();

        FamilyPlanning::create($validated);

        return redirect()->route('family-planning.index')
            ->with('success', 'Family planning record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamilyPlanning  $familyPlanning
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyPlanning $familyPlanning)
    {
        return view('family-planning.show', compact('familyPlanning'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilyPlanning  $familyPlanning
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyPlanning $familyPlanning)
    {
        return view('family-planning.edit', compact('familyPlanning'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilyPlanning  $familyPlanning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyPlanning $familyPlanning)
    {
        $validated = $request->validate([
            'house_lot_no' => 'required|string|max:255',
            'purok' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'intended_method' => 'required|string|max:255',
            'date_served' => 'required|date',
            'fp_method' => 'required|string|max:255',
            'provider_category' => 'required|string|max:255',
            'provider_name' => 'required|string|max:255',
            'mode_of_service_delivery' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
            'date_counselled_pregnant' => 'nullable|date',
            'other_notes' => 'nullable|string',
            'date_encoded' => 'required|date',
        ]);

        // Track changes
        $changes = [];
        foreach ($validated as $key => $value) {
            if ($familyPlanning->$key != $value) {
                $changes[$key] = [
                    'from' => $familyPlanning->$key,
                    'to' => $value
                ];
            }
        }
        
        // Only create edit record if changes were made
        if (!empty($changes)) {
            // Create edit record
            FamilyPlanningEdit::create([
                'family_planning_id' => $familyPlanning->id,
                'user_id' => auth()->id(),
                'changes' => $changes,
            ]);
        }

        $familyPlanning->update($validated);

        return redirect()->route('family-planning.index')
            ->with('success', 'Family planning record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilyPlanning  $familyPlanning
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyPlanning $familyPlanning)
    {
        $familyPlanning->delete();

        return redirect()->route('family-planning.index')
            ->with('success', 'Family planning record deleted successfully.');
    }
}
