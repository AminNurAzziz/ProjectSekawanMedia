<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    use HasFactory;
    protected $primaryKey = 'HistoryID';
    protected $fillable = ['BookingID', 'ReturnDate', 'LastOdometerReading', 'FuelUsed', 'BookingStatus'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'BookingID', 'BookingID');
    }
}
