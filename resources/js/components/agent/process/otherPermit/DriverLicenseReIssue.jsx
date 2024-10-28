import React from 'react';

export default function DriverLicenseReIssue({
    lengthOfYears, setLengthOfYears, 
    lastName, setLastName, 
    driverLicenseNumber, setDriverLicenseNumber, dob ,setDOB,
    setReason, reason, nextKinName, setNextKinName, 
    nextKinPhoneNumber, setNextKinPhoneNumber, classLicenses, setClassLicenses,
    contactAddressCBT, setContactAddressCBT, handleFileChangeCBT, errors
 }) {
return (
<>
    <br />
    <div className="row">
        <div className="col-md-1 mb-2"></div>
        <div className="col-md-10">
            <h6 class="mb-0 text-dark"><b>Personal Information for Driver’s License Re-Issue</b></h6>
            <hr>
            </hr>
        </div>
        <div className="col-md-1 mb-2"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-10 mb-2">
            <label for="inputFirstName" class="form-label">Select the Length of Years  </label>
            <select class="form-select" id="mySelect2" name="lengthofyears" aria-label="Default select example"
            value={ lengthOfYears || '' } onChange={(e)=> setLengthOfYears(e.target.value)}>
                <option  disabled selected="selected" value="" >-- Select the Length of Years   --</option>
                <option value="5">5 Years</option>
                <option value="3">3 Years</option>
            </select>
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-10 mb-2">
            <label className="form-label">Name on Driver’s License </label>
            <input type="text" className="form-control" value={lastName} placeholder='Name on Driver’s License ' 
            onChange={(e)=> setLastName(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label for="inputFirstName" class="form-label"> Driver License Number</label>
            <input  required type="text" name="driverlicensenumber" placeholder=" Driver License Number" class="form-control" id="vehiclebrand"  
            value={driverLicenseNumber} onChange={(e)=> setDriverLicenseNumber(e.target.value)} />
        </div>

        <div className="col-md-5 mb-2">
            <label className="form-label">Date of birth</label>
            <input type="date" className="form-control" 
            value={dob}  
            onChange={(e)=> setDOB(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label for="inputFirstName" class="form-label">Name of Next of Kin</label>
            <input  required type="text" name="driverlicensenumber" placeholder="Name of Next of Kin" class="form-control"
            id="vehiclebrand" value={nextKinName} onChange={(e)=> setNextKinName(e.target.value)}  />
        </div>

        <div className="col-md-5 mb-2">
            <label className="form-label">Next of Kin Phone Number</label>
            <input type="number" className="form-control" 
            value={nextKinPhoneNumber} 
            onChange={(e)=> setNextKinPhoneNumber(e.target.value)} 
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-10 mb-2">
            <label for="inputFirstName" class="form-label"> Class of License </label>
            <select required name="classoflicense" id="inputState" class="form-select"
            value={ classLicenses || '' } onChange={(e)=> setClassLicenses(e.target.value)} >
                <option disabled selected="selected" value="">Class of Licenses </option>
                <option value="A"> A </option>
                <option value="B">B </option>
                <option value="C"> C </option>
                <option value="D"> D </option>
                <option value="E">E </option>
                <option value="F"> F </option>
                <option value="G"> G </option>
                <option value="H">H </option>
                <option value="I"> I </option>
                <option value="J"> J </option>
                <option value="V">V </option>
            </select>
        </div>

        <div className="col-md-1"></div>
    </div>

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-10 mb-2">
            <label for="inputFirstName" class="form-label">  Address</label>
            <textarea rows='3' value={contactAddressCBT} onChange={(e)=> setContactAddressCBT(e.target.value)}  required type="text" name="address"  class="form-control"
                id="address" ></textarea>

        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-10 mb-2">
            <label for="inputFirstName" class="form-label"> Reason for Re-Issue </label>
            <textarea rows='3' value={reason} onChange={(e)=> setReason(e.target.value)}  required type="text" name="address"  class="form-control"
                id="address" ></textarea>

        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
    <div className="col-md-1"></div>
    <div class="card col-md-10 radius-10 mt-3 mb-3">
        <div class="card-body">
            <div class="card-title">
                <p class="mb-0"><b>Upload Driver’s License, Affidavit and Police Report</b></p>
            </div>
            <hr />
            <div class="row">
                
                <div class="col-md-6 mb-3">
                    <label for="passport" class="form-label">Picture of the Driver’s License </label>
                    <input  class="form-control" onChange={handleFileChangeCBT}  id="picsVehicleLicense" type="file" accept=".jpg, .png, image/jpeg, image/png"  name="picsVehicleLicense" />
                    {errors.passport && <small style={{ color: 'red' }}>{errors.passport[0]}</small>}
                </div>

                <div class="col-md-6 mb-3">
                    <label for="passport" class="form-label">Affidavit </label>
                    <input  class="form-control" onChange={handleFileChangeCBT}  id="affidavit" type="file" accept=".jpg, .png, image/jpeg, image/png"  name="affidavit" />
                    {errors.affidavit && <small style={{ color: 'red' }}>{errors.affidavit[0]}</small>}
                </div>

                <div class="col-md-6 mb-3">
                    <label for="passport" class="form-label">Police Report </label>
                    <input  class="form-control" onChange={handleFileChangeCBT}  id="policereport" type="file" accept=".jpg, .png, image/jpeg, image/png"  name="policereport" />
                    {errors.policereport && <small style={{ color: 'red' }}>{errors.policereport[0]}</small>}
                </div>

            </div>
        </div>
    </div>
    <div className="col-md-1"></div>
    </div>

</>
);
}
