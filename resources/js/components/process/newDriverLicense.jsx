import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

export default function NewDriverLicense() {
    
    const url = window.location.origin;
    const [stateList, setStateList] = useState([]);
    const [stateId, setStateId] = useState('');

    const [lengthYearList, setLengthYearsList] = useState([]);
    const [lengthYear, setLengthYear] = useState('');

    
    const [firstName, setSelectedFirstName] = useState('');
    const [middleName, setSelectedMiddleName] = useState('');
    const [lastName, setLastName] = useState('');
    const [motherMaidenName, setMotherMaidenName] = useState('');
    const [emailAddress, setEmailAddress] = useState('');
    const [nin, setNin] = useState('');
    const [dob, setDOB] = useState('');
    const [gender, setGender] = useState('');
    const [userState, setHandleUserState] = useState('');
    const [phoneNumber, setPhoneNumber] = useState('');
    const [contactAddress, setContactAddress] = useState('');
    const [localGovernmentPOB, setLocalGovernmentPOB] = useState('');
    const [bloodGroup, setBloodGroup] = useState('');
    const [maritalStatus, setMaritalStatus] = useState('');
    const [localGovernment, setLocalGovernment] = useState('');
    const [height, setHeight] = useState('');
    const [nextofkinName, setNextofkinName] = useState('');
    const [phoneNextofkinName, setphoneNextofkinName] = useState('');

    const [errors, setErrors] = useState({});

    const [totalAmount, setTotalAmount] = useState(0.00); 
    
    const handleStateChange = (event) => {
        setStateId(event.target.value);
    };
    const handleLengthYears = (e) =>{
        setLengthYear(e.target.value);
    }
    const handleLastName = (e) => {
        setLastName(e.target.value);
    }
    const handleMiddleName = (e)=>{
        setSelectedMiddleName(e.target.value);
    }
    const handleFirstName = (e)=>{
        setSelectedFirstName(e.target.value);
    }
    const handleNIN = (e) =>{
        setNin(e.target.value);
    }
    const handleGender = (e) =>{
        setGender(e.target.value);
    }
    const handleDOB = (e) =>{
        setDOB(e.target.value);
    }
    const handleUserState= (e)=>{
        setHandleUserState(e.target.value);
    }
    const handlePhoneNumber = (e) =>{
        setPhoneNumber(e.target.value);
    }
    const handleLocalGovernment =(e)=>{
        setLocalGovernment(e.target.value);
    }
    const handleLocalGovernmentPOB =(e)=>{
        setLocalGovernmentPOB(e.target.value);
    }
    const handleBloodGroup = (e) =>{
        setBloodGroup(e.target.value);
    }
    const handleMaritalStatus = (e) =>{
        setMaritalStatus(e.target.value);
    }
    const handleNextofkinName = (e) =>{
        setNextofkinName(e.target.value);
    }
    const handlPhoneNextofkinName = (e) =>{
        setphoneNextofkinName(e.target.value);
    }
    const handleHeight = (e) =>{
        setHeight(e.target.value);
    }
    const handleContactAddress = (e) =>{
        setContactAddress(e.target.value);
    }
    const handleMotherMaidenName = (e) => {
        setMotherMaidenName(e.target.value);
    }

    const handleEmailAddress = (e) =>{
        setEmailAddress(e.target.value);
    }

    useEffect(() => {
        axios.get(`${url}/home/get-state-newdriverlicense`)
            .then(response => {
                console.log('Success', response.data);
                setStateList(response.data.stateList);
            })
            .catch(error => {
                console.error('Error fetching vehicle data:', error);
               
            });
    }, [url]);

    useEffect(() => {
        setLengthYearsList([]);
        axios.post(`${url}/home/get-new-newdriverlicense-lengthYears`, {
                stateId
            })
            .then(response => {
                console.log('Success Length:', response.data);
                setLengthYearsList(response.data.lengthYears  || []);
            })
            .catch(error => {
                console.error('Error sending :', error);
            });
        
    }, [stateId]);

    useEffect(() => {
        axios.post(`${url}/home/get-new-newdriverlicense-price`, {
                stateId,
                lengthYear
            })
            .then(response => {
                console.log('Success Amount:', response.data);
                setTotalAmount(response.data.amount);
            })
            .catch(error => {
                console.error('Error sending :', error);
            });
        
    }, [lengthYear, stateId]);

  
    

   const handleSubmit = async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('userType', 'user');
        formData.append('stateId', stateId);
        formData.append('lengthYear', lengthYear);
        formData.append('firstName', firstName);
        formData.append('middleName', middleName);
        formData.append('lastName', lastName);
        formData.append('motherMaidenName', motherMaidenName);
        formData.append('emailAddress', emailAddress);
        formData.append('dob', dob);
        formData.append('nin', nin);
        formData.append('gender', gender);
        formData.append('phoneNumber', phoneNumber);
        formData.append('userState', userState);
        formData.append('localGovernment', localGovernment);
        formData.append('localGovernmentPOB', localGovernmentPOB);
        formData.append('maritalStatus', maritalStatus);
        formData.append('bloodGroup', bloodGroup);
        formData.append('height', height);
        formData.append('nextofkinName', nextofkinName);
        formData.append('phoneNextofkinName', phoneNextofkinName);
        formData.append('contactAddress', contactAddress);
        formData.append('totalAmount', totalAmount);
       
        try {
            const response = await axios.post(`${url}/home/post/newdriverlicense`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            console.log('Upload successful', response.data);
            setTimeout(()=>{
                window.location.href = `${url}/home/cart`;
            },1100)
            setErrors({});
        } catch (error) {
            console.error('Error uploading files', error);
            if (error.response && error.response.data && error.response.data.errors) {
                setErrors(error.response.data.errors); 
            }
        }
    };

    const states = [
        'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta',
        'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi',
        'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba',
        'Yobe', 'Zamfara', 'FCT'
      ];



    return (
        <>
            <div className="page-wrapper">
                <div className="page-content-wrapper">
                    <div className="page-content">
                        <div className="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                            <div className="breadcrumb-title pe-3">Vehicle</div>
                            <div className="ps-3">
                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb mb-0 p-0">
                                        <li className="breadcrumb-item">
                                            <a href='home'>
                                                <i className="bx bx-home-alt"></i>
                                            </a>
                                        </li>
                                        <li className="breadcrumb-item active" aria-current="page">
                                            New Driver License
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-xl-10 mx-auto">
                                <div className="card-title d-flex align-items-center">
                                    <div>
                                        <i className="bx bxs-car me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 className="mb-0 text-primary"> New Driver License</h5>
                                </div>
                                <hr />

                        
                                <div className="card border-top border-0 border-4 border-primary">
                                    <div className="row">
                                        <div className="col-12 col-lg-12 col-xl-12">
                                            <div className="radius-15">
                                                <div class="card-body">
                                                    <h6 class="text-justify text-success card-title">
                                                        INSTRUCTION:
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>Select the number of years of validity you require.</b>
                                                    </h6>
                                                    <h6 class="text-justify text-primary card-title">
                                                        PROCESS:
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                        It takes 6 weeks, and you will only show up once for capturing and CBT In the 
                                                        4th week and you will receive your temporary card immediately. Then, two 
                                                        weeks later, an SMS will be sent to you stating your permanent card is ready… 
                                                        then we will pick it up and deliver it to your doorstep.
                                                    </h6> 
                                                    <h6>
                                                        <b>Note:</b> We only process new driver’s licenses in Lagos, Abuja, Ibadan, and 
                                                        Anambra State
                                                    </h6>
                                                    <h6 class="text-justify card-title text-danger">
                                                        TIMELINE
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>Processing and Delivery Time:</b> 4-6 weeks
                                                    </h6> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        
                      
                                <div className="card border-top border-0 border-4 border-primary">
                                    
                                    <div className="row card-body p-4">
                                        <form id="form_calc" action='' onSubmit={handleSubmit}>
                                            
                                            <div className="ct_opt card-body" id="ct_opt">
                                                <div className="row ">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-10 mb-2">
                                                        <label  className="form-label">Select State</label>
                                                        <select required  value={stateId || ''}  onChange={handleStateChange}
                                                            className="form-select" id="stateId" >
                                                            <option disabled value="">-- Select State --</option>
                                                            {stateList.map((state, index) => (
                                                            <option key={index}  value={state.id}>
                                                                {state.name}
                                                            </option>
                                                            ))}
                                                        </select>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>
                                                <div className="row">
                                                    <div className="col-md-1"></div>
                                                    <div class=" col-md-10 mb-2">
                                                        <label for="inputState" class="form-label">Select length of years</label>
                                                        <select required name="lengthofyear" id="lengthofyear" class="form-select" value={lengthYear || ''}  onChange={handleLengthYears}>
                                                            <option disabled value='' >-- Select length of years --</option>
                                                            {lengthYearList.map((length) =>(
                                                            <option value={length.years_type}>
                                                                {length.years_type} Years
                                                            </option>
                                                            ))}
                                                        </select>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>
                                                
                                                <br/>
                                                <div className="row">
                                                    <div className="col-md-1 mb-2"></div>
                                                    <div className="col-md-10">
                                                        <h6 class="mb-0 text-dark"><b>Personal Information & Documents</b></h6>
                                                        <hr></hr>
                                                    </div>
                                                    <div className="col-md-1 mb-2"></div>
                                                </div>
                                                

                                                <div className="row ">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label">  First name </label>
                                                        <input required value={firstName || ''}  onChange={handleFirstName} type="text" name="firstname" placeholder="Firstname" class="form-control" id="firstname"/>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Last name  </label>
                                                        <input required value={lastName || ''}  onChange={handleLastName} type="text" name="email" placeholder="Last name" class="form-control" id="lastname"/>
                                                    </div>
                                                   
                                                    <div className="col-md-1 "></div>
                                                </div>
                                               
                                                <div className="row">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Middle name </label>
                                                        <input required value={middleName || ''}  onChange={handleMiddleName}  type="text" name="middlename" placeholder="Middle name" class="form-control" id="middlename"/>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Mother’s maiden name</label>
                                                        <input required value={motherMaidenName || ''}  onChange={handleMotherMaidenName} type="text" name="motherMaidenName" placeholder="Mother Maiden Name" class="form-control" id="motherMaidenName"/>
                                                    </div>
                                                    <div className="col-md-1 "></div>
                                                </div>

                                                <div className="row ">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> NIN </label>
                                                        <input required value={nin || ''}  onChange={handleNIN}  type="number" name="nin" placeholder="NIN" class="form-control" id="nin"/>
                                                        {errors.nin && <small style={{ color: 'red' }}>{errors.nin[0]}</small>}
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Email Address </label>
                                                        <input required value={emailAddress || ''}  onChange={handleEmailAddress} type="text" name="motherMaidenName" placeholder="Mother Maiden Name" class="form-control" id="motherMaidenName"/>
                                                    </div>
                                                    <div className="col-md-1 m"></div>
                                                </div>

                                                <div className="row ">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label className="form-label">Select Gender</label>
                                                        <select required value={gender || ''}  onChange={handleGender} name="gender" id="gender" className="form-select"  >
                                                            <option disabled selected="selected" value="">Select Gender</option>
                                                            <option value="Male"> Male </option>
                                                            <option value="Female"> Female </option>
                                                        </select>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Date of birth </label>
                                                        <input required value={dob || ''} placeholder='Date of birth'  onChange={handleDOB} type="date" name="dateofbirth" class="form-control" id="dateofbirth"/>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>
                                               
                                                <div className="row ">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label htmlFor="inputState" className="form-label">State</label>
                                                        <select required name="state" id="inputState" className="form-select" value={userState} onChange={handleUserState}>
                                                            <option disabled value="">Select State</option>
                                                            {states.map((state, index) => (
                                                            <option key={index} value={state}>
                                                                {state}
                                                            </option>
                                                            ))} 
                                                        </select>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Phone number </label>
                                                        <input required value={phoneNumber || ''}  onChange={handlePhoneNumber} type="text" name="phonenumber" placeholder="Phone number" class="form-control" id="phonenumber"/>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>

                                                <div className="row">
                                                    <div className="col-md-1"></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Local government of origin </label>
                                                        <input required value={localGovernment} onChange={handleLocalGovernment} type="text" placeholder='Local government' name="localgovernment" class="form-control" id="localgovernment"/>
                                                    </div>
                                                    
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Local government place of birth  </label>
                                                        <input required value={localGovernmentPOB} onChange={handleLocalGovernmentPOB} type="text" placeholder='Local government' name="localgovernment" class="form-control" id="localgovernment"/>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>

                                                <div className="row ">
                                                    <div className="col-md-1"></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label htmlFor="vehicleForm" className="form-label">Select Marital status</label>
                                                        <select required value={maritalStatus || ''}  onChange={handleMaritalStatus} name="addVehicleOwnership" id="addVehicleOwnership" className="form-select" >
                                                            <option disabled selected="selected" value="">Select Marital status </option>
                                                            <option value="Single"> Single </option>
                                                            <option value="Married"> Married </option>
                                                            <option value="Divorced"> Divorced </option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div className="col-md-5 mb-2">
                                                        <label htmlFor="vehicleForm" className="form-label">Blood group </label>
                                                        <select required value={bloodGroup || ''}  onChange={handleBloodGroup} name="addVehicleOwnership" id="addVehicleOwnership" className="form-select" >
                                                            <option disabled selected="selected" value="">Select Blood group</option>
                                                            <option value="A">Blood Group A</option>
                                                            <option value="B">Blood Group B</option>
                                                            <option value="AB">Blood Group AB</option>
                                                            <option value="O">Blood Group O</option>
                                                        </select>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>

                                                <div className="row">
                                                    <div className="col-md-1"></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Height </label>
												        <input required  type="text" value={height || ''}  onChange={handleHeight} name="height" placeholder="Height " class="form-control" id="phone"/>
                                                    </div>
                                                    
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Next of kin name </label>
												        <input required  type="text" value={nextofkinName || ''}  onChange={handleNextofkinName} name="nextofkinname" placeholder="Next of kin name " class="form-control" id="phone"/>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>

                                                <div className="row">
                                                    <div className="col-md-1"></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Phone number of Next of kin  </label>
                                                        <input required placeholder='Phone number of Next of Kin'  type="text" value={phoneNextofkinName || ''} onChange={handlPhoneNextofkinName}  name="residentaddress" class="form-control" id="residentaddress"/>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Contact Address  </label>
                                                        <input required placeholder='Contact Address '  type="text" value={contactAddress || ''} onChange={handleContactAddress}  name="residentaddress" class="form-control" id="residentaddress"/>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>

                 
                                                <div className='row'>
                                                    <div className="col-md-1 mb-1"></div>
                                                    <div className="card-body col-md-10 align-items-center text-center">
                                                        <div id="mainPrice" className="alert alert-info mt-3">
                                                        Total Amount: 
                                                        <span  >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>

                                                        </div>
                                                    </div>
                                                    <div className="col-md-1 mb-0"></div>
                                                    <div className="col-md-1 mb-0"></div>
                                                    <div className="card-body col-md-10 align-items-center text-center">
                                                        <h5 class="mb-0 text-dark"><b>Processing Time:</b> 4 - 6 weeks</h5>
                                                    </div>
                                                    <div className="col-md-1 mb-0"></div>
                                                </div>
                                            </div>


                                            <div className=" col-md-12 align-items-center text-center ">
                                                <button type="submit" className="btn btn-primary">Process Payment</button>
                                            </div>
                                        </form>
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

if (document.getElementById('newDriverLicense')) {
    ReactDOM.createRoot(document.getElementById('newDriverLicense')).render(
        <React.StrictMode>
            <NewDriverLicense />
        </React.StrictMode>
    );
}
