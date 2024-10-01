import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import VehiclePapersRenewal from './vehiclePapersRenewal';
import VehicleRegistration from './vehicleRegistration';
import ChangeofOwnership from './changeofOwnership';
import DriverLicenseRenewal from './driverLicenseRenewal';
import NewDriverLicense from './newDriverLicense';
import InternatinalDriversLicense from './internatinalDriversLicense';
import OtherPermit from './otherPermit';

export default function UserPrice() {

 
    return ( 
        <> 
            <div class="page-wrapper"> 
                <div class="page-content-wrapper">
                    <div class="page-content"> 
                        
                        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                            <div class="breadcrumb-title pe-3">Vehicle</div>
                            <div class="ps-3">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0 p-0">
                                        <li class="breadcrumb-item"><a href=""><i class="bx bx-home-alt"></i></a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page"> Pricing</li>
                                    </ol>
                                </nav>
                            </div> 
                            
                        </div>

                        <div class="row">
						
                            <div class="col-xl-10 mx-auto">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bxs-car me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Pricing</h5>
                                </div>

                                <div class="card radius-15 border-top border-0 border-4 ">
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-xl-12">
                                            <div class=" radius-15">
                                                <div class="card-body">
                                                    <h6 class="text-justify card-title text-danger">
                                                        TIMELINE:
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>Paper Renewals:</b>  [24-48 hours]
                                                    </h6> 
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>New Vehicle Reg:</b> [48-72 hours]
                                                    </h6> 
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>Change of Ownership:</b> [72hrs - 2.5 weeks ]
                                                    </h6> 
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>Drivers Licence Renewal:</b> [72hrs - 4 weeks]
                                                    </h6> 
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>New Drivers Licence:</b> [4-6 weeks]
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
					
                                <hr/>
                                <div class="card">
                                    <div class="">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                          
                                            <VehiclePapersRenewal /> 
                                            <VehicleRegistration />
                                            <ChangeofOwnership />
                                            <NewDriverLicense />
                                            <DriverLicenseRenewal />
                                            <InternatinalDriversLicense />
                                            <OtherPermit />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </> 
    );
}

if (document.getElementById('userPrice')) {
    ReactDOM.createRoot(document.getElementById('userPrice')).render(
        <React.StrictMode>
            <UserPrice />
        </React.StrictMode>
    );
}
