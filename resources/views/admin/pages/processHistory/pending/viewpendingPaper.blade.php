@extends('admin.layouts.app') 

@section('content')
<style>
    .order-status {
        padding: 5px;
        border: 1px solid #ccc;
        margin: 5px;
        border-radius: 4px;
        align-items: center;
    }
 
   
    .pending {
        background-color: yellow;
        color: black;
    }

    .processing {
        background-color: orange;
        color: white;
    }

    .ready {
        background-color: blue;
        color: white;
    }

    .delivery {
        background-color: green;
        color: white;
    }

    .delivered {
        background-color: teal;
        color: white;
    }

</style>
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Edit Pending Document Admin
                        </h2>
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
                                <h3 class="card-title">Edit Pending Document</h3>
                            </div>
                            <br>
                            @if(session('success'))
                                <div class="alert alert-success" id="error-message">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger" id="error-message">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var successAlert = document.getElementById('error-message');
                            
                                    if (successAlert) {
                                         setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); 
                                    }
                                });
                            </script>
                            <div class="col-12 mt-2 ps-2">
                                <form class="form-fieldset" action="{{ route('admin.update-pendingPaper-status', ['id' => encrypt($items->id) ]) }}" method="POST">
                                    @csrf
                                    @method('PUT')                                
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <div class="mb-3 ">
                                                <label class="form-label required">Process ID</label>
                                                <input type="text" class="form-control" autocomplete="off" disabled value="{{ $items->process_id}}"/>
                                            </div>

                                            <div class="mb-3 ">
                                                <label class="form-label required">Process Type</label>
                                                <input type="email" class="form-control"  autocomplete="off" disabled value="{{ $items->process_type}}"/>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Amount</label>
                                                <input type="tel" class="form-control" autocomplete="off" disabled value="₦{{ number_format($items->totalamount,2,'.',',')}}"/>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Date</label>
                                                @php
                                                    $date = \Carbon\Carbon::parse($items->created_at);
                                                @endphp
                                                <input type="tel" class="form-control" autocomplete="off" disabled value="{{ $date->format('F j, Y')}}"/>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Document Status</label>
                                                <select class="form-select" id="select-option" name="status">
                                                    <option value="0" @if ($items->status == 0) selected @endif>Pending</option>
                                                    <option value="1" @if ($items->status == 1) selected @endif>Processing</option>
                                                    <option value="2" @if ($items->status == 2) selected @endif>Ready for Delivery</option>
                                                    <option value="3" @if ($items->status == 3) selected @endif>Delivery in progress</option>
                                                    <option value="4" @if ($items->status == 4) selected @endif>Delivered</option>
                                                </select>
                                            </div>
 
                                        </div>
                                        <div class="mb-3 col-6">
                                            <div class="mb-3 ">
                                                <label class="form-label required">Delivery Option</label>
                                                <input type="email" class="form-control"  autocomplete="off" disabled value="{{ $items->delivery_option}}"/>
                                            </div>
                                            <div class="mb-3 ">
                                                <label class="form-label required">Address</label>
                                                <textarea  class="form-control"  autocomplete="off" disabled >{{ $items->address}}</textarea>
                                            </div>
                                            <div class="mb-3 ">
                                                <label class="form-label required">Lagos Address</label>
                                                <textarea  class="form-control"  autocomplete="off" disabled >{{ $items->lagos_address}}</textarea>
                                            </div>
                                            
                                            <div class="mb-3 ">
                                                <label class="form-label required">Scan Email</label>
                                                <input type="email" class="form-control"  autocomplete="off" disabled value="{{ $items->scan_email}}"/>
                                            </div>
                                        </div>
                                        

                                        
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <button type="submit" class="btn btn-primary ms-auto">Update Status</button>  
                                        </div>     
                                        <div class="mb-3 col-4">
                                            <a href="{{ route("admin.pendingpaper") }}" class="btn btn-primary ms-auto">Back</a>  
                                        </div>                                  
                                    </div>

                                </form>
                            </div>         
                            <div class="card-footer">
                                @if( $items->status == '0')
                                <h4><center><span class="badge badge-secondary pending">Pending</span></center></h4>
                                {{-- <div class="order-status pending">Pending</div> --}}
                                @endif
                                @if( $items->status == '1')
                                    <h4><center><span class="badge badge-secondary processing">Processing</span></center></h4>
                                @endif
                                @if( $items->status == '2')
                                <h4><center><span class="badge badge-success ready">Ready for Delivery</span></center></h4>
                                @endif
                                @if( $items->status == '3')
                                    <h4><center><span class="badge badge-primary delivery">Delivered</span></center></h4>
                                @endif
                                @if( $items->status == '4')
                                    <h4><center><span class="badge badge-primary delivered ">Delivered</span></center></h4>
                                @endif
                            </div>                                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection