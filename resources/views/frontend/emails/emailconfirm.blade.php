@extends('layouts.app')
 
@section('content') 

     <!--Sign In Page-->
     <div class="row pb-5">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="sign padding-60 " >
                <div class="container" style="padding-top: 80px;">
                    <div class="row">
                        <div class="col-12 text-center p-3 ">

                        <i class="fas fa-check-circle mb-3" style="font-size:60px"></i>
                            <h3>Registration Confirmation</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12  align-items-center">
                            <div class="  text-center">
                                <p> 
                                    Your Email is successfully verified. Click here to
                                </p>
                                <p> </p>
                            </div>
                        </div>
                        <div class="col-lg-12 pb-5 align-items-center">
                            <div class="text-center">
                                <a href="{{ route('processpapers') }}" >
                                    <button class="btn btn-dark">
                                        Log In <i class="fas fa-sign-in-alt"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        </div>
        <div class="col-sm-3"></div>

     </div>
        <!--// Sign In Page-->
     
@endsection
