import React from 'react';

export default function AffidavitsPoliceReport({
    firstName, setFirstName, lastName, setLastName, gender, setGender, 
    maritalStatus, setMaritalStatus, setPurpose, purpose,
      contactAddressCBT, setContactAddressCBT, handleFileChangeCBT, errors
 }) {
return (
<>
    <br />
    <div className="row">
        <div className="col-md-1 mb-2"></div>
        <div className="col-md-10">
            <h6 class="mb-0 text-dark"><b>Personal Information for Affidavits and Police Report</b></h6>
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
            <input type="text" className="form-control" value={lastName} placeholder='Middle name' onChange={(e)=>
            setLastName(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Select marital status</label>
            <select required value={maritalStatus || '' } onChange={(e)=> setMaritalStatus(e.target.value)}name="gender"
                id="gender"
                className="form-select">
                <option disabled selected="selected" value="">Select Marital status </option>
                <option value="Single"> Single </option>
                <option value="Married"> Married </option>
                <option value="Divorced"> Divorced </option>
            </select>
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Select Gender</label>
            <select required value={gender || '' } onChange={(e)=> setGender(e.target.value)}name="gender"
                id="gender"
                className="form-select">
                <option disabled selected="selected" value="">Select Gender</option>
                <option value="Male"> Male </option>
                <option value="Female"> Female </option>
            </select>
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

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-10 mb-2">
            <label for="inputFirstName" class="form-label"> Purpose </label>
            <textarea rows='3' value={purpose} onChange={(e)=> setPurpose(e.target.value)}  required type="text" name="address" placeholder="Contact Address" class="form-control"
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
                    <label for="passport" class="form-label">Passport Photograph </label>
                    <input  class="form-control" onChange={handleFileChangeCBT}  id="passport" type="file" accept=".jpg, .png, image/jpeg, image/png"  name="passport" />
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

                <div class="col-md-6 mb-3">
                    <label for="passport" class="form-label">Picture of the Vehicle License  </label>
                    <input  class="form-control" onChange={handleFileChangeCBT}  id="picsVehicleLicense" type="file" accept=".jpg, .png, image/jpeg, image/png"  name="picsVehicleLicense" />
                    {errors.passport && <small style={{ color: 'red' }}>{errors.passport[0]}</small>}
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meansofID" class="form-label">Means of ID </label>
                    <input  class="form-control" onChange={handleFileChangeCBT}  id="meansofID" type="file" name="meansofID" />
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
