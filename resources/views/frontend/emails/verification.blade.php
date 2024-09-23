@extends('layouts.app')
 
@section('content') 

     
     <!--Sign In Page-->
     <div class="row pb-5">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="sign padding-60 " >
            <div class="container" style="padding-top: 80px;">
                <div class="card border shadow-sm p-5">
                    <div class="row">
                        <div class="col-12 text-center p-3">
                            
                        <img src="{{asset('/assets/success.gif')}}">
                            <h6 class="mt-4">Registration Confirmed</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 pb-5 text-center">
                            <small class="font-weight-light"> 
                                You have successfully created an account, an email verification has been sent to your mail box for verification. 
                                Please check your Mail Box.
                            </small>
                        </div>
                            
                        
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="{{ route('processpapers') }}">
                                <button class="btn btn-dark ps-5 pe-5">
                                    Next
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-sm-4"></div>

     </div>
      
@endsection
