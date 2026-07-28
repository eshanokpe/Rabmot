@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col-6">
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Service Pricing
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.services.create') }}">
                            <button type="submit" class="btn btn-primary">+Add Service</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Services</h3>
                            </div>
                            <br>
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
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
                            <br>

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">S/N</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Commission Eligible</th>
                                            <th>Commission Override</th>
                                            <th>Effective Date</th>
                                            <th>Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($items as $item)
                                        <tr>
                                            <td><span class="text-muted">{{ $serial++}}</span></td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.services.edit', ['id' => encrypt($item->id)]) }}" class="btn btn-sm">Edit</a>
                                                <form method="POST" action="{{ route('admin.services.toggleStatus', ['id' => encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('{{ $item->status === 'active' ? 'Disable' : 'Enable' }} this service?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm {{ $item->status === 'active' ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                                        {{ $item->status === 'active' ? 'Disable' : 'Enable' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-end">
                                                @if ($item->status === 'active')
                                                    <span class="badge text-bg-success">Active</span>
                                                @else
                                                    <span class="badge text-bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>₦{{ number_format($item->price, 2) }}</td>
                                            <td>
                                                @if ($item->commission_eligible)
                                                    <span class="badge text-bg-success">Yes</span>
                                                @else
                                                    <span class="badge text-bg-secondary">No</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->commission_rate_override !== null ? $item->commission_rate_override . '%' : '—' }}</td>
                                            <td>{{ $item->effective_date ? $item->effective_date->format('F j, Y') : '—' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('F j, Y') }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9"><p class="text-danger mb-0">No services found</p></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
