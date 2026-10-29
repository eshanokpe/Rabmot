{{-- Email / SMS / WhatsApp reminder buttons for one document, plus the last
     result on each channel. Expects: $document, $canSend; optional
     $withMessage (show the editable message box), $small --}}
@php
    $btn = 'btn ' . (!empty($small) ? 'btn-sm ' : '');
    $channels = [
        'email' => ['Email', 'btn-outline-primary', $document['email'], 'No valid email address on record'],
        'sms' => ['SMS', 'btn-outline-primary', $document['phone'], 'No valid phone number on record'],
        'whatsapp' => ['WhatsApp', 'btn-success', $document['phone'], 'No valid phone number on record'],
    ];
@endphp
<form method="POST" action="{{ route('admin.documentExpiry.reminder') }}" class="reminder-form">
    @csrf
    <input type="hidden" name="source" value="{{ $document['source'] }}" />
    <input type="hidden" name="record" value="{{ encrypt($document['record_id']) }}" />
    <input type="hidden" name="document_field" value="{{ $document['field'] }}" />
    @if(!empty($withMessage))
        <textarea name="message" class="form-control mb-2" rows="3"
            title="Used for SMS and WhatsApp. The email uses its own template.">{{ $document['message'] }}</textarea>
    @endif

    <div class="d-flex flex-wrap gap-1">
        @foreach($channels as $channel => [$label, $style, $canReach, $unreachable])
            @if(!$canReach || !$canSend)
                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                    title="{{ !$canReach ? $unreachable : "You don't have permission to send reminders" }}">
                    <button type="button" class="{{ $btn . $style }}" disabled style="pointer-events: none">{{ $label }}</button>
                </span>
            @else
                <button type="submit" name="channel" value="{{ $channel }}" class="{{ $btn . $style }}"
                    @if($channel === 'whatsapp') formtarget="_blank" data-opens-whatsapp @endif>{{ $label }}</button>
            @endif
        @endforeach
    </div>
</form>

@foreach(['email' => 'Email', 'sms' => 'SMS', 'whatsapp' => 'WhatsApp'] as $channel => $label)
    @if($reminder = $document['last_reminders'][$channel] ?? null)
        <div class="small mt-1 {{ $reminder->status === 'sent' ? 'text-success' : 'text-danger' }}"
            @if($reminder->error_message) title="{{ $reminder->error_message }}" @endif>
            {{ $reminder->status === 'sent' ? '✓' : '✗' }}
            {{ $label }} {{ $reminder->status === 'sent' ? 'sent' : 'failed' }}
            {{ $reminder->created_at->timezone(config('app.display_timezone'))->format('d M Y, g:i A') }}
            by {{ $reminder->admin_name ?? 'Unknown admin' }}
            @if($reminder->status !== 'sent' && $reminder->error_message)
                <span class="text-muted">— {{ \Illuminate\Support\Str::limit($reminder->error_message, 60) }}</span>
            @endif
        </div>
    @endif
@endforeach

@once
    <script>
        // WhatsApp opens in a new tab; refresh this page so its "sent" line shows up.
        document.addEventListener('click', function (event) {
            if (event.target.closest('[data-opens-whatsapp]')) {
                setTimeout(function () { window.location.reload(); }, 1500);
            }
        });
    </script>
@endonce
