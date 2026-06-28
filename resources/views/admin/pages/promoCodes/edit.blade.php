@extends('admin.layouts.app') 
@section('content')
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
                            Edit Promocode

                        </h2>
                    </div>
                    <div class="text-end col-6"> 
                        <a href="{{route('admin.promocode.index')}}" class="btn btn-primary">
                           View Promo code
                        </a> 
                    </div>
                </div>

            </div>

        </div>

        <div class="page-body">
            <div class="container">
                <div class="row row-deck row-cards">
                    <div class="col-2 mt-2 ps-3 ml-3">
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Promo code </h3>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

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
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var successAlert = document.getElementById('success-alert');
                            
                                    if (successAlert) {
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 15000); 
                                    }
                                });
                            </script>
                            
                            <div class="row">
                                <div class="col-2 mt-2 ps-3 ml-3">
                                </div>
                                <div class="col-8 mt-2 ps-3 ml-3">
                                    <form class="form-fieldset"  method="POST" action="{{ route('admin.promocode.update', $promoCode->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="mb-3 col-12">
                                                <label class="form-label required"> Promo Code </label>
                                                <div class="input-group">
                                                    <input type="text" id="promo_code" name="code" class="form-control" placeholder="Enter or generate promo code" value="{{ old('code', $promoCode->code) }}" required>
                                                    <button type="button" id="generate_code" class="btn btn-primary">Generate Random Code</button>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Discount Percentage</label>
                                                <input type="number" name="discount_percentage" class="form-control" placeholder="Discount (%)" autocomplete="off" value="{{ old('discount_percentage', $promoCode->discount_percentage) }}" required/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Start datetime</label>
                                                <input type="datetime-local" name="start_datetime" class="form-control" placeholder="State Name" autocomplete="off"  value="{{ old('start_datetime', $promoCode->start_datetime->format('Y-m-d\TH:i')) }}" required/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">End datetime</label>
                                                <input type="datetime-local" name="end_datetime" class="form-control" placeholder="State Name" autocomplete="off" value="{{ old('end_datetime', $promoCode->end_datetime->format('Y-m-d\TH:i')) }}" required/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Usage Limit (Optional)</label>
                                                <input type="number" name="usage_limit" class="form-control" placeholder="Usage Limit (Optional)" autocomplete="off" value="{{ old('usage_limit', $promoCode->usage_limit) }}" required/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="active" {{ $promoCode->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="expired" {{ $promoCode->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                                    <option value="deactivated" {{ $promoCode->status == 'deactivated' ? 'selected' : '' }}>Deactivated</option>
                                                </select>
                                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 col-12">
                                            <input type="submit" class="btn btn-primary ms-auto" value="Update Promo Code"/>    
                                        </div>
                                    </form>
                                    <script>
                                        document.getElementById('generate_code').addEventListener('click', function () {
                                            const randomCode = generateRandomCode(8); // Change length as needed
                                            document.getElementById('promo_code').value = randomCode;
                                        });
                                    
                                        function generateRandomCode(length) {
                                            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                            let result = '';
                                            for (let i = 0; i < length; i++) {
                                                result += characters.charAt(Math.floor(Math.random() * characters.length));
                                            }
                                            return result;
                                        }
                                    </script>
                                </div>
                                <div class="col-2 mt-2 ps-3 ml-3">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-2 mt-2 ps-3 ml-3">
                    </div>
                    
                </div>
               
                
            </div>
        </div>

    </div>

</div>




@endsection