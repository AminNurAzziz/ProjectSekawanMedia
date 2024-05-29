<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $primaryKey = 'VehicleID';
    protected $fillable = ['VehicleID', 'VehicleModel', 'VehicleType', 'VehicleStatus', 'FuelConsumptionPerKM', 'ServiceIntervalKM', 'LastKM', 'Ownership'];
}
