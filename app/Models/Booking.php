<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'BookingID';
    protected $fillable = ['BookerName', 'VehicleID', 'DriverID', 'BookingStatus', 'BookingDate', 'BranchManagerApproval', 'HeadOfficeManagerApproval', 'BranchManagerID', 'HeadOfficeManagerID'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'VehicleID', 'VehicleID');
    }

    public function driver()
    {
        return $this->belongsTo(CompanyDriver::class, 'DriverID', 'DriverID');
    }
}
