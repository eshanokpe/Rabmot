@extends('admin.layouts.app') 
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center"> 
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Admin
                    </div>
                    <h2 class="page-title">
                        Price Update
                    </h2>
                </div>
                <div class="text-end col-6">
                    <a href="{{ route('admin.intDriverLicense.create') }}" class="btn btn-primary">
                        +Add New
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
                            <h3 class="card-title">International Driver License Price List</h3>
                        </div>
                        <br/>
                        @if(session('error'))
                            <div class="alert alert-danger" id="error-alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var errorAlert = document.getElementById('error-alert');
                                if (errorAlert) {
                                    setTimeout(function() {
                                        errorAlert.style.display = 'none';
                                    }, 5000); 
                                }
                            });
                        </script>
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
                                    }, 5000);
                                }
                            });
                        </script>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable two-sided-header">
                                <thead>
                                    <tr>
                                        <th class="w-1">S/N
                                            <i class="fa fa-arrow-up"></i>
                                        </th>
                                        <th>Action</th>
                                        <th>State</th>
                                        <th>Year Type</th>
                                        <th>Amount</th>
                                        <th>Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $serial = 1 @endphp
                                    @forelse($data as $item)
                                    <tr>
                                        <td><span class="text-muted">{{ $serial++ }}</span></td>
                                        <td class="">
                                            <a href="{{ route('admin.intDriverLicense.edit', encrypt($item->id)) }}" class="btn">Edit</a>
                                            <a href="{{ route('admin.intDriverLicense.destroy', encrypt($item->id)) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                        </td>
                                        <td>{{ $item->stateInfo->name ?? 'N/A' }}</td>
                                        <td>{{ $item->years_type ?? 'N/A' }} Years</td>
                                        <td>₦ {{ number_format($item->amount, 2, '.', ',') ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $date = \Carbon\Carbon::parse($item->created_at);
                                            @endphp
                                            {{ $date->format('F j, Y') }}
                                        </td>
                                    </tr>  
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">No Data found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
