@extends('layouts.app')

@section('content')


    <!--Blog Page Content-->
    <div class="blog-page-content padding-top-50  padding-bottom-50" style="padding-top: 80px;">
        <div class="container">
            <div class="col-lg-12">
                <div class="border-bottom padding-bottom-20 ">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="widget-title "> <b> Join Recent Disscussion</b></h5>
                        </div>
                         
                    
                    </div>
                </div>

                <div class="container padding-top-20">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="accordion-wrapper">
                                <div id="accordionOne">
                                    @foreach($topics as $key => $topic)
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $key }}">
                                                <h5 class="mb-0">
                                                    <a role="button" data-toggle="collapse" 
                                                       data-target="#collapse{{ $key }}" 
                                                       aria-expanded="{{ $key === 0 ? 'true' : 'false' }}" 
                                                       aria-controls="collapse{{ $key }}">
                                                        {{ $topic->title }}
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse{{ $key }}" 
                                                 class="collapse {{ $key === 0 ? 'show' : '' }}" 
                                                 aria-labelledby="heading{{ $key }}" 
                                                 data-parent="#accordionOne">
                                                <div class="card-body">
                                                    <p>{{ $topic->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 padding-top-20">
                    <center>    
                        <div class="main-btn-wrap ">
                        <!-- Button trigger modal -->
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="main-btn  black"> Create a Discusion </button>
                                <!-- Button trigger modal -->
                        </div>
                    </center>
                </div>
            </div>
            <!--// Accordion-->
        </div>
        <!--// Recent Post Widget-->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-box-item text-center">
                        <div class="modal-box-item__icon red">
                            <i class="flaticon-warning-sign"></i>
                        </div>
                        <div class="modal-box-item__content">
                            <h5 class="heading-05"> Create Disscussion  </h5>
                            
                            <p style="font-size: 16px;">To Create a Disscussion, you have to login with an Acount.</p>
                        </div>
                        <div class="modal-box-item__button">
                            <div class="main-btn-wrap">
                                <a href="#" class="main-btn black-border ls mr-3 uppercase" data-bs-dismiss="modal">Cancel</a>
                                <a href="{{ route('processpapers')}}" class="main-btn black ls uppercase">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    
    </div>
    
@endsection