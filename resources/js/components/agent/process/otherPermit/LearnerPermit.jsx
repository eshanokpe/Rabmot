import React from 'react';

export default function LearnerPermit({
    firstName, setFirstName, lastName, setLastName, states, 
    middleName, setMiddleName, maidenName, setMaidenName, emailAddress, setEmailAddress, dob, setDOB,
    maritalStatus, setMaritalStatus,
    setGender, gender, stateOrigin, setStateOrigin, lGovtPOB, setLGovtPOB, phoneNumber, setPhoneNumber,
    bloodGroup, setBloodGroup, height, setHeight, lGovtOrigin, setLGovtOrigin, nextKinName, setNextKinName,
    nextKinPhoneNumber, setNextKinPhoneNumber, contactAddressLP, setContactAddressLP, handleFileChangeLP, errors
}) {
return (
<>
    <br />
    <div className="row">
        <div className="col-md-1 mb-2"></div>
        <div className="col-md-10">
            <h6 class="mb-0 text-dark"><b>Personal Information for Learner’s Permit</b></h6>
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
            <label className="form-label"> Middle name </label>
            <input type="text" className="form-control" value={middleName} placeholder='Middle name' onChange={(e)=>
            setMiddleName(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>
    <div className="row">
        <div className="col-md-1"></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Last Name</label>
            <input type="text" className="form-control" value={lastName} placeholder='Last name' onChange={(e)=>
            setLastName(e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Mother’s maiden name</label>
            <input type="text" className="form-control" value={maidenName} placeholder='Mother’s maiden name'
                onChange={(e)=> setMaidenName(e.target.value)}
            required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Email address</label>
            <input type="email" className="form-control" value={emailAddress} placeholder='Email address' onChange={(e)=>
            setEmailAddress(e.target.value)}
            required
            />
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
        <div className="col-md-5 mb-2">
            <label className="form-label">Date of birth</label>
            <input type="date" className="form-control" value={dob}  onChange={(e)=>
            setDOB(e.target.value)}
            required
            />
        </div>
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
        <div className="col-md-1"></div>
    </div>

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-5 mb-2">
        <label className="form-label">Local Government of origin</label> 
            <input type="text" className="form-control" value={lGovtOrigin} placeholder='Local Government of origin' onChange={(e)=>
            setLGovtOrigin(e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">State of origin</label>
            <select required value={stateOrigin || '' } onChange={(e)=> setStateOrigin(e.target.value)}
                name="gender" id="gender"
                className="form-select">
                <option disabled selected="selected" value="">-- Select State --</option>
                {states.map((state, index) => (
                <option key={index} value={state}>{state}</option>
                ))}
            </select>
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Local Govt Place of birth</label>
            <input type="date" className="form-control" value={lGovtPOB} placeholder='Local Govt place of birth'
                onChange={(e)=> setLGovtPOB(e.target.value)}
            required
            />
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Phone number </label>
            <input type="number" className="form-control" value={phoneNumber} placeholder='Phone number' onChange={(e)=>
            setPhoneNumber(e.target.value)} required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-5 mb-2">
            <label className="form-label"> Blood Group </label>
            <select required value={bloodGroup}  onChange={(e)=> setBloodGroup(e.target.value)} name="bloodgroup" id="inputState" class="form-select">
                <option selected disabled> --Select Blood group-- </option>
                <option value="A">Blood Group A</option>
                <option value="B">Blood Group B</option>
                <option value="AB">Blood Group AB</option>
                <option value="O">Blood Group O</option>
            </select>
        </div>
        <div className="col-md-5 mb-2">
            <label className="form-label">Height </label>
            <input type="number" className="form-control" value={height} placeholder='Height' onChange={(e)=>
            setHeight(e.target.value)} required
            />
        </div>
        <div className="col-md-1"></div>
    </div>

    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-5 mb-2">
            <label for="inputFirstName" class="form-label"> Next of kin name </label>
            <input required type="text" value={nextKinName} onChange={(e)=> setNextKinName(e.target.value)} name="nextofkinname" placeholder="Next of kin name " class="form-control"
                id="nextofkinname" />

        </div>
        <div className="col-md-5 mb-2">
            <label for="inputFirstName" class="form-label"> Next of kin phone number</label>
            <input required type="number" value={nextKinPhoneNumber} onChange={(e)=> setNextKinPhoneNumber(e.target.value)} name="nextofkinphonenumber" placeholder="Next of kin phone number "
                class="form-control" id="nextofkinphonenumber" />

        </div>
        <div className="col-md-1"></div>
    </div>
   
    
    <div className="row ">
        <div className="col-md-1 "></div>
        <div className="col-md-10 mb-2">
            <label for="inputFirstName" class="form-label"> Contact Address</label>
            <textarea rows='3' value={contactAddressLP} onChange={(e)=> setContactAddressLP(e.target.value)}  required type="text" name="address" placeholder="Contact Address" class="form-control"
                id="address" ></textarea>

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
                    <label for="passport" class="form-label">Passport Photograph </label>
                    <input  class="form-control" onChange={handleFileChangeLP}  id="passport" type="file" accept=".jpg, .png, image/jpeg, image/png"  name="passport" />
                    {errors.passport && <small style={{ color: 'red' }}>{errors.passport[0]}</small>}
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meansofID" class="form-label">Means of ID </label>
                    <input  class="form-control" onChange={handleFileChangeLP}  id="meansofID" type="file" name="meansofID" />
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
