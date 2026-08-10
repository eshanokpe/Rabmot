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
    <h1>Referral Report</h1>
    <p>{{ $from->format('F j, Y') }} — {{ $to->format('F j, Y') }}</p>

    <table class="summary">
        <tr><td><strong>Total Referrals:</strong></td><td>{{ number_format($totalReferrals) }}</td></tr>
        <tr><td><strong>Total Referral Commission:</strong></td><td>₦{{ number_format($totalReferralCommission, 2) }}</td></tr>
    </table>

    <table>
        <thead>
            <tr><th>Agent</th><th>Email</th><th>Referrals</th><th>Referral Commission</th></tr>
        </thead>
        <tbody>
            @foreach ($referrers as $row)
                <tr>
                    <td>{{ $row->agent->fullname }}</td>
                    <td>{{ $row->agent->email }}</td>
                    <td>{{ $row->referrals }}</td>
                    <td>₦{{ number_format($row->referralCommission, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
