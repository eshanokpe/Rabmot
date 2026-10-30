{{-- Reminder section for a record's expired / soon-to-expire documents.
     Expects: $expiringDocuments (from DocumentExpiryService) --}}
@if(count($expiringDocuments))
    @php
        $canSendReminder = Auth::guard('admin')->user()->hasPermission('manage-vehicles');
    @endphp
    <div class="card-body border-bottom">
        <h4 class="mb-1">Documents Expired or Expiring Soon</h4>
        <div class="text-muted mb-3">
            Email and SMS are sent immediately. WhatsApp opens a pre-filled chat. The message below is used for SMS and WhatsApp and can be edited first.
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th class="w-1">S/N</th>
                        <th>Document</th>
                        <th>Expiry Date</th>
                        <th>Reminder</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expiringDocuments as $document)
                        <tr>
                            <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                            <td class="fw-bold">{{ $document['label'] }}</td>
                            <td class="text-nowrap">
                                {{ $document['expiry_date']->format('F j, Y') }}
                                @include('admin.partials.documentExpiryBadge', ['document' => $document])
                            </td>
                            <td style="min-width: 360px">
                                @include('admin.partials.reminderChannels', ['document' => $document, 'canSend' => $canSendReminder, 'withMessage' => true])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
