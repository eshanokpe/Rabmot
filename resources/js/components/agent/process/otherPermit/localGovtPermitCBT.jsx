import React from 'react';

export default function LocalGovtPermitCBT({
    vehicleDocumentsCBT, setVehicleDocumentsCBT, vehicleMakeCBT, setVehicleMakeCBT,
      contactAddressCBT, setContactAddressCBT, vehicleModelCBT, setVehicleModelCBT, 
      registrationNumberCBT, setRegistrationNumberCBT, handleFileChangeCBT, errors
 }) {
return (
<>
    <br />
    <div className="row">
        <div className="col-md-1 mb-2"></div>
        <div className="col-md-10">
            <h6 class="mb-0 text-dark"><b>Personal Information for Local Govt. Permit (Cars/Buses/Trucks)</b></h6>
            <hr>
            </hr>
        </div>
        <div className="col-md-1 mb-2"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Name on Vehicle Documents </label>
            <input type="text" className="form-control" value={vehicleDocumentsCBT} placeholder='Name' onChange={(e)=>
            setVehicleDocumentsCBT (e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Vehicle Make</label>
            <input type="text" className="form-control" value={vehicleMakeCBT} placeholder='Vehicle Make' onChange={(e)=>
            setVehicleMakeCBT(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Vehicle Model</label>
            <input type="text" className="form-control" value={vehicleModelCBT} placeholder='Vehicle Model'
                onChange={(e)=> setVehicleModelCBT(e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Registration Number </label>
            <input type="text" className="form-control" value={registrationNumberCBT} placeholder='Registration Number' onChange={(e)=>
            setRegistrationNumberCBT(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>
    
    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-10 mb-2">
            <label for="inputFirstName" class="form-label"> Contact Address</label>
            <textarea rows='3' value={contactAddressCBT} onChange={(e)=> setContactAddressCBT(e.target.value)}  required type="text" name="address" placeholder="Contact Address" class="form-control"
                id="address" ></textarea>

        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
    <div className="col-md-1"></div>
    <div class="card col-md-10 radius-10 mt-3 mb-3">
        <div class="card-body">
            <div class="card-title">
                <p class="mb-0"><b>Upload Documents, and Means of ID </b></p>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="passport" class="form-label">Picture of the Vehicle License  </label>
                    <input required class="form-control" onChange={handleFileChangeCBT}  id="picsVehicleLicense" type="file" accept=".jpg, .png, image/jpeg, image/png"  name="picsVehicleLicense" />
                    {errors.passport && <small style={{ color: 'red' }}>{errors.passport[0]}</small>}
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meansofID" class="form-label">Means of ID </label>
                    <input required class="form-control" onChange={handleFileChangeCBT}  id="meansofID" type="file" name="meansofID" />
                    {errors.meansofID && <small style={{ color: 'red' }}>{errors.meansofID[0]}</small>}
                </div>
            </div>
        </div>
    </div>
    <div className="col-md-1"></div>
    </div>

</>
);
}
