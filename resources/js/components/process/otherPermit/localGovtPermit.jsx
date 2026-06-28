import React from 'react';

export default function LocalGovtPermit({
    vehicleDocuments, setVehicleDocuments, vehicleMake, setVehicleMake,
      contactAddress, setContactAddress, vehicleModel, setVehicleModel, 
      registrationNumber, setRegistrationNumber, handleFileChange, errors
 }) {
return (
<>
    <br />
    <div className="row">
        <div className="col-md-1 mb-2"></div>
        <div className="col-md-10">
            <h6 class="mb-0 text-dark"><b>Personal Information for Local Govt. Permit (Motorcycle)</b></h6>
            <hr>
            </hr>
        </div>
        <div className="col-md-1 mb-2"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Name on Vehicle Documents </label>
            <input type="text" className="form-control" value={vehicleDocuments} placeholder='Name' onChange={(e)=>
            setVehicleDocuments (e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Vehicle Make</label>
            <input type="text" className="form-control" value={vehicleMake} placeholder='Vehicle Make' onChange={(e)=>
            setVehicleMake(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Vehicle Model</label>
            <input type="text" className="form-control" value={vehicleModel} placeholder='Vehicle Model'
                onChange={(e)=> setVehicleModel(e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Registration Number </label>
            <input type="text" className="form-control" value={registrationNumber} placeholder='Registration Number' onChange={(e)=>
            setRegistrationNumber(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>
    
    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-10 mb-2">
            <label for="inputFirstName" class="form-label"> Contact Address</label>
            <textarea rows='3' value={contactAddress} onChange={(e)=> setContactAddress(e.target.value)}  required type="text" name="address" placeholder="Contact Address" class="form-control"
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
                    <input required class="form-control" onChange={handleFileChange}  id="picsVehicleLicense" type="file" accept=".jpg, .png, image/jpeg, image/png"  name="picsVehicleLicense" />
                    {errors.passport && <small style={{ color: 'red' }}>{errors.passport[0]}</small>}
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meansofID" class="form-label">Means of ID </label>
                    <input required class="form-control" onChange={handleFileChange}  id="meansofID" type="file" name="meansofID" />
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
