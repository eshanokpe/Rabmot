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
                        FAQ Update
                    </h2>
                </div>
                <div class="text-end col-6">
                    <a href="{{route("admin.faq.create")}}">
                        <button type="submit" class="btn btn-primary">+Add New</button>
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
                            <h3 class="card-title">Frequently Asked Questions </h3>
                        </div>
                        
                        <br/>
                        @if(session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <script>
                                // Wait for the document to be ready
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Select the success alert element by its ID
                                    var errorAlert = document.getElementById('error-alert');
                            
                                    // Check if the alert element exists
                                    if (errorAlert) {
                                        // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                        setTimeout(function() {
                                            errorAlert.style.display = 'none';
                                        }, 5000); // 5000 milliseconds = 5 seconds
                                    }
                                });
                            </script>
                            @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <script>
                                // Wait for the document to be ready
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Select the success alert element by its ID
                                    var successAlert = document.getElementById('success-alert');
                            
                                    // Check if the alert element exists
                                    if (successAlert) {
                                        // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); // 5000 milliseconds = 5 seconds
                                    }
                                });
                            </script>
                        <div class="table-responsive ">
                            <table class="table card-table table-vcenter text-nowrap datatable two-sided-header">
                                
                                <thead>
                                    <tr>
                                        <th class="w-1">
                                            S/N
                                            <i class="fa fa-arrow-up"></i> 
                                        </th>
                                        <th>Action</th>
                                        <th>Questions</th>
                                        <th>Response</th>
                                        <th>Date Updated</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $serial = 1 @endphp
                                    @forelse ($data as $data)
                                        <tr>
                                            <td><span class="text-muted">{{ $serial++ }}</span></td>
                                            <td class="">
                                                <span class="dropdown">
                                                    <a href="{{ route('admin.faq.edit', encrypt($data->id) ) }}" class="btn align-text-top">Edit</a>
                                                </span>
                                            </td>
                                            <td>{{$data->question}}</td>
                                            <td>{{$data->answer }}</td>
                                            <td>{{$data->created_at}} </td>
                                            
                                        </tr>
                                    @empty
                                        <p class="text-danger">No Data found</p>
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