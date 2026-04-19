<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Vehicle Document Expiry Notice</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #F3F4F6; color: #111827; }
        .wrapper { max-width: 620px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background-color: {{ $urgencyColor }}; padding: 36px 40px; text-align: center; }
        .header h1 { color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: 0.3px; }
        .header p  { color: rgba(255,255,255,0.88); font-size: 13px; margin-top: 6px; }
        .badge { display: inline-block; background: rgba(255,255,255,0.22); color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; padding: 4px 14px; border-radius: 50px; margin-bottom: 12px; }
        .body  { padding: 36px 40px; }
        .greeting { font-size: 16px; margin-bottom: 18px; }
        .greeting span { font-weight: 600; }
        .info-box { background: #F9FAFB; border: 1px solid #E5E7EB; border-left: 4px solid {{ $urgencyColor }}; border-radius: 8px; padding: 20px 24px; margin: 24px 0; }
        .info-box .row { display: flex; justify-content: space-between; padding: 7px 0; border-bottom: 1px solid #E5E7EB; font-size: 14px; }
        .info-box .row:last-child { border-bottom: none; }
        .info-box .row .label { color: #6B7280; font-weight: 500; }
        .info-box .row .value { font-weight: 600; color: #111827; text-align: right; }
        .countdown { text-align: center; margin: 28px 0; }
        .countdown .days-num { font-size: 56px; font-weight: 800; color: {{ $urgencyColor }}; line-height: 1; }
        .countdown .days-label { font-size: 14px; color: #6B7280; margin-top: 4px; text-transform: uppercase; letter-spacing: 1px; }
        .cta { text-align: center; margin: 28px 0 20px; }
        .cta a { display: inline-block; background-color: {{ $urgencyColor }}; color: #ffffff; text-decoration: none; padding: 14px 36px; border-radius: 8px; font-weight: 600; font-size: 15px; letter-spacing: 0.3px; }
        .tips { background: #EFF6FF; border-radius: 8px; padding: 18px 22px; margin-top: 24px; font-size: 13.5px; color: #1E40AF; }
        .tips strong { display: block; margin-bottom: 8px; font-size: 14px; }
        .tips ul { padding-left: 18px; }
        .tips ul li { margin-bottom: 5px; }
        .footer { background: #F9FAFB; border-top: 1px solid #E5E7EB; padding: 24px 40px; text-align: center; font-size: 12px; color: #9CA3AF; }
        .footer a { color: #6B7280; text-decoration: underline; }
    </style>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <div class="header">
        <div class="badge">{{ $urgencyText }}</div>
        <h1>Vehicle Document Expiry Alert</h1>
        <p>{{ config('app.name') }} — Automated Notification</p>
    </div>

    <!-- Body -->
    <div class="body">

        <p class="greeting">Hello, <span>{{ $user->name ?? $user->fullname ?? 'Valued Customer' }}</span> 👋</p>

        <p style="font-size:15px; line-height:1.7; color:#374151;">
            This is an official reminder that one of your registered vehicle documents
            is approaching its expiry date. Please take action to avoid fines, penalties,
            or being flagged during road checks.
        </p>

        <!-- Countdown -->
        <div class="countdown">
            <div class="days-num">{{ $daysRemaining }}</div>
            <div class="days-label">Day{{ $daysRemaining > 1 ? 's' : '' }} Remaining</div>
        </div>

        <!-- Vehicle & Document Info -->
        <div class="info-box">
            <div class="row">
                <span class="label">Document</span>
                <span class="value">{{ $documentLabel }}</span>
            </div>
            <div class="row">
                <span class="label">Plate Number</span>
                <span class="value">{{ strtoupper($vehicle->platenumber) }}</span>
            </div>
            @if($vehicle->vehiclemake)
            <div class="row">
                <span class="label">Vehicle Make</span>
                <span class="value">{{ $vehicle->vehiclemake }}</span>
            </div>
            @endif
            <div class="row">
                <span class="label">Expiry Date</span>
                <span class="value" style="color:{{ $urgencyColor }};">{{ $expiryDate->format('d M, Y') }}</span>
            </div>
        </div>

        <!-- CTA -->
        <div class="cta">
            <a href="{{ route('home.index') }}">Renew Now on My Dashboard →</a>
        </div>

        <!-- Tips -->
        <div class="tips">
            <strong>💡 What to do next:</strong>
            <ul>
                <li>Log in to your dashboard and navigate to your vehicles.</li>
                <li>Click <strong>Edit Vehicle</strong> to initiate a renewal request.</li>
                <li>Our team will process your renewal promptly once submitted.</li>
                <li>Contact support if you need assistance with any documents.</li>
            </ul>
        </div>

    </div><!-- /body -->

    <!-- Footer -->
    <div class="footer">
        <p>This is an automated message from <strong>{{ config('app.name') }}</strong>. Please do not reply to this email.</p>
        <p style="margin-top:8px;">
            If you believe you received this in error, 
            <a href="mailto:{{ config('mail.from.address') }}">contact support</a>.
        </p>
        <p style="margin-top: 12px; color:#D1D5DB;">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>

</div>
</body>
</html>
