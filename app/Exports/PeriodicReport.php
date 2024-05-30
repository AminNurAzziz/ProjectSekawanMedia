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
            'No',
            'Booking ID',
            'Return Date',
            'Last Odometer',
            'Fuel Used',
            'Booking Status',
            'Created At',
            'Updated At',
        ];
    }
}
