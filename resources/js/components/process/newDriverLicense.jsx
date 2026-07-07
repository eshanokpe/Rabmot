import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

export default function NewDriverLicense() {
    const url = window.location.origin;
    const [loading, setLoading] = useState(false);

    const [stateList, setStateList] = useState([]);
    const [stateId, setStateId] = useState('');
    const [lengthYearList, setLengthYearsList] = useState([]);
    const [lengthYear, setLengthYear] = useState('');

    const [firstName, setFirstName] = useState('');
    const [middleName, setMiddleName] = useState('');
    const [lastName, setLastName] = useState('');
    const [motherMaidenName, setMotherMaidenName] = useState('');
    const [emailAddress, setEmailAddress] = useState('');
    const [nin, setNin] = useState('');
    const [dob, setDob] = useState('');
    const [gender, setGender] = useState('');
    const [userState, setUserState] = useState('');
    const [phoneNumber, setPhoneNumber] = useState('');
    const [contactAddress, setContactAddress] = useState('');
    const [localGovernmentPOB, setLocalGovernmentPOB] = useState('');
    const [localGovernment, setLocalGovernment] = useState('');
    const [maritalStatus, setMaritalStatus] = useState('');

    const [bloodGroup, setBloodGroup] = useState('');
    const [height, setHeight] = useState('');
    const [facialMark, setFacialMark] = useState('');
    const [glasses, setGlasses] = useState('');
    const [disability, setDisability] = useState('');
    const [nextofkinName, setNextofkinName] = useState('');
    const [phoneNextofkinName, setPhoneNextofkinName] = useState('');

    const [errors, setErrors] = useState({});
    const [touched, setTouched] = useState({});
    const [totalAmount, setTotalAmount] = useState(0.00);

    // ✅ Flag: track if data came from backend
    const [isLoadedFromApi, setIsLoadedFromApi] = useState(false);

    // ✅ Rule: Disable ONLY if value came from API AND is not empty
    const isReadOnly = (value) => isLoadedFromApi && value && value.trim() !== '';

    // ✅ Real-time validation rules
    const validateField = (name, value) => {
        let msg = '';
        switch (name) {
            case 'firstName':
                if (!value.trim()) msg = 'First name is required';
                break;
            case 'lastName':
                if (!value.trim()) msg = 'Last name is required';
                break;
            case 'motherMaidenName':
                if (!value.trim()) msg = 'Mother’s maiden name is required';
                break;
            case 'emailAddress':
                if (!value.trim()) msg = 'Email is required';
                else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) msg = 'Invalid email format';
                break;
            case 'nin':
                if (!value.trim()) msg = 'NIN is required';
                else if (!/^\d{11}$/.test(value)) msg = 'NIN must be 11 digits';
                break;
            case 'dob':
                if (!value) msg = 'Date of birth is required';
                else if (new Date(value) >= new Date()) msg = 'Date of birth must be in the past';
                break;
            case 'gender':
                if (!value) msg = 'Gender is required';
                break;
            case 'phoneNumber':
                if (!value.trim()) msg = 'Phone number is required';
                else if (!/^\d{10,15}$/.test(value.replace(/\D/g, ''))) msg = 'Enter a valid phone number';
                break;
            case 'userState':
                if (!value.trim()) msg = 'State of residence is required';
                break;
            case 'localGovernment':
                if (!value.trim()) msg = 'LGA of origin is required';
                break;
            case 'localGovernmentPOB':
                if (!value.trim()) msg = 'LGA of birth is required';
                break;
            case 'maritalStatus':
                if (!value.trim()) msg = 'Marital status is required';
                break;
            case 'contactAddress':
                if (!value.trim()) msg = 'Contact address is required';
                break;
            case 'bloodGroup':
                if (!value) msg = 'Select your blood group';
                break;
            case 'height':
                if (!value.trim()) msg = 'Height is required';
                break;
            case 'glasses':
                if (!value) msg = 'Select if you wear glasses';
                break;
            case 'disability':
                if (!value) msg = 'Select disability status';
                break;
            case 'nextofkinName':
                if (!value.trim()) msg = 'Next of kin name is required';
                break;
            case 'phoneNextofkinName':
                if (!value.trim()) msg = 'Next of kin phone is required';
                else if (!/^\d{10,15}$/.test(value.replace(/\D/g, ''))) msg = 'Enter a valid phone number';
                break;
            default:
                break;
        }
        return msg;
    };

    // ✅ Validate all fields on submit
    const validateAll = () => {
        const fields = {
            firstName, lastName, motherMaidenName, emailAddress, nin, dob, gender,
            phoneNumber, userState, localGovernment, localGovernmentPOB, maritalStatus,
            contactAddress, bloodGroup, height, glasses, disability, nextofkinName, phoneNextofkinName
        };
        const errs = {};
        Object.keys(fields).forEach(key => {
            const err = validateField(key, fields[key]);
            if (err) errs[key] = err;
        });
        setErrors(errs);
        return Object.keys(errs).length === 0;
    };

    // ✅ Load data from backend
    useEffect(() => {
        axios.get(`${url}/home/get-new-driverLicense`)
            .then(res => {
                const user = res.data.user;
                setFirstName(user.firstname || '');
                setMiddleName(user.middlename || '');
                setLastName(user.lastname || '');
                setMotherMaidenName(user.mother_maiden_name || '');
                setEmailAddress(user.email || '');
                setNin(user.nin || '');
                setDob(user.dob || '');
                setGender(user.gender || '');
                setUserState(user.state || '');
                setPhoneNumber(user.phone || '');
                setContactAddress(user.address || '');
                setLocalGovernment(user.local_government || '');
                setLocalGovernmentPOB(user.local_government_pob || '');
                setMaritalStatus(user.marital_status || '');
                setBloodGroup(user.blood_group || '');
                setHeight(user.height || '');
                setFacialMark(user.facial_mark || '');
                setGlasses(user.glasses || '');
                setDisability(user.disability || '');
                setNextofkinName(user.nextofkin_name || '');
                setPhoneNextofkinName(user.nextofkin_phone || '');

                // Mark: data loaded from API
                setIsLoadedFromApi(true);
            })
            .catch(err => console.error('Load error:', err));

        axios.get(`${url}/home/get-state-newdriverlicense`)
            .then(res => setStateList(res.data.stateList || []))
            .catch(err => console.error('States error:', err));
    }, [url]);

    useEffect(() => {
        if (!stateId) return;
        axios.post(`${url}/home/get-new-newdriverlicense-lengthYears`, { stateId })
            .then(res => setLengthYearsList(res.data.lengthYears || []))
            .catch(err => console.error('Years error:', err));
    }, [stateId]);

    useEffect(() => {
        if (!stateId || !lengthYear) return;
        axios.post(`${url}/home/get-new-newdriverlicense-price`, { stateId, lengthYear })
            .then(res => setTotalAmount(res.data.amount || 0))
            .catch(err => console.error('Price error:', err));
    }, [stateId, lengthYear]);

    // ✅ Handle input change: remove read-only when user starts typing
    const handleChange = (setter, fieldName) => (e) => {
        const value = e.target.value;
        // Once user types, disable "loaded from API" flag so field becomes editable
        if (isLoadedFromApi) setIsLoadedFromApi(false);
        setter(value);
        setTouched({ ...touched, [fieldName]: true });
        setErrors({ ...errors, [fieldName]: validateField(fieldName, value) });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setErrors({});

        if (!validateAll()) {
            setLoading(false);
            return;
        }

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
        formData.append('facialMark', facialMark);
        formData.append('glasses', glasses);
        formData.append('disability', disability);
        formData.append('nextofkinName', nextofkinName);
        formData.append('phoneNextofkinName', phoneNextofkinName);
        formData.append('contactAddress', contactAddress);
        formData.append('totalAmount', totalAmount);

        try {
            await axios.post(`${url}/home/post/newdriverlicense`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            setTimeout(() => window.location.href = `${url}/home/cart`, 1100);
        } catch (err) {
            setLoading(false);
            if (err.response?.data?.errors) setErrors(err.response.data.errors);
            else alert('Submission failed. Please check your inputs.');
        }
    };

    // Helper: show error only if field is touched or has error
    const showError = (field) => touched[field] || errors[field];

    return (
        <div className="page-wrapper">
            <div className="page-content-wrapper">
                <div className="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-5xl mx-auto">
                        {/* Header */}
                        <div className="mb-8">
                            <nav className="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                <a href="/home" className="hover:text-[#142444] transition-colors">Home</a>
                                <span>/</span>
                                <span className="text-[#142444] font-medium">New Driver License</span>
                            </nav>
                            <h1 className="text-2xl md:text-3xl font-bold text-gray-900">New Driver License Application</h1>
                            <p className="text-gray-500 text-sm mt-1">Complete the form below to apply for your new driver's license</p>
                        </div>

                        {/* Info Cards */}
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                            <div className="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i className="bx bx-calendar text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p className="text-xs text-gray-500 font-medium">Validity</p>
                                        <p className="text-sm font-semibold text-gray-800">Select years required</p>
                                    </div>
                                </div>
                            </div>
                            <div className="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <i className="bx bx-time text-yellow-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p className="text-xs text-gray-500 font-medium">Timeline</p>
                                        <p className="text-sm font-semibold text-gray-800">4–6 weeks total</p>
                                    </div>
                                </div>
                            </div>
                            <div className="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i className="bx bx-map text-green-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p className="text-xs text-gray-500 font-medium">Available In</p>
                                        <p className="text-sm font-semibold text-gray-800">Lagos, Abuja, Ibadan, Anambra</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Form */}
                        <div className="bg-white rounded-2xl shadow-xl overflow-hidden">
                            <div className="p-6 md:p-8">
                                <form onSubmit={handleSubmit} className="space-y-8">
                                    {/* Application Details */}
                                    <div>
                                        <h3 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                            <span className="w-1 h-6 bg-[#142444] rounded-full"></span>
                                            Application Details
                                        </h3>
                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">
                                                    Processing State <span className="text-red-500">*</span>
                                                </label>
                                                <select
                                                    value={stateId}
                                                    onChange={(e) => setStateId(e.target.value)}
                                                    required
                                                    className="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] bg-white"
                                                >
                                                    <option value="">Select State</option>
                                                    {stateList.map(st => <option key={st.id} value={st.id}>{st.name}</option>)}
                                                </select>
                                            </div>
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">
                                                    Validity Period <span className="text-red-500">*</span>
                                                </label>
                                                <select
                                                    value={lengthYear}
                                                    onChange={(e) => setLengthYear(e.target.value)}
                                                    required
                                                    className="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] bg-white"
                                                >
                                                    <option value="">Select Years</option>
                                                    {lengthYearList.map(yr => <option key={yr.years_type} value={yr.years_type}>{yr.years_type} Years</option>)}
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Personal Info */}
                                    <div>
                                        <h3 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                            <span className="w-1 h-6 bg-blue-500 rounded-full"></span>
                                            Personal Information
                                            <span className="text-sm font-normal text-gray-400 ml-2">(Auto‑filled if available)</span>
                                        </h3>
                                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                            {/* First Name */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">First Name <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={firstName}
                                                    onChange={handleChange(setFirstName, 'firstName')}
                                                    readOnly={isReadOnly(firstName)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('firstName') && errors.firstName ? 'border-red-500 focus:ring-red-200' : 'border-gray-300 focus:ring-[#142444] focus:border-[#142444]'
                                                    } ${isReadOnly(firstName) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('firstName') && <p className="text-red-500 text-xs mt-1">{errors.firstName}</p>}
                                            </div>

                                            {/* Middle Name */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Middle Name</label>
                                                <input
                                                    type="text"
                                                    value={middleName}
                                                    onChange={handleChange(setMiddleName, 'middleName')}
                                                    readOnly={isReadOnly(middleName)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg ${isReadOnly(middleName) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                            </div>

                                            {/* Last Name */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Last Name <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={lastName}
                                                    onChange={handleChange(setLastName, 'lastName')}
                                                    readOnly={isReadOnly(lastName)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('lastName') && errors.lastName ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(lastName) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('lastName') && <p className="text-red-500 text-xs mt-1">{errors.lastName}</p>}
                                            </div>

                                            {/* Mother's Maiden Name */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Mother's Maiden Name <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={motherMaidenName}
                                                    onChange={handleChange(setMotherMaidenName, 'motherMaidenName')}
                                                    readOnly={isReadOnly(motherMaidenName)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('motherMaidenName') && errors.motherMaidenName ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(motherMaidenName) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('motherMaidenName') && <p className="text-red-500 text-xs mt-1">{errors.motherMaidenName}</p>}
                                            </div>

                                            {/* NIN */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">NIN <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={nin}
                                                    onChange={handleChange(setNin, 'nin')}
                                                    readOnly={isReadOnly(nin)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('nin') && errors.nin ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(nin) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('nin') && <p className="text-red-500 text-xs mt-1">{errors.nin}</p>}
                                            </div>

                                            {/* Email */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Email <span className="text-red-500">*</span></label>
                                                <input
                                                    type="email"
                                                    value={emailAddress}
                                                    onChange={handleChange(setEmailAddress, 'emailAddress')}
                                                    readOnly={isReadOnly(emailAddress)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('emailAddress') && errors.emailAddress ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(emailAddress) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('emailAddress') && <p className="text-red-500 text-xs mt-1">{errors.emailAddress}</p>}
                                            </div>

                                            {/* Gender */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Gender <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={gender}
                                                    onChange={handleChange(setGender, 'gender')}
                                                    readOnly={isReadOnly(gender)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('gender') && errors.gender ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(gender) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('gender') && <p className="text-red-500 text-xs mt-1">{errors.gender}</p>}
                                            </div>

                                            {/* DOB */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Date of Birth <span className="text-red-500">*</span></label>
                                                <input
                                                    type="date"
                                                    value={dob}
                                                    onChange={handleChange(setDob, 'dob')}
                                                    readOnly={isReadOnly(dob)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('dob') && errors.dob ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(dob) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('dob') && <p className="text-red-500 text-xs mt-1">{errors.dob}</p>}
                                            </div>

                                            {/* State */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">State of Residence <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={userState}
                                                    onChange={handleChange(setUserState, 'userState')}
                                                    readOnly={isReadOnly(userState)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('userState') && errors.userState ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(userState) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('userState') && <p className="text-red-500 text-xs mt-1">{errors.userState}</p>}
                                            </div>

                                            {/* Phone */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Phone Number <span className="text-red-500">*</span></label>
                                                <input
                                                    type="tel"
                                                    value={phoneNumber}
                                                    onChange={handleChange(setPhoneNumber, 'phoneNumber')}
                                                    readOnly={isReadOnly(phoneNumber)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('phoneNumber') && errors.phoneNumber ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(phoneNumber) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('phoneNumber') && <p className="text-red-500 text-xs mt-1">{errors.phoneNumber}</p>}
                                            </div>

                                            {/* LGA Origin */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">LGA of Origin <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={localGovernment}
                                                    onChange={handleChange(setLocalGovernment, 'localGovernment')}
                                                    readOnly={isReadOnly(localGovernment)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('localGovernment') && errors.localGovernment ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(localGovernment) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('localGovernment') && <p className="text-red-500 text-xs mt-1">{errors.localGovernment}</p>}
                                            </div>

                                            {/* LGA Birth */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">LGA of Birth <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={localGovernmentPOB}
                                                    onChange={handleChange(setLocalGovernmentPOB, 'localGovernmentPOB')}
                                                    readOnly={isReadOnly(localGovernmentPOB)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('localGovernmentPOB') && errors.localGovernmentPOB ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(localGovernmentPOB) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('localGovernmentPOB') && <p className="text-red-500 text-xs mt-1">{errors.localGovernmentPOB}</p>}
                                            </div>

                                            {/* Marital Status */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Marital Status <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={maritalStatus}
                                                    onChange={handleChange(setMaritalStatus, 'maritalStatus')}
                                                    readOnly={isReadOnly(maritalStatus)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('maritalStatus') && errors.maritalStatus ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(maritalStatus) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('maritalStatus') && <p className="text-red-500 text-xs mt-1">{errors.maritalStatus}</p>}
                                            </div>

                                            {/* Address */}
                                            <div className="md:col-span-2 lg:col-span-3">
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Contact Address <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={contactAddress}
                                                    onChange={handleChange(setContactAddress, 'contactAddress')}
                                                    readOnly={isReadOnly(contactAddress)}
                                                    className={`w-full px-4 py-2.5 border rounded-lg transition-all ${
                                                        showError('contactAddress') && errors.contactAddress ? 'border-red-500' : 'border-gray-300'
                                                    } ${isReadOnly(contactAddress) ? 'bg-gray-50' : 'bg-white'}`}
                                                />
                                                {showError('contactAddress') && <p className="text-red-500 text-xs mt-1">{errors.contactAddress}</p>}
                                            </div>
                                        </div>
                                    </div>

                                    {/* Personal Details */}
                                    <div>
                                        <h3 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                            <span className="w-1 h-6 bg-green-500 rounded-full"></span>
                                            Personal Details
                                        </h3>
                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            {/* Blood Group */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Blood Group <span className="text-red-500">*</span></label>
                                                <select
                                                    value={bloodGroup}
                                                    onChange={handleChange(setBloodGroup, 'bloodGroup')}
                                                    required
                                                    className={`w-full px-4 py-2.5 border rounded-lg ${showError('bloodGroup') && errors.bloodGroup ? 'border-red-500' : 'border-gray-300'}`}
                                                >
                                                    <option value="">Select Blood Group</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                                {showError('bloodGroup') && <p className="text-red-500 text-xs mt-1">{errors.bloodGroup}</p>}
                                            </div>

                                            {/* Height */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Height <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={height}
                                                    onChange={handleChange(setHeight, 'height')}
                                                    placeholder="e.g., 1.75m or 5ft9in"
                                                    className={`w-full px-4 py-2.5 border rounded-lg ${showError('height') && errors.height ? 'border-red-500' : 'border-gray-300'}`}
                                                />
                                                {showError('height') && <p className="text-red-500 text-xs mt-1">{errors.height}</p>}
                                            </div>

                                            {/* Facial Mark */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Facial Mark</label>
                                                <input
                                                    type="text"
                                                    value={facialMark}
                                                    onChange={handleChange(setFacialMark, 'facialMark')}
                                                    placeholder="e.g., Scar / None"
                                                    className="w-full px-4 py-2.5 border border-gray-300 rounded-lg"
                                                />
                                            </div>

                                            {/* Glasses */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Wears Glasses? <span className="text-red-500">*</span></label>
                                                <select
                                                    value={glasses}
                                                    onChange={handleChange(setGlasses, 'glasses')}
                                                    required
                                                    className={`w-full px-4 py-2.5 border rounded-lg ${showError('glasses') && errors.glasses ? 'border-red-500' : 'border-gray-300'}`}
                                                >
                                                    <option value="">Select</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                {showError('glasses') && <p className="text-red-500 text-xs mt-1">{errors.glasses}</p>}
                                            </div>

                                            {/* Disability */}
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Disability Status <span className="text-red-500">*</span></label>
                                                <select
                                                    value={disability}
                                                    onChange={handleChange(setDisability, 'disability')}
                                                    required
                                                    className={`w-full px-4 py-2.5 border rounded-lg ${showError('disability') && errors.disability ? 'border-red-500' : 'border-gray-300'}`}
                                                >
                                                    <option value="">Select</option>
                                                    <option value="None">None</option>
                                                    <option value="Visual Impairment">Visual Impairment</option>
                                                    <option value="Hearing Impairment">Hearing Impairment</option>
                                                    <option value="Physical Disability">Physical Disability</option>
                                                    <option value="Speech Impairment">Speech Impairment</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                {showError('disability') && <p className="text-red-500 text-xs mt-1">{errors.disability}</p>}
                                            </div>
                                        </div>
                                    </div>

                                    {/* Next of Kin */}
                                    <div>
                                        <h3 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                            <span className="w-1 h-6 bg-purple-500 rounded-full"></span>
                                            Next of Kin
                                        </h3>
                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span className="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    value={nextofkinName}
                                                    onChange={handleChange(setNextofkinName, 'nextofkinName')}
                                                    className={`w-full px-4 py-2.5 border rounded-lg ${showError('nextofkinName') && errors.nextofkinName ? 'border-red-500' : 'border-gray-300'}`}
                                                />
                                                {showError('nextofkinName') && <p className="text-red-500 text-xs mt-1">{errors.nextofkinName}</p>}
                                            </div>
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1.5">Phone Number <span className="text-red-500">*</span></label>
                                                <input
                                                    type="tel"
                                                    value={phoneNextofkinName}
                                                    onChange={handleChange(setPhoneNextofkinName, 'phoneNextofkinName')}
                                                    className={`w-full px-4 py-2.5 border rounded-lg ${showError('phoneNextofkinName') && errors.phoneNextofkinName ? 'border-red-500' : 'border-gray-300'}`}
                                                />
                                                {showError('phoneNextofkinName') && <p className="text-red-500 text-xs mt-1">{errors.phoneNextofkinName}</p>}
                                            </div>
                                        </div>
                                    </div>

                                    {/* Submit Section */}
                                    <div className="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                                        <div className="flex flex-col md:flex-row items-center justify-between gap-4">
                                            <div>
                                                <p className="text-sm text-gray-600">Total Fee</p>
                                                <p className="text-2xl font-bold text-[#142444]">
                                                    {new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(totalAmount)}
                                                </p>
                                            </div>
                                            <div className="text-center md:text-right">
                                                <p className="text-sm text-gray-600">Processing Time</p>
                                                <p className="text-sm font-semibold text-gray-800">4–6 weeks</p>
                                            </div>
                                            <button
                                                type="submit"
                                                disabled={loading}
                                                className="w-full md:w-auto px-8 py-3 bg-[#142444] hover:bg-[#0f1c38] text-white font-semibold rounded-lg transition duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl disabled:opacity-60 disabled:cursor-not-allowed"
                                            >
                                                {loading ? (
                                                    <span className="flex items-center gap-2">
                                                        <svg className="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                                                        </svg>
                                                        Processing...
                                                    </span>
                                                ) : (
                                                    <span className="flex items-center gap-2">
                                                        <i className="bx bx-lock-alt"></i> Proceed to Payment
                                                    </span>
                                                )}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <p className="text-center text-xs text-gray-400 mt-6">
                            <i className="bx bx-shield-alt mr-1"></i>
                            Your information is secure and will only be used for license processing
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}

if (document.getElementById('newDriverLicense')) {
    ReactDOM.createRoot(document.getElementById('newDriverLicense')).render(
        <React.StrictMode>
            <NewDriverLicense />
        </React.StrictMode>
    );
}