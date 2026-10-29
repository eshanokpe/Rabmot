{{-- Expiry status for one document from DocumentExpiryService. Expects: $document --}}
@switch($document['status'])
    @case('expired')
        <div class="small text-danger">
            Expired {{ abs($document['days_remaining']) }} {{ \Illuminate\Support\Str::plural('day', abs($document['days_remaining'])) }} ago
        </div>
        @break
    @case('week')
    @case('month')
        <div class="small {{ $document['status'] === 'week' ? 'text-danger' : 'text-warning' }}">
            @if($document['days_remaining'] === 0)
                Expires today
            @else
                {{ $document['days_remaining'] }} {{ \Illuminate\Support\Str::plural('day', $document['days_remaining']) }} left
            @endif
        </div>
        @break
    @case('valid')
        <div class="small text-success">Valid</div>
        @break
    @default
        <div class="small text-muted">No date</div>
@endswitch
