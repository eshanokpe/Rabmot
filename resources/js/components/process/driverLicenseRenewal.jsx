import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

export default function DriverLicenseRenewal() {
    
    const url = window.location.origin;
    const [stateList, setStateList] = useState([]);
    const [stateId, setStateId] = useState('');

    const [lengthYearList, setLengthYearsList] = useState([]);
    const [lengthYear, setLengthYear] = useState('');

    
    const [firstName, setSelectedFirstName] = useState('');
    const [middleName, setSelectedMiddleName] = useState('');
    const [lastName, setLastName] = useState('');
    const [emailAddress, setEmailAddress] = useState('');
    const [dob, setDOB] = useState('');
    const [phoneNumber, setPhoneNumber] = useState('');
    const [contactAddress, setContactAddress] = useState('');
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
    const handleDOB = (e) =>{
        setDOB(e.target.value);
    }
    const handlePhoneNumber = (e) =>{
        setPhoneNumber(e.target.value);
    }
   
    const handleContactAddress = (e) =>{
        setContactAddress(e.target.value);
    }
    const handleEmailAddress = (e) =>{
        setEmailAddress(e.target.value);
    }

    useEffect(() => {
        axios.get(`${url}/home/get-state-driverlicenserenewal`)
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
        axios.post(`${url}/home/get-driverlicenserenewal-lengthYears`, {
                stateId
            })
            .then(response => {
                console.log('Success Length:', response.data);
                setLengthYearsList(response.data.lengthYearsList  || []);
            })
            .catch(error => {
                console.error('Error sending :', error);
            });
        
    }, [stateId]);

    useEffect(() => {
        axios.post(`${url}/home/get-driverlicenserenewal-price`, {
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

    const [files, setFiles] = useState({
        expiredDriverLicense: null,
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
        formData.append('lengthYear', lengthYear);
        formData.append('firstName', firstName);
        formData.append('middleName', middleName);
        formData.append('lastName', lastName);
        formData.append('emailAddress', emailAddress);
        formData.append('dob', dob);
        formData.append('phoneNumber', phoneNumber);
        formData.append('contactAddress', contactAddress);
        formData.append('totalAmount', totalAmount);

        formData.append('expiredDriverLicense', files.expiredDriverLicense);
       
        try {
            const response = await axios.post(`${url}/home/post/driverlicenserenewal`, formData, {
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
                                            Driver License Renewal
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
                                    <h5 className="mb-0 text-primary"> Driver License Renewal</h5>
                                </div>
                                <hr />

                        
                                <div className="card border-top border-0 border-4 border-primary">
                                    <div className="row">
                                        <div className="col-12 col-lg-12 col-xl-12">
                                            <div className="radius-15">
                                                <div class="card-body">
                                                    <h6 class="text-justify text-success card-title">
                                                        INSTRUCTION
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>Choose the desired duration of validity.</b>
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                        You'll obtain the temporary paperwork within 72 hours. Your 
                                                        physical presence is required only if there are any errors, for 
                                                        which we'll schedule a recapture session. 
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                    The processing of your 
                                                        permanent driver's license will take about three weeks.
                                                        After this, within two to three weeks, an SMS notification will inform 
                                                        you about the availability of your permanent card. We will then 
                                                        handle the collection and delivery of the card to your doorstep.
                                                    </h6> 
                                                    <h6 class="text-justify card-title text-danger">
                                                        TIMELINE 
                                                    </h6>
                                                    <h6 class="card-subtitle mb-2">
                                                        <b>Driver’s License Renewal</b> [72 Hours - 3 weeks]
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
                                                        <label for="inputFirstName" class="form-label"> Email Address </label>
                                                        <input required value={emailAddress || ''}  onChange={handleEmailAddress} type="text" name="motherMaidenName" placeholder="Mother Maiden Name" class="form-control" id="motherMaidenName"/>
                                                    </div>
                                                    <div className="col-md-1 "></div>
                                                </div>


                                                <div className="row ">
                                                    <div className="col-md-1 "></div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Phone number </label>
                                                        <input required value={phoneNumber || ''}  onChange={handlePhoneNumber} type="text" name="phonenumber" placeholder="Phone number" class="form-control" id="phonenumber"/>
                                                    </div>
                                                    <div className="col-md-5 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Date of birth </label>
                                                        <input required value={dob || ''} placeholder='Date of birth'  onChange={handleDOB} type="date" name="dateofbirth" class="form-control" id="dateofbirth"/>
                                                    </div>
                                                    <div className="col-md-1"></div>
                                                </div>
                                               
                                 
                                                <div className="row">
                                                    <div className="col-md-1"></div>
                                                   
                                                    <div className="col-md-10 mb-2">
                                                        <label for="inputFirstName" class="form-label"> Contact Address  </label>
                                                        <textarea required placeholder='Contact Address '  type="text" value={contactAddress || ''} onChange={handleContactAddress}  name="residentaddress" class="form-control" id="residentaddress"></textarea>
                                                    </div>
                                                    <div className="col-md-1"></div>
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
                                                                <div className="col-md-12 mb-2">
                                                                    <label for="inputAddress2" className="form-label">Expired Driver License</label> 
                                                                    <input required onChange={handleFileChange} id="expiredDriverLicense" class="form-control" type="file" name="expiredDriverLicense"  multiple/>
                                                                    {errors.expiredDriverLicense && <small style={{ color: 'red' }}>{errors.expiredDriverLicense[0]}</small>}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div className="col-md-1 mb-2"></div>
                                                </div>

                 
                                                <div className='row'>
                                                    <div className="col-md-1 mb-1"></div>
                                                    <div className="col-md-10 align-items-center text-center">
                                                        <div id="mainPrice" className="alert alert-info mt-3">
                                                        Total Amount: 
                                                        <span  >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>
                                                        </div>
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

if (document.getElementById('driverLicenseRenewal')) {
    ReactDOM.createRoot(document.getElementById('driverLicenseRenewal')).render(
        <React.StrictMode>
            <DriverLicenseRenewal />
        </React.StrictMode>
    );
}
