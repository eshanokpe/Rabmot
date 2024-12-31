@extends('user.layouts.app') 

@section('content')

	<!-- wrapper -->
	<div class="wrapper">
		<!--header-->
	
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper"> 
				<div class="page-content">
					@include('user.pages.dashboard.index')

					<div class="card radius-5 overflow-hidden p-2">
                        <div class="card-header pt-10 border-bottom-0">
                            <h4 class="card-title">Referred Details</h4>
                        </div>
                        <div class="card-body">
                            @if($referrals->isNotEmpty())
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Referral Code</th>
                                            <th>Date Referred</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($referrals as $index => $referral)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $referral->referredUser->fullname ?? 'N/A' }}</td>
                                                <td>{{ $referral->referredUser->email ?? 'N/A' }}</td>
                                                <td>{{ $referral->referral_code }}</td>
                                                <td>{{ $referral->referred_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No referrals found.</p>
                            @endif
                        </div>
                    </div>
                    
				</div>
                
                <script>
                    var textToCopy = document.getElementById("textToCopy");
                    textToCopy.addEventListener("click", function() {
                        // Select the text in the input element
                        textToCopy.select();
                        textToCopy.setSelectionRange(0, 99999); // For mobile devices
                    
                        // Copy the text to the clipboard
                        document.execCommand("copy");
                    
                        // Show a "Copied!" message
                        var copiedMessage = document.getElementById("copiedMessage");
                        copiedMessage.style.display = "block";
                    
                        // Hide the message after a short delay
                        setTimeout(function() {
                            copiedMessage.style.display = "none";
                        }, 2000); // 2 seconds (adjust as needed)
                    });
                </script>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->

		<!--footer-->
		
		<!--end footer-->
	</div>

@endsection