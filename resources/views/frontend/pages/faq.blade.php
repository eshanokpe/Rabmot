@extends('layouts.app')

@section('content')


    <!--Blog Page Content-->
    <div class="blog-page-content padding-top-50  padding-bottom-50" style="padding-top: 80px;">
        <div class="container">
            <div class="col-lg-12">
                <div class="border-bottom padding-bottom-20 ">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="widget-title "> <b> Frequently Asked Questions</b></h5>
                        </div>
                        
                    
                    </div>
                </div>

                <div class="container padding-top-20">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="accordion-wrapper">
                                <div id="accordionOne">
                                    @foreach($faqs as $key => $faq)
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $key }}">
                                                <h5 class="mb-0">
                                                    <a role="button" data-toggle="collapse" 
                                                       data-target="#collapse{{ $key }}" 
                                                       aria-expanded="{{ $key === 0 ? 'true' : 'false' }}" 
                                                       aria-controls="collapse{{ $key }}">
                                                        {{ $faq->question }}
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse{{ $key }}" 
                                                 class="collapse {{ $key === 0 ? 'show' : '' }}" 
                                                 aria-labelledby="heading{{ $key }}" 
                                                 data-parent="#accordionOne">
                                                <div class="card-body">
                                                    <p>{{ $faq->answer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
               
            </div>
            <!--// Accordion-->
        </div>
        <!--// Recent Post Widget-->
        
                    
    </div>
    
@endsection