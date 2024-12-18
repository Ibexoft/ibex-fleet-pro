<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['fuel_type', 'vehicle_type', 'owner', 'vehicle_status', 'sell_status', 'vehicle_registration_no', 'vehicle_engine_no', 'vehicle_making_company', 'vehicle_model', 'vehicle_year', 'vehicle_color', 'vin', 'biller_code', 'reference_no', 'bepay_detail', 'added_by', 'is_deleted', 'is_active', 'admin_fee'];
    protected $table = 'vehicle';

    public function booking()
    {
        return $this->hasMany(Booking::class, 'vehicle_reg_id', 'vehicle_id');
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'vehicle_reg_id', 'vehicle_id');
    }

    public function vehicle_owner()
    {
        return $this->belongsTo(Customer::class, 'owner', 'customer_id');
    }

    // Scope to filter by name
    public function scopeFilterByName($query, $name)
    {
        if ($name) {
            $terms = explode(' ', $name);

            return $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($q) use ($term) {
                        $q->where('vehicle_model', 'like', '%' . $term . '%')
                            ->orWhere('brands.name', 'like', '%' . $term . '%');
                    });
                }
            });
        }
        return $query;
    }

    // Scope to filter by date range
    public function scopeFilterByDateRange($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereDoesntHave('booking', function ($query) use ($startDate, $endDate) {
                $query->where('is_deleted', false)
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_date', [$startDate, $endDate])
                            ->orWhereBetween('end_date', [$startDate, $endDate])
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                $query->where('start_date', '<=', $startDate)
                                    ->where('end_date', '>=', $endDate);
                            });
                    });
            })
                ->whereDoesntHave('maintenance', function ($query) use ($startDate, $endDate) {
                    $query->where('is_deleted', false)
                        ->whereBetween('maintenance_date', [$startDate, $endDate]);
                });
        }
        return $query;
    }


    // Scope to filter by colors
    public function scopeFilterByColors($query, $colors)
    {
        if ($colors && is_array($colors)) {
            return $query->whereIn('vehicle_color', $colors);
        }
        return $query;
    }

    // Scope to filter by vehicle type

    public function scopeFilterByVehicleTypes($query, $vehicleTypes)
    {
        if ($vehicleTypes && is_array($vehicleTypes)) {
            return $query->whereIn('vehicle_type', $vehicleTypes);
        }
        return $query;
    }

    // Scope to filter by fuel type

    public function scopeFilterByFuelTypes($query, $fuelTypes)
    {
        if ($fuelTypes && is_array($fuelTypes)) {
            return $query->whereIn('fuel_type', $fuelTypes);
        }
        return $query;
    }

    // Scope to exclude deleted vehicles
    public function scopeExcludeDeleted($query)
    {
        return $query->where('is_deleted', false);
    }
}
