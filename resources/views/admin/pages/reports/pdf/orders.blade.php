<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 4px 6px; text-align: left; }
    </style>
</head>
<body>
    <h1>Order Report</h1>
    <p>{{ $from->format('F j, Y') }} — {{ $to->format('F j, Y') }}</p>
    <p><strong>Total Orders:</strong> {{ number_format($totalOrders) }}</p>

    <table>
        <thead>
            <tr><th>Process Number</th><th>Type</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->process_number }}</td>
                    <td>{{ $order->process_type }}</td>
                    <td>{{ \App\Http\Controllers\Admin\AdminReportsController::ORDER_STATUS_LABELS[$order->status] ?? $order->status }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
