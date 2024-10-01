import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';
import RiderCard from './otherPermit/riderCard';
import LocalGovtPermit from './otherPermit/localGovtPermit';
import LocalGovtPermitCBT from './otherPermit/localGovtPermitCBT';
import JBTEmblem from './otherPermit/JBTEmblem';
import MidYearPermit from './otherPermit/MidYearPermit';
import LicensePlatesNumber from './otherPermit/LicensePlatesNumber';
import AffidavitsPoliceReport from './otherPermit/AffidavitsPoliceReport';
import DriverLicenseReIssue from  './otherPermit/DriverLicenseReIssue';
import LearnerPermit from  './otherPermit/LearnerPermit';
import TintedPermit from './otherPermit/TintedPermit';
import CMRIS from './otherPermit/CMRIS';

export default function OtherPermit() {

const url = window.location.origin;
const [permitType, setPermitType] = useState([]);
const [permitTypeId, setPermitTypeId] = useState('');
//RiderCard

const [purpose, setPurpose] = useState('');
const [firstName, setFirstName] = useState('');
const [middleName, setMiddleName] = useState('');
const [lastName, setLastName] = useState('');
const [maidenName, setMaidenName] = useState('');
const [emailAddress, setEmailAddress] = useState('');
const [gender, setGender] = useState('');
const [dob, setDOB] = useState('');
const [maritalStatus, setMaritalStatus] = useState('');
const [lGovtPOB, setLGovtPOB] = useState('');
const [stateOrigin, setStateOrigin] = useState('');
const [phoneNumber, setPhoneNumber] = useState('');
const [lGovtOrigin, setLGovtOrigin] = useState('');
const [bloodGroup, setBloodGroup] = useState('');
const [height, setHeight] = useState('');
const [nextKinPhoneNumber, setNextKinPhoneNumber] = useState('');
const [nextKinName, setNextKinName] = useState('');
const [contactAddress, setContactAddress] = useState('');
//LocalGovt Permit
const [vehicleDocuments, setVehicleDocuments] = useState('');
const [vehicleMake, setVehicleMake] = useState('');
const [vehicleModel, setVehicleModel] = useState('');
const [registrationNumber, setRegistrationNumber] = useState('');

const [lengthOfYears, setLengthOfYears] = useState('');
const [driverLicenseNumber, setDriverLicenseNumber] = useState('');
const [classLicenses, setClassLicenses] = useState(''); 
const [reason, setReason] = useState(''); 

const [nin, setNIN] = useState('');

const [totalAmount, setTotalAmount] = useState(0.0);
const [errors, setErrors] = useState({});

    const handlePermitTypeChange = (event) => {
        setPermitTypeId(event.target.value);
    };

    useEffect(() => {
        axios.get(`${url}/home/get-permittype-otherpermit`)
        .then(response => {
            console.log('Success', response.data);
            setPermitType(response.data.permitType);
            })
        .catch(error => {
            console.error('Error fetching vehicle data:', error);
        });
    }, [url]);

    useEffect(() => {
        axios.post(`${url}/home/get-permittype-price`, {
            permitTypeId
        })
        .then(response => {
            console.log('Success Length:', response.data);
            setTotalAmount(response.data.amount || []);
            })
        .catch(error => {
            console.error('Error sending :', error);
        });

    }, [url,permitTypeId]);

    const [files, setFiles] = useState({
        passport: null,
        meansofID: null,
        picsVehicleLicense: null,
        proofOwnership :  null,
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
        formData.append('permitTypeId', permitTypeId);
        //RiderCard
        formData.append('firstName', firstName);
        formData.append('middleName', middleName);
        formData.append('lastName', lastName);
        formData.append('maidenName', maidenName);
        formData.append('gender', gender);
        formData.append('dob', dob);
        formData.append('maritalStatus', maritalStatus);
        formData.append('lGovtPOB', lGovtPOB);
        formData.append('stateOrigin', stateOrigin);
        formData.append('phoneNumber', phoneNumber);
        formData.append('emailAddress', emailAddress);
        formData.append('lGovtOrigin', lGovtOrigin);
        formData.append('bloodGroup', bloodGroup);
        formData.append('height', height);
        formData.append('nextKinName', nextKinName);
        formData.append('nextKinPhoneNumber', nextKinPhoneNumber);
        formData.append('contactAddress', contactAddress);
        formData.append('meansofID', files.meansofID);
        formData.append('passport', files.passport);
        formData.append('proofofownership', files.proofOwnership);

        //LocalGovt Permit
        formData.append('vehicleDocumentsName', vehicleDocuments);
        formData.append('vehicleMake', vehicleMake);
        formData.append('vehicleModel', vehicleModel);
        formData.append('registrationNumber', registrationNumber);

        formData.append('picsVehicleLicense', files.picsVehicleLicense);

        formData.append('affidavit', files.affidavit);
        formData.append('policereport', files.policereport); 

        formData.append('purpose', purpose);
        formData.append('nin', nin);
        formData.append('classLicenses', classLicenses);
        formData.append('lengthOfYears', lengthOfYears);
        formData.append('reason', reason);
        
        formData.append('totalAmount', totalAmount);


try {
        const response = await axios.post(`${url}/home/post/otherPermit`, formData, {
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
            if (error.response.data.errors.file === 'duplicate_name') {
                setErrors({ file: 'A file with this name already exists. Please rename your file and try again.' });
            } else {
                setErrors(error.response.data.errors); // Set other errors
            }
        } else {
            setErrors({ general: 'An error occurred while uploading the files' });
        }
    }
};

    const states = [
        'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta',
        'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi',
        'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba',
        'Yobe', 'Zamfara', 'FCT'
    ];

const renderPermitSpecificForm = () => {
    switch (permitTypeId) {
        case '1':
            return (
            <>
                <RiderCard firstName={firstName} setFirstName={setFirstName} lastName={lastName} setLastName={setLastName}
                    middleName={middleName} setMiddleName={setMiddleName} states={states} maidenName={maidenName}
                    setMaidenName={setMaidenName} emailAddress={emailAddress} setEmailAddress={setEmailAddress} gender={gender}
                    setGender={setGender} dob={dob} setDOB={setDOB} maritalStatus={maritalStatus}
                    setMaritalStatus={setMaritalStatus} stateOrigin={stateOrigin} setStateOrigin={setStateOrigin}
                    lGovtPOB={lGovtPOB} setLGovtPOB={setLGovtPOB} phoneNumber={phoneNumber} setPhoneNumber={setPhoneNumber}
                    bloodGroup={bloodGroup} setBloodGroup={setBloodGroup} height={height} setHeight={setHeight}
                    lGovtOrigin={lGovtOrigin} setLGovtOrigin={setLGovtOrigin} nextKinName={nextKinName}
                    setNextKinName={setNextKinName} nextKinPhoneNumber={nextKinPhoneNumber}
                    setNextKinPhoneNumber={setNextKinPhoneNumber} contactAddress={contactAddress}
                    setContactAddress={setContactAddress} errors={errors} setErrors={setErrors}
                    handleFileChange={handleFileChange} />
            </>
        );
        case '2':
        return (
        <>
            <LocalGovtPermit vehicleDocuments={vehicleDocuments} setVehicleDocuments={setVehicleDocuments}
                vehicleMake={vehicleMake} setVehicleMake={setVehicleMake} vehicleModel={vehicleModel}
                setVehicleModel={setVehicleModel} registrationNumber={registrationNumber}
                setRegistrationNumber={setRegistrationNumber} contactAddress={contactAddress}
                setContactAddress={setContactAddress} handleFileChange={handleFileChange} errors />
        </>
        );
        case '3':
        return (
        <>
            <LocalGovtPermitCBT vehicleDocumentsCBT={vehicleDocuments} setVehicleDocumentsCBT={setVehicleDocuments}
                vehicleMakeCBT={vehicleMake} setVehicleMakeCBT={setVehicleMake} vehicleModelCBT={vehicleModel}
                setVehicleModelCBT={setVehicleModel} registrationNumberCBT={registrationNumber}
                setRegistrationNumberCBT={setRegistrationNumber} contactAddressCBT={contactAddress}
                setContactAddressCBT={setContactAddress} handleFileChangeCBT={handleFileChange} errors />
        </>
        );
        case '4':
        return (
        <>
            <JBTEmblem vehicleDocumentsCBT={vehicleDocuments} setVehicleDocumentsCBT={setVehicleDocuments}
                vehicleMakeCBT={vehicleMake} setVehicleMakeCBT={setVehicleMake} vehicleModelCBT={vehicleModel}
                setVehicleModelCBT={setVehicleModel} registrationNumberCBT={registrationNumber}
                setRegistrationNumberCBT={setRegistrationNumber} contactAddressCBT={contactAddress}
                setContactAddressCBT={setContactAddress} handleFileChangeCBT={handleFileChange} errors />
        </>
        );
        case '5':
        return (
        <>
            <MidYearPermit vehicleDocumentsCBT={vehicleDocuments} setVehicleDocumentsCBT={setVehicleDocuments}
                vehicleMakeCBT={vehicleMake} setVehicleMakeCBT={setVehicleMake} vehicleModelCBT={vehicleModel}
                setVehicleModelCBT={setVehicleModel} registrationNumberCBT={registrationNumber}
                setRegistrationNumberCBT={setRegistrationNumber} contactAddressCBT={contactAddress}
                setContactAddressCBT={setContactAddress} handleFileChangeCBT={handleFileChange} errors />
        </>
        );
        case '6':
        return (
        <>
            <LicensePlatesNumber vehicleDocumentsCBT={vehicleDocuments} setVehicleDocumentsCBT={setVehicleDocuments}
                vehicleMakeCBT={vehicleMake} setVehicleMakeCBT={setVehicleMake} vehicleModelCBT={vehicleModel}
                setVehicleModelCBT={setVehicleModel} registrationNumberCBT={registrationNumber}
                setRegistrationNumberCBT={setRegistrationNumber} contactAddressCBT={contactAddress}
                setContactAddressCBT={setContactAddress} handleFileChangeCBT={handleFileChange} errors />
        </>
        );
        case '7':
        return (
        <>
            <AffidavitsPoliceReport 
                firstName={firstName} setFirstName={setFirstName} lastName={lastName} setLastName={setLastName}
                gender={gender} setGender={setGender} maritalStatus={maritalStatus} setMaritalStatus={setMaritalStatus}
                purpose = {purpose} setPurpose ={setPurpose} contactAddressCBT={contactAddress}
                setContactAddressCBT={setContactAddress} handleFileChangeCBT={handleFileChange} errors />
        </>
        );
        case '8':
            return (
            <>
                <DriverLicenseReIssue 
                    lengthOfYears={lengthOfYears} setLengthOfYears={setLengthOfYears} 
                    lastName={lastName} setLastName={setLastName}
                    driverLicenseNumber={driverLicenseNumber} setDriverLicenseNumber={setDriverLicenseNumber}
                    reason = {reason} setReason ={setReason} 
                    dob={dob} setDOB = {setDOB} 
                    nextKinName = {nextKinName} setNextKinName = {setNextKinName} 
                    nextKinPhoneNumber = {nextKinPhoneNumber} setNextKinPhoneNumber = {setNextKinPhoneNumber} 
                    classLicenses = {classLicenses} setClassLicenses = {setClassLicenses}
                    contactAddressCBT={contactAddress} setContactAddressCBT={setContactAddress} 
                    handleFileChangeCBT={handleFileChange} errors />
            </>
        );
        case '9':
            return (
            <>
                <LearnerPermit firstName={firstName} setFirstName={setFirstName} lastName={lastName} setLastName={setLastName}
                    middleName={middleName} setMiddleName={setMiddleName} states={states} maidenName={maidenName}
                    setMaidenName={setMaidenName} emailAddress={emailAddress} setEmailAddress={setEmailAddress} gender={gender}
                    setGender={setGender} dob={dob} setDOB={setDOB} maritalStatus={maritalStatus}
                    setMaritalStatus={setMaritalStatus} stateOrigin={stateOrigin} setStateOrigin={setStateOrigin}
                    lGovtPOB={lGovtPOB} setLGovtPOB={setLGovtPOB} phoneNumber={phoneNumber} setPhoneNumber={setPhoneNumber}
                    bloodGroup={bloodGroup} setBloodGroup={setBloodGroup} height={height} setHeight={setHeight}
                    lGovtOrigin={lGovtOrigin} setLGovtOrigin={setLGovtOrigin} nextKinName={nextKinName}
                    setNextKinName={setNextKinName} nextKinPhoneNumber={nextKinPhoneNumber}
                    setNextKinPhoneNumber={setNextKinPhoneNumber} contactAddressLP={contactAddress}
                    setContactAddressLP={setContactAddress} errors={errors} setErrors={setErrors}
                    handleFileChangeLP={handleFileChange} 
                />
            </>
        );
        case '10':
            return (
            <>
                <TintedPermit 
                    firstName={firstName} setFirstName={setFirstName} 
                    lastName={lastName} setLastName={setLastName} 
                    emailAddress={emailAddress} setEmailAddress={setEmailAddress} 
                    phoneNumber={phoneNumber} setPhoneNumber={setPhoneNumber} 
                    nin = {nin} setNIN = {setNIN}
                    errors={errors} setErrors={setErrors}
                    handleFileChangeTP={handleFileChange} 
                />
            </>
        );
        case '11':
            return (
            <>
                <CMRIS 
                    firstName={firstName} setFirstName={setFirstName} 
                    lastName={lastName} setLastName={setLastName} 
                    emailAddress={emailAddress} setEmailAddress={setEmailAddress} 
                    phoneNumber={phoneNumber} setPhoneNumber={setPhoneNumber} 
                    nin = {nin} setNIN = {setNIN}
                    errors={errors} setErrors={setErrors}
                    handleFileChangeTP={handleFileChange} 
                />
            </>
        );
        // Add more cases for other permit types as needed
        default:
        return null;
    }
};



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
                                    Other Permit
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
                            <h5 className="mb-0 text-primary"> Other Permit </h5>
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
                                                <b>Select the type of permit.</b>
                                            </h6>

                                            <h6 class="text-justify card-title text-danger">
                                                TIMELINE
                                            </h6>
                                            <h6 class="card-subtitle mb-2">
                                                <b>Processing and Delivery Time:</b> 72 Hours
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
                                                <label className="form-label">Select Permit Type</label>
                                                <select required value={permitTypeId || '' }
                                                    onChange={handlePermitTypeChange} className="form-select"
                                                    id="permitType">
                                                    <option disabled value="">-- Choose Permit Type -- </option>
                                                    {permitType.map((permitType, index) => (
                                                    <option key={index} value={permitType.id}>
                                                        {permitType.name}
                                                    </option>
                                                    ))}
                                                </select>
                                            </div>
                                            <div className="col-md-1"></div>
                                        </div>

                                        {renderPermitSpecificForm()}

                                        {/* Display specific errors if available */}
                                        {Object.keys(errors).map((field, index) => (
                                            <p key={index} style={{ color: 'red' }}>
                                                {errors[field]}
                                            </p>
                                        ))}
                                        <div className='row'>
                                            <div className="col-md-1 mb-1"></div>
                                            <div className="card-body col-md-10 align-items-center text-center">
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

if (document.getElementById('otherPermit')) {
ReactDOM.createRoot(document.getElementById('otherPermit')).render(
<React.StrictMode>
    <OtherPermit />
</React.StrictMode>
);
}
