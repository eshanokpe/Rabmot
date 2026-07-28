@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Commission Management
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.agents') }}" class="btn btn-outline-secondary">
                            Back to Agents
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">

                    <div class="col-12">
                        @if(session('error'))
                            <div class="alert alert-danger" id="error-alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var successAlert = document.getElementById('success-alert');
                                if (successAlert) {
                                    setTimeout(function() {
                                        successAlert.style.display = 'none';
                                    }, 10000);
                                }
                            });
                        </script>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#tab-base" class="nav-link active" data-bs-toggle="tab">Base Rate &amp; Preview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-tiers" class="nav-link" data-bs-toggle="tab">Tiers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-overrides" class="nav-link" data-bs-toggle="tab">Overrides</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-audit" class="nav-link" data-bs-toggle="tab">Audit Log</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane active show" id="tab-base">
                                        <h4>Base Commission Rate</h4>
                                        <form method="POST" action="{{ route('admin.commission.updateBaseRate') }}" class="row mb-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3 col-6">
                                                <label class="form-label required">Base Rate (%)</label>
                                                <input type="number" step="0.01" min="0" max="100" name="rate" class="form-control" value="{{ old('rate', $setting->rate) }}" required/>
                                                <small class="form-hint">Applied when an agent has no override and doesn't fall into any tier.</small>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Save Base Rate</button>
                                            </div>
                                        </form>

                                        <h4 class="mt-4">Commission Preview</h4>
                                        <form method="POST" action="{{ route('admin.commission.preview') }}" class="row mb-3">
                                            @csrf
                                            <div class="mb-3 col-4">
                                                <label class="form-label">Agent Username or Email</label>
                                                <input type="text" name="preview_agent_identifier" class="form-control" value="{{ old('preview_agent_identifier') }}" required/>
                                            </div>
                                            <div class="mb-3 col-4">
                                                <label class="form-label">Order Amount (NGN)</label>
                                                <input type="number" step="0.01" min="0" name="preview_amount" class="form-control" value="{{ old('preview_amount') }}" required/>
                                            </div>
                                            <div class="col-4 d-flex align-items-end">
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-outline-primary">Preview</button>
                                                </div>
                                            </div>
                                        </form>

                                        @if (session('previewResult'))
                                            @php $preview = session('previewResult'); @endphp
                                            <div class="card card-sm bg-light">
                                                <div class="card-body">
                                                    <p class="mb-1"><strong>Agent:</strong> {{ $preview['agent']->fullname }} ({{ $preview['agent']->username }})</p>
                                                    <p class="mb-1"><strong>Order Amount:</strong> ₦{{ number_format($preview['amount'], 2) }}</p>
                                                    <p class="mb-1"><strong>Resolved Rate:</strong> {{ $preview['rate'] }}%</p>
                                                    <p class="mb-1"><strong>Computed Commission:</strong> ₦{{ number_format($preview['commission'], 2) }}</p>
                                                    <p class="mb-0">
                                                        <strong>Reason:</strong>
                                                        @if ($preview['source'] === 'override')
                                                            Agent-specific override
                                                        @elseif ($preview['source'] === 'tier')
                                                            Tier "{{ $preview['tier']->name }}" ({{ $preview['tier']->min_referrals }}-{{ $preview['tier']->max_referrals ?? '∞' }} referrals)
                                                        @else
                                                            Base rate (no override or matching tier)
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="tab-pane" id="tab-tiers">
                                        <h4>Commission Tiers</h4>
                                        <p class="text-muted">Tiers apply based on how many agents someone has referred. An agent-specific override always takes precedence over a tier.</p>
                                        <div class="table-responsive mb-4">
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Min Referrals</th>
                                                        <th>Max Referrals</th>
                                                        <th>Rate (%)</th>
                                                        <th>Sort Order</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($tiers as $tier)
                                                        <tr>
                                                            <td><input type="text" name="name" form="tier-update-{{ $tier->id }}" class="form-control form-control-sm" value="{{ $tier->name }}" required></td>
                                                            <td><input type="number" min="0" name="min_referrals" form="tier-update-{{ $tier->id }}" class="form-control form-control-sm" value="{{ $tier->min_referrals }}" required></td>
                                                            <td><input type="number" min="0" name="max_referrals" form="tier-update-{{ $tier->id }}" class="form-control form-control-sm" value="{{ $tier->max_referrals }}" placeholder="No limit"></td>
                                                            <td><input type="number" step="0.01" min="0" max="100" name="rate" form="tier-update-{{ $tier->id }}" class="form-control form-control-sm" value="{{ $tier->rate }}" required></td>
                                                            <td><input type="number" min="0" name="sort_order" form="tier-update-{{ $tier->id }}" class="form-control form-control-sm" value="{{ $tier->sort_order }}"></td>
                                                            <td class="text-end">
                                                                <button type="submit" form="tier-update-{{ $tier->id }}" class="btn btn-sm btn-outline-primary">Save</button>
                                                                <button type="submit" form="tier-delete-{{ $tier->id }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this tier?');">Delete</button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="6" class="text-muted">No tiers configured yet — the base rate applies to everyone.</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- Hidden forms kept outside the table: a <form> placed directly inside <tbody> gets emptied by the browser's HTML table-parsing rules (its children are foster-parented out), which would silently strip the @csrf/@method fields. The row inputs/buttons above reference these via the form="" attribute instead. --}}
                                        @foreach ($tiers as $tier)
                                            <form id="tier-update-{{ $tier->id }}" method="POST" action="{{ route('admin.commission.tiers.update', ['id' => $tier->id]) }}" class="d-none">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            <form id="tier-delete-{{ $tier->id }}" method="POST" action="{{ route('admin.commission.tiers.destroy', ['id' => $tier->id]) }}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endforeach

                                        <h5>Add Tier</h5>
                                        <form method="POST" action="{{ route('admin.commission.tiers.store') }}" class="row">
                                            @csrf
                                            <div class="mb-3 col-3">
                                                <label class="form-label required">Name</label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-2">
                                                <label class="form-label required">Min Referrals</label>
                                                <input type="number" min="0" name="min_referrals" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-2">
                                                <label class="form-label">Max Referrals</label>
                                                <input type="number" min="0" name="max_referrals" class="form-control" placeholder="No limit">
                                            </div>
                                            <div class="mb-3 col-2">
                                                <label class="form-label required">Rate (%)</label>
                                                <input type="number" step="0.01" min="0" max="100" name="rate" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-2">
                                                <label class="form-label">Sort Order</label>
                                                <input type="number" min="0" name="sort_order" class="form-control" value="0">
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Add Tier</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-overrides">
                                        <h4>Agents With an Active Override</h4>
                                        <p class="text-muted">To set or clear an agent's commission override, open the agent's profile page.</p>
                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Override Rate</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($overriddenAgents as $overriddenAgent)
                                                        <tr>
                                                            <td>{{ $overriddenAgent->username }}</td>
                                                            <td>{{ $overriddenAgent->fullname }}</td>
                                                            <td>{{ $overriddenAgent->email }}</td>
                                                            <td>{{ $overriddenAgent->commission_override_rate }}%</td>
                                                            <td>
                                                                <a href="{{ route('admin.agent.show', ['id' => encrypt($overriddenAgent->id)]) }}" class="btn btn-sm">Manage on Profile</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="5" class="text-muted">No agents currently have a commission override.</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab-audit">
                                        <h4>Audit Log</h4>
                                        <div class="table-responsive mb-3">
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Admin</th>
                                                        <th>Action</th>
                                                        <th>Description</th>
                                                        <th>Old Value</th>
                                                        <th>New Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($auditLogs as $log)
                                                        <tr>
                                                            <td>{{ $log->created_at->format('F j, Y g:i A') }}</td>
                                                            <td>{{ $log->admin->name ?? 'Unknown' }}</td>
                                                            <td><span class="badge text-bg-secondary">{{ str_replace('_', ' ', $log->action) }}</span></td>
                                                            <td>{{ $log->description }}</td>
                                                            <td>{{ $log->old_value ?? '—' }}</td>
                                                            <td>{{ $log->new_value ?? '—' }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="6" class="text-muted">No commission changes have been logged yet.</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $auditLogs->links() }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
