@extends('layouts.app')

<style>
   
    /* Apply custom styles for the checked state to the checkbox's appearance */
    .form-check-input:checked::before {
        content: "\2713"; /* Unicode character for checkmark */
        display: block;
        text-align: center;
        font-size: 16px;
        line-height: 20px;
        background-color: #142444;
        color: #fff; /* Change this color to your desired checkmark color */
    }
</style> 

@section('content') 
<section class="how-we-are padding-top-100 padding-bottom-50 " style="padding-top: 80px;">
    <div id="pricing"></div>
</section>

@endsection