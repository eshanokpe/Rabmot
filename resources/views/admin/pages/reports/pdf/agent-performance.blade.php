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
    <h1>Agent Performance Report</h1>
    <p>{{ $from->format('F j, Y') }} — {{ $to->format('F j, Y') }}</p>

    <table>
        <thead>
            <tr><th>Agent</th><th>Email</th><th>Orders</th><th>Revenue</th><th>Referrals</th><th>Referral Commission</th></tr>
        </thead>
        <tbody>
            @foreach ($allAgents as $row)
                <tr>
                    <td>{{ $row->agent->fullname }}</td>
                    <td>{{ $row->agent->email }}</td>
                    <td>{{ $row->orders }}</td>
                    <td>₦{{ number_format($row->revenue, 2) }}</td>
                    <td>{{ $row->referrals }}</td>
                    <td>₦{{ number_format($row->referralCommission, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
