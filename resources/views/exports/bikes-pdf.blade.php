<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bikes Export - {{ date('Y-m-d H:i:s') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4F46E5;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-available {
            color: green;
            font-weight: bold;
        }
        .status-rented {
            color: red;
            font-weight: bold;
        }
        .status-maintenance {
            color: orange;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h1>Bike Rental Management System</h1>
    <h2 style="text-align: center; color: #666; margin-bottom: 20px;">Bikes Export - {{ date('F d, Y H:i:s') }}</h2>
    
    @if(request('search') || request('category'))
        <div style="margin-bottom: 15px; padding: 10px; background-color: #f0f0f0; border-radius: 5px;">
            <strong>Filters Applied:</strong>
            @if(request('search'))
                <span>Search: "{{ request('search') }}"</span>
            @endif
            @if(request('category'))
                <span>Category: {{ \App\Models\BikeCategory::find(request('category'))->name ?? 'N/A' }}</span>
            @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Bike Name</th>
                <th>Model</th>
                <th>Price/Day</th>
                <th>Status</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bikes as $bike)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bike->bike_name }}</td>
                <td>{{ $bike->model ?? 'N/A' }}</td>
                <td>${{ number_format($bike->price_per_day, 2) }}</td>
                <td class="status-{{ $bike->status }}">
                    {{ ucfirst($bike->status) }}
                </td>
                <td>{{ optional($bike->bikeCategory)->name ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">
                    No bikes found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Records: {{ $bikes->count() }}</p>
        <p>Generated on {{ date('F d, Y \a\t H:i:s') }}</p>
    </div>
</body>
</html>
