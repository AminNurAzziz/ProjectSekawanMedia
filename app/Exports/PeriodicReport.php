<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\BookingHistory;

class PeriodicReport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BookingHistory::getPeriodicReportForYear();
    }

    public function headings(): array
    {
        return [
            'Booking ID',
            'Return Date',
            'Last Odometer Reading',
            'Fuel Used',
            'Booking Status',
            'Vehicle ID',
            'Driver ID',
            'Branch ID',
            'Created At',
            'Updated At',
        ];
    }
}
