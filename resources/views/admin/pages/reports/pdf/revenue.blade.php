<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 4px 6px; text-align: left; }
        .summary td { border: none; padding: 2px 6px; }
    </style>
</head>
<body>
    <h1>Revenue Report</h1>
    <p>{{ $from->format('F j, Y') }} — {{ $to->format('F j, Y') }}</p>

    <table class="summary">
        <tr><td><strong>Total Revenue:</strong></td><td>₦{{ number_format($totalRevenue, 2) }}</td></tr>
        <tr><td><strong>Transactions:</strong></td><td>{{ number_format($transactionCount) }}</td></tr>
        <tr><td><strong>Average Transaction:</strong></td><td>₦{{ number_format($averageTransaction, 2) }}</td></tr>
    </table>

    <table>
        <thead>
            <tr><th>Order No</th><th>Amount</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->orderNo }}</td>
                    <td>₦{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
