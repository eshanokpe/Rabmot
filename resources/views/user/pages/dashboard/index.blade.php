<div class="row"> 
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
    <div class="col-12 col-lg-4">
        <div class="card radius-15 bg-voilet">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0 text-white">{{ $totalCountVehicle }} <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
                    </div>
                    <div class="ms-auto font-35 text-white">
                        <i class="bx bx-car"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Vehicles</p>
                    </div>
                    <div class="ms-auto font-14 text-white"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card radius-15 bg-primary-blue">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0 text-white">{{ $orderCount }}<i class='bx bxs-down-arrow-alt font-14 text-white'></i> </h2>
                    </div>
                    <div class="ms-auto font-35 text-white"><i class="bx bx-cart-alt"></i>
                    </div>
                </div> 
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Orders</p>
                    </div>
                    <div class="ms-auto font-14 text-white"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card radius-15 bg-rose">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0 text-white">0 <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
                    </div>
                    <div class="ms-auto font-35 text-white"><i class="bx bx-money"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div> 
                        <p class="mb-0 text-white">Wallet</p>
                    </div>
                    <div class="ms-auto font-14 text-white"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<div class="card radius-15  overflow-hidden">
    <br>
    <div class="card-header pt-10 border-bottom-0">
        <div class="d-lg-flex align-items-center">
            <br> 
            <div class="col-sm-6">
                <h5 class="mb-0">COMMISSIONS EARNED</h5> 
                <h6 class="mb-0">
                    <snap><a href="{{ route('home.referralDetails')}}">Total Referral: {{ isset($referralsCount) ? $referralsCount : 0 }} </a></snap>
                    | 
                    Earned: {{ isset($tokenCount) ? $tokenCount : 0 }}
                </h6>


            </div>
            <div class="col-sm-6">
                <small>Refer & Earn</small>
                <small>( Copy Referral Link <i class='bx bx-link' style="font-size:18px;"></i> )</small>
            <input type="text" value="{{$referralLink}}" id="textToCopy"class="form-control" readonly>
                    <div id="copiedMessage" style="display: none;" class="text-success pt-3">Copied!</div>
            </div>
            
        </div>
    </div>
    <br>
    
</div>