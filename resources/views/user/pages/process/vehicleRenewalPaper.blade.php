@extends('user.layouts.app') 

@section('content')

    <style>
        /* hide the arrows beside the input type number forms */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;  
        }
        /* special handling for mozilla*/
        input[type=number] {
            -moz-appearance:textfield;
        }
        
        
        /* hide the arrows beside the input type number forms */
        input[type=date]::-webkit-inner-spin-button, 
        input[type=date]::-webkit-outer-spin-button { 
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0; 
        }
        /* special handling for mozilla*/
        input[type=date] {
            -moz-appearance:textfield;
        }
			
        .additionSubtractionTable{
				max-width: 30px !important; 
			}
			
			
			.additionSubtraction{
				border-radius: 3px; 
				padding:3px 4px 3px 4px; 
				overflow:hidden; 
				color: #fff;
				background-color: #bbb ; /* #009ee0; */
				min-width: 17px ; 
				/* height: 23px; */
				font-size: 120% ; 
			}
			
			.additionSubtraction:hover{
				cursor: hand !important;
				cursor: pointer !important;
			}
			
			.additionSubtractionForm{
				border-radius: 5px; 
				padding:3px 5px 3px 5px; 
				margin-top: 1px !important;
				width: 32px ; 
				height: 25px;
			}
    </style>

	<div id="vehiclerenewalpaper"></div>
@endsection
