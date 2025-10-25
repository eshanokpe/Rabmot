import React from 'react';

export default function CMRIS({
    firstName, setFirstName, 
    lastName, setLastName, 
    emailAddress, setEmailAddress, 
    phoneNumber, setPhoneNumber,
    nin, setNIN,
    handleFileChangeTP, errors
}) {
return (
<>
    <br />
    <div className="row">
        <div className="col-md-1 mb-2"></div>
        <div className="col-md-10">
            <h6 class="mb-0 text-dark"><b>Personal Information for CRMIS</b></h6>
            <hr>
            </hr>
        </div>
        <div className="col-md-1 mb-2"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">First Name</label>
            <input type="text" className="form-control" value={firstName} placeholder='First name' onChange={(e)=>
            setFirstName(e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Last Name</label>
            <input type="text" className="form-control" value={lastName} placeholder='Last name' onChange={(e)=>
            setLastName(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>
    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Email address</label>
            <input type="email" className="form-control" placeholder='Email address' 
            value={emailAddress}
            onChange={(e)=> setEmailAddress(e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">NIN</label>
            <input required type="number" name="nin" placeholder="National Identity Number" class="form-control" 
                value={nin}
                onChange={(e)=> setNIN(e.target.value)}
            />
                                                   
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-10 mb-2">
            <label className="form-label">Phone number </label>
            <input type="number" className="form-control" value={phoneNumber} placeholder='Phone number' onChange={(e)=>
            setPhoneNumber(e.target.value)} required
            />
        </div>
        
        <div className="col-md-1"></div>
    </div>


    <div className="row">
    <div className="col-md-1"></div>
    <div class="card col-md-10 radius-10 mt-3 mb-3">
        <div class="card-body">
            <div class="card-title">
                <p class="mb-0"><b>Upload Passport and Means of ID </b></p>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="passport" class="form-label">Picture of the Vehicle License  </label>
                    <input required class="form-control" onChange={handleFileChangeTP}  id="picsVehicleLicense" type="file" name="picsVehicleLicense" />
                    {errors.passport && <small style={{ color: 'red' }}>{errors.passport[0]}</small>}
                </div> 

                <div class="col-md-6 mb-3">
                    <label for="passport" class="form-label">Proof Of Ownership  </label>
                    <input required class="form-control" onChange={handleFileChangeTP}  id="proofOwnership" type="file"  name="proofOwnership" />
                    {errors.proofOwnership && <small style={{ color: 'red' }}>{errors.proofOwnership[0]}</small>}
                </div>


            </div>
        </div>
    </div>
    <div className="col-md-1"></div>
    </div>

</>
);
}
