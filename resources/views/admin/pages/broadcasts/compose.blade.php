@extends('admin.layouts.app')

@section('title', 'Compose Broadcast')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Compose Broadcast Message</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <form action="{{ route('admin.broadcasts.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label required">Message Title</label>
                            <input type="text" name="title" class="form-control" required placeholder="Enter broadcast title" value="{{ old('title') }}">
                            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Message Body (CKEditor UNCHANGED) -->
                        <div class="mb-3">
                            <label class="form-label required">Message Body</label>
                            <textarea name="body" id="rich-editor" rows="10" class="form-control" required>{{ old('body') }}</textarea>
                            @error('body') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Audience Targeting -->
                        <div class="mb-3">
                            <label class="form-label required">Target Audience</label>
                            <select name="target_audience" id="target_audience" class="form-select" required>
                                <option value="">Select audience</option>
                                <option value="all_users" {{ old('target_audience') == 'all_users' ? 'selected' : '' }}>All Users</option>
                                <option value="all_agents" {{ old('target_audience') == 'all_agents' ? 'selected' : '' }}>All Agents</option>
                                <option value="all_consumers" {{ old('target_audience') == 'all_consumers' ? 'selected' : '' }}>All Consumers</option>
                                <option value="specific_user" {{ old('target_audience') == 'specific_user' ? 'selected' : '' }}>Specific User</option>
                                <option value="specific_agent" {{ old('target_audience') == 'specific_agent' ? 'selected' : '' }}>Specific Agent</option>
                            </select>
                            @error('target_audience') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- ✅ SMART Recipient Selection -->
                        <div class="mb-3 d-none" id="target_selection">
                            <label class="form-label required">Select Recipients</label>
                            <p class="text-muted small mb-2">Type to search; click to select; select multiple recipients</p>
                            <select name="target_ids[]" id="recipient_list" class="form-select" multiple data-placeholder="Search by name or email...">
                                <!-- Auto-filled by JS -->
                            </select>
                            @error('target_ids') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Channels -->
                        <div class="mb-3">
                            <label class="form-label required">Send Via</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="channels[]" value="in_app" {{ in_array('in_app', old('channels', ['in_app'])) ? 'checked' : '' }}>
                                        <span class="form-check-label">In-App Message</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="channels[]" value="email" {{ in_array('email', old('channels', ['email'])) ? 'checked' : '' }}>
                                        <span class="form-check-label">Email</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="channels[]" value="whatsapp" {{ in_array('whatsapp', old('channels', [])) ? 'checked' : '' }}>
                                        <span class="form-check-label">WhatsApp</span>
                                    </label>
                                </div>
                            </div>
                            @error('channels') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Scheduled Time -->
                        <div class="mb-3">
                            <label class="form-label">Schedule Sending (Optional)</label>
                            <input type="datetime-local" name="scheduled_at" class="form-control" min="{{ now()->addMinute()->format('Y-m-d\TH:i') }}" value="{{ old('scheduled_at') }}">
                            <small class="text-muted">Leave empty to send immediately.</small>
                            @error('scheduled_at') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.broadcasts.history') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-paper-plane me-1"></i> Save & Send
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor Script - UNCHANGED -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<!-- ✅ Add Select2 for smart search & tags -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
ClassicEditor
    .create(document.querySelector('#rich-editor'), {
        toolbar: {
            items: [
                'undo', 'redo', '|',
                'heading', '|',
                'bold', 'italic', 'underline', 'strikethrough', '|',
                'bulletedList', 'numberedList', 'outdent', 'indent', '|',
                'alignment', 'link', 'blockQuote', 'insertTable', '|',
                'removeFormat', 'sourceEditing'
            ]
        },
        language: 'en',
        licenseKey: ''
    })
    .then(editor => {})
    .catch(error => { console.error(error); });

// Pass PHP data to JavaScript
const users = @json($users);
const agents = @json($agents);
const recipientSelect = $('#recipient_list');
const targetAudience = document.getElementById('target_audience');
const targetSelection = document.getElementById('target_selection');

// Initialize smart multi-select
recipientSelect.select2({
    width: '100%',
    allowClear: true,
    closeOnSelect: false,
    placeholder: 'Search by name or email...'
});

// Function to load correct list
function loadRecipientList(type) {
    recipientSelect.empty().trigger('change'); // Clear old options & selection

    let options = [];
    if (type === 'specific_user') {
        options = users.map(user => ({
            id: user.id,
            text: `${user.fullname} — ${user.email} (${user.role})`
        }));
    } else if (type === 'specific_agent') {
        options = agents.map(agent => ({
            id: agent.id,
            text: `${agent.fullname} — ${agent.email} (Agent)`
        }));
    }

    // Add all options
    options.forEach(opt => {
        recipientSelect.append(new Option(opt.text, opt.id, false, false));
    });

    recipientSelect.trigger('change');
}

// Run on audience change
targetAudience.addEventListener('change', function() {
    const val = this.value;
    const showList = ['specific_user', 'specific_agent'].includes(val);
    
    targetSelection.classList.toggle('d-none', !showList);
    
    if (showList) {
        loadRecipientList(val);
    }
});

// Restore old input after validation error
@if(old('target_audience'))
document.addEventListener('DOMContentLoaded', () => {
    const val = "{{ old('target_audience') }}";
    if (['specific_user', 'specific_agent'].includes(val)) {
        loadRecipientList(val);
        targetSelection.classList.remove('d-none');
        
        // Re-select old values
        const oldIds = @json(old('target_ids', []));
        recipientSelect.val(oldIds).trigger('change');
    }
});
@endif
</script>
@endsection