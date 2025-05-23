<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FamilyPlanning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_lot_no',
        'purok',
        'barangay',
        'city',
        'last_name',
        'first_name',
        'middle_name',
        'birthdate',
        'intended_fp_method',
        'date_served',
        'fp_method',
        'provider_category',
        'provider_name',
        'mode_of_service_delivery',
        'remarks',
        'date_counselled_pregnant',
        'other_notes',
        'date_encoded',
        'created_by_user_id'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'date_served' => 'date',
        'date_counselled_pregnant' => 'date',
        'date_encoded' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
    
    public function edits()
    {
        return $this->hasMany(FamilyPlanningEdit::class);
    }

    public function isWRA()
    {
        if (!$this->birthdate) {
            return false;
        }
        $age = $this->birthdate->age;
        return $age >= 15 && $age <= 49;
    }

    public function getCompletionStatus()
    {
        $requiredFields = [
            'last_name',
            'first_name',
            'house_lot_no',
            'purok',
            'barangay',
            'city',
            'birthdate'
        ];

        $optionalFields = [
            'middle_name',
            'intended_fp_method',
            'date_served',
            'fp_method',
            'provider_category',
            'provider_name',
            'mode_of_service_delivery',
            'remarks',
            'date_counselled_pregnant',
            'other_notes',
            'date_encoded'
        ];

        $requiredComplete = true;
        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                $requiredComplete = false;
                break;
            }
        }

        $optionalComplete = true;
        foreach ($optionalFields as $field) {
            if (empty($this->$field)) {
                $optionalComplete = false;
                break;
            }
        }

        if ($requiredComplete && $optionalComplete) {
            return 'Complete';
        } elseif ($requiredComplete) {
            return 'Partially Complete';
        } else {
            return 'Incomplete';
        }
    }

    public function scopeFilterByBarangay($query, $barangay)
    {
        return $barangay ? $query->where('barangay', $barangay) : $query;
    }

    public function scopeFilterByFPMethod($query, $method)
    {
        return $method ? $query->where('fp_method', $method) : $query;
    }

    public function scopeFilterByProvider($query, $provider)
    {
        return $provider ? $query->where('provider_name', $provider) : $query;
    }

    public function scopeFilterByRemarks($query, $remarks)
    {
        return $remarks ? $query->where('remarks', $remarks) : $query;
    }

    public function scopeFilterByDateRange($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('date_encoded', [$startDate, $endDate]);
        }
        return $query;
    }
    
    public function scopeFilterByPurok($query, $purok)
    {
        return $purok ? $query->where('purok', $purok) : $query;
    }
    
    public function scopeFilterByIntendedMethod($query, $method)
    {
        return $method ? $query->where('intended_fp_method', $method) : $query;
    }
    
    public function scopeFilterByNameSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%");
            });
        }
        return $query;
    }
}
