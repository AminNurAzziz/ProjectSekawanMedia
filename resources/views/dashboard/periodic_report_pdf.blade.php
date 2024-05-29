<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periodic Vehicle Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Periodic Vehicle Report</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Vehicle</th>
                <th>Return Date</th>
                <th>Last Odometer (KM)</th>
                <th>Fuel Used (Liters)</th>
                <th>Booking Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periodicReport as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report->booking->vehicle->VehicleModel}} - {{ $report->booking->vehicle->VehicleType }} - {{ $report->booking->vehicle->VehicleID }}</td>
                <td>{{ $report->ReturnDate }}</td>
                <td>{{ $report->LastOdometerReading }}</td>
                <td>{{ $report->FuelUsed }}</td>
                <td>{{ $report->BookingStatus }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
