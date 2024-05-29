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


    public static function getPeriodicReportForYear()
    {
        $startDate = now()->subYear(); // Mengurangi satu tahun dari tanggal sekarang
        $endDate = now(); // Tanggal sekarang

        return self::with('booking')
            ->whereBetween('ReturnDate', [$startDate, $endDate])
            ->orderBy('ReturnDate', 'desc')
            ->get();
    }

    public static function getPeriodicReportForMonth()
    {
        // Menghitung tanggal awal dan akhir tahun sekarang
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();

        // Mengambil data laporan penggunaan kendaraan untuk tahun ini
        return self::selectRaw('YEAR(ReturnDate) as year, MONTH(ReturnDate) as month, COUNT(*) as total')
            ->whereBetween('ReturnDate', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    }
}
