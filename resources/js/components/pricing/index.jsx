import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import VehicleRenewalPricing from './vehicleRenewalPricing';
import NewVehicleRegistration from './newVehicleRegistration';
import ChangeOfOwnership from './changeOfOwnership';
import NewDriverLicense from './newDriverLicenses';
import DriverLicenseRenewal from './driverLicenseRenawal';
import OtherPermits from './otherPermits';
import InternationalDriverLicense from'./internationalDriverLicense';

export default function Pricing() {
    return ( 
        <>  
            <VehicleRenewalPricing/>
            <NewVehicleRegistration/>
            <ChangeOfOwnership/>
            <NewDriverLicense/>
            <DriverLicenseRenewal/>
            <InternationalDriverLicense/>
            <OtherPermits/> 
        </>
    );
}

if (document.getElementById('pricing')) {
ReactDOM.createRoot(document.getElementById('pricing')).render(
<React.StrictMode>
    <Pricing />
</React.StrictMode>
);
}
