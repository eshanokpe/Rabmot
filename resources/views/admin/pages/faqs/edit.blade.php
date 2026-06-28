
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
                            Master Admin
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{route("admin.faq.index")}}" class="btn btn-primary">
                            FAQs
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
                                <h3 class="card-title">Edit Frequently Asked Questions</h3>
                            </div>
                            @if (session('success'))
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									{{ session('success') }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>

							</div>
                            @endif
                            @if (session('error'))
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                </div>
                            @endif
                            <div class="col-12 mt-2 ps-2">
                                <form class="form-fieldset" action="{{ route('admin.faq.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                            <div class="row">
                                                <div class="mb-3 col-3">
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label class="form-label required">Question </label>
                                                    <input type="text" value="{{ $data->question}}" name="question" class="form-control"  autocomplete="off"/>
                                                </div>
                                                <div class="mb-3 col-3">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-3">
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label class="form-label required">Response</label>
                                                    <textarea name="answer" class="form-control" autocomplete="off" rows="8">{{ $data->answer}}</textarea>
                                                </div>
                                                <div class="mb-3 col-3">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-3">
                                                </div>
                                                <div class="mb-3 col-4">
                                                <label class="form-label">   .</label>
                                                    <button type="submit" class="btn btn-primary ms-auto">Update FAQ</button>    
                                                </div>
                                                <div class="mb-3 col-3">
                                                </div>
                                            </div>
                                        
                                    </div>
                                </form>
                            </div>
                            
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection