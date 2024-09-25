import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

export default function DealerPateNumber() {
    
    const url = window.location.origin;
    const [stateId, setStateId] = useState('');
    const [stateList, setStateList] = useState([]);
    const [lengthYearsList, setLengthYearsList] = useState([]);
    const [fullName, setSelectedFullName] = useState('');
    const [companyName, setSelectedCompanyName] = useState('');
    const [emailAddress, setEmailAddress] = useState('');
    const [phoneNumber, setPhoneNumber] = useState('');
    const [gender, setGender] = useState('');
    const [maritalStatus, setMaritalStatus] = useState('');
    const [residentAddress, setResidentAddress] = useState('');
    const [userState, setHandleUserState] = useState('');
    const [localGovernment, setLocalGovernment] = useState('');
    const [dob, setDOB] = useState('');
    const [pob, setPOB] = useState('');
    const [errors, setErrors] = useState({});

    const [totalAmount, setTotalAmount] = useState(0.00); 
    
    const handleUserState= (e)=>{
        setHandleUserState(e.target.value);
    }
    const handleLocalGovernment =(e)=>{
        setLocalGovernment(e.target.value);
    }
    const handleResidentAddress = (e) =>{
        setResidentAddress(e.target.value);
    }
    const handleDOB = (e) =>{
        setDOB(e.target.value);
    }
    const handlePOB = (e) =>{
        setPOB(e.target.value);
    }
    const handleMaritalStatus = (e) =>{
        setMaritalStatus(e.target.value);
    }

    const handleGender = (e) =>{
        setGender(e.target.value);
    }
    const handlePhoneNumber = (e) =>{
        setPhoneNumber(e.target.value);
    }
    const handleEmailAddress = (e) =>{
        setEmailAddress(e.target.value);
    }

    const handleStateChange = (event) => {
        setStateId(event.target.value);
    };
    const handleCompanyName = (e)=>{
        setSelectedCompanyName(e.target.value);
    }
    const handleFullName = (e)=>{
        setSelectedFullName(e.target.value);
    }

    useEffect(() => {
        axios.get(`${url}/home/get-state-dealerplatenumber`)
            .then(response => {
                console.log('Success', response.data);
                setStateList(response.data.stateList);
            })
            .catch(error => {
                console.error('Error fetching vehicle data:', error);
               
            });
    }, [url]);
    
    useEffect(() => {
        // setStateList([]);
        axios
            .post(`${url}/home/get-dealer-platenumber-price`, {
                stateId
            })
            .then(response => {
                console.log('Success Amount:', response.data);
                setTotalAmount(Number(response.data.amount  || 0));
            })
            .catch(error => {
                console.error('Error sending :', error);
            });
        
    }, [stateId]);

    const [files, setFiles] = useState({
        caccertificate: null,
        passport: null,
        companyletterhead: null,
    });

    const handleFileChange = (e) => {
        const { name, files: fileList } = e.target;
        setFiles({
            ...files,
            [name]: fileList[0], // Only take the first file
        });
    };

   const handleSubmit = async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('userType', 'user');
        formData.append('stateId', stateId);
        formData.append('fullname', fullName);
        formData.append('companyName', companyName);
        formData.append('emailAddress', emailAddress);
        formData.append('phoneNumber', phoneNumber);
        formData.append('gender', gender);
        formData.append('maritalStatus', maritalStatus);
        formData.append('dob', dob);
        formData.append('pob', pob);
        formData.append('residentAddress', residentAddress);
        formData.append('userState', userState);
        formData.append('localGovernment', localGovernment);
        formData.append('totalAmount', totalAmount);
       
        formData.append('caccertificate', files.caccertificate);
        formData.append('passport', files.passport);
        formData.append('companyletterhead', files.companyletterhead);

        try {
            const response = await axios.post(`${url}/home/post/dealer/platenumber`, formData, {
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
                setErrors(error.response.data.errors); // Set validation errors
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
                                            Dealer's Pate Number
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
                                    <h5 className="mb-0 text-primary"> Dealer's Pate Number</h5>
                                </div>
                                <hr />

                        
                                <div className="card border-top border-0 border-4 border-primary">
                                    <div className="row">
                                        <div className="col-12 col-lg-12 col-xl-12">
                                            <div className="radius-15">
                                                <div class="card-body">
                                                    <h6 class="text-justify text-success card-title">
                                                        ELIGIBILITY:
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                    This license category is specifically designated for Auto Dealers 
                                                    and is not applicable to regular car users.
                                                    </h6>
                                                    <h6 class="text-justify text-success card-title">
                                                        INSTRUCTION:
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                    Please ensure the submission of all essential documents
                                                    </h6> 
                                                    <h6 class="text-justify card-title text-danger">
                                                        TIMELINE:
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>Processing and Delivery Time:</b> 4-5 weeks
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        
                      
                                <div className="card border-top border-0 border-4 border-primary">
                                    <div class="card-body radius-15">
                                        <h5 class="mb-0 text-dark"><b>Dealer's Details</b></h5>
                                        <br/>
                                    </div>
                                    <div className="row card-body p-4">
                                        <form id="form_calc" action='' onSubmit={handleSubmit}>
                                            
                                            <div className="ct_opt card-body" id="ct_opt">
                                                <div className="row mb-3">
                                                    <div className="col-md-1 mb-2"></div>
                                                    <div className="col-md-10">
                                                        <label  className="form-label">Select State</label>
                                                        <select required  value={stateId || ''}  onChange={handleStateChange}
                                                            className="form-select" id="stateId" >
                                                            <option disabled value="">-- Select State --</option>
                                                            {stateList.map((state) => (
                                                            <option key={state.id} value={state.id}>
                                                                {state.name}
                                                            </option>
                                                            ))}
                                                        </select>
                                                    </div>
                                                    <div className="col-md-1 mb-2"></div>
                                                </div>
                                               

                                                <div className="row">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Full Name </label>
                                                        <input required value={fullName || ''}  onChange={handleFullName} type="text" name="fullname" placeholder="Fullname" class="form-control" id="vehiclebrand"/>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Company Name  </label>
                                                        <input required value={companyName || ''}  onChange={handleCompanyName}  type="text" name="companyname" placeholder="Company Name" class="form-control" id="companyname"/>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>
                                               
                                                <div className="row ">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Email Address  </label>
                                                        <input required value={emailAddress || ''}  onChange={handleEmailAddress} type="text" name="email" placeholder="Email Address" class="form-control" id="email"/>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Phone number </label>
                                                        <input required value={phoneNumber || ''}  onChange={handlePhoneNumber} type="text" name="phonenumber" placeholder="Phone number" class="form-control" id="phonenumber"/>
                                                    </div>
                                                    <div className="col-md-1 "></div>
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
                                                        <label htmlFor="vehicleForm" className="form-label">Select Marital status</label>
                                                        <select required value={maritalStatus || ''}  onChange={handleMaritalStatus} name="addVehicleOwnership" id="addVehicleOwnership" className="form-select" >
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
                                                        <label for="inputFirstName" class="form-label"> Date of birth </label>
                                                        <input required value={dob || ''} placeholder='Date of birth'  onChange={handleDOB} type="date" name="dateofbirth" class="form-control" id="dateofbirth"/>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Place of birth  </label>
                                                        <input required  type="text" value={pob || ''} onChange={handlePOB} name="placeofbirth" placeholder='Place of birth'  class="form-control" id="placeofbirth"/>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>

                                                <div className="row">
                                                    <div className="col-md-1"></div>
                                                    <div className="col-md-5  mb-2">
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
                                                        <label for="inputFirstName" class="form-label"> Local government  </label>
                                                        <input required value={localGovernment} onChange={handleLocalGovernment} type="text" placeholder='Local government' name="localgovernment" class="form-control" id="localgovernment"/>
                                                    </div>
                                                    <div className="col-md-1"> </div>
                                                </div>

                                                <div className="row mb-2">
                                                    <div className="col-md-1 mb-2"></div>
                                                    <div className="col-md-10">
                                                        <label for="inputFirstName" class="form-label"> Resident Address  </label>
                                                        <textarea required placeholder='Resident Address '  type="text" value={residentAddress || ''} onChange={handleResidentAddress}  name="residentaddress" class="form-control" id="residentaddress">
                                                        </textarea>
                                                    </div>
                                                    <div className="col-md-1 mb-2"></div>
                                                </div>

                                                <div className="row mb-2 mt-4">
                                                    <div className="col-md-1 mb-2"></div>
                                                    <div class="col-md-10 card radius-10 card-body">

                                                        <div className="">
                                                            <div className="card-title">
                                                                <p className="mb-0"><b>Upload neccessary Document</b></p>
                                                                <small style={{color: 'red'}}>Upload this file formate: jpeg, docx, doc, jpg, png.</small>
                                                            </div>
                                                            <hr/>
                                                        <div className="row">
                                                                <div className="col-md-6 mb-2">
                                                                    <label for="inputAddress2" className="form-label">CAC certificate </label> 
                                                                    <input required onChange={handleFileChange} id="caccertificate" class="form-control" type="file" name="caccertificate"  multiple/>
                                                                    {errors.caccertificate && <small style={{ color: 'red' }}>{errors.caccertificate[0]}</small>}
                                                                </div>

                                                                <div class="col-md-6 mb-2">
                                                                    <label for="inputAddress2" className="form-label">Passport Photograph </label>  
                                                                    <input   onChange={handleFileChange} id="passport" className="form-control" type="file" name="passport"multiple/>                                                              
                                                                    {errors.passport && <small style={{ color: 'red' }}>{errors.passport[0]}</small>}
                                                                </div>

                                                                <div class="col-md-6 mb-2">
                                                                    <label for="inputAddress2" className="form-label">Company Letter Head </label>  
                                                                    <input   onChange={handleFileChange} id="companyletterhead" className="form-control" type="file" name="companyletterhead" multiple/>
                                                                    {errors.companyletterhead && <small style={{ color: 'red' }}>{errors.companyletterhead[0]}</small>}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div className="col-md-1 mb-2"></div>
                                                </div>
                                                <div className='row'>
                                                    <div className="col-md-1 mb-2"></div>
                                                    <div className=" col-md-10 align-items-center text-center">
                                                        <div id="mainPrice" className="alert alert-info mt-3">
                                                        Total Amount: 
                                                        <span  >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>
                                                               
                                                        </div>
                                                    </div>
                                                    <div className="col-md-1 mb-2"></div>
                                                </div>
                                            </div>


                                            <div className="  col-md-12 align-items-center text-center ">
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

if (document.getElementById('dealerPateNumber')) {
    ReactDOM.createRoot(document.getElementById('dealerPateNumber')).render(
        <React.StrictMode>
            <DealerPateNumber />
        </React.StrictMode>
    );
}
