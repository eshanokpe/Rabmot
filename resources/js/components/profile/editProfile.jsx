import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

export default function EditProfile() {
    const url = window.location.origin;
    const [userDetails, setUserDetails] = useState({
        fullname: '',
        email: '',
        phone: '',
        address: '',
        gender: '',
        profileImage: null,
        profileImagePreview: null,
    });

    const [successMessage, setSuccessMessage] = useState('');
    const [errorMessage, setErrorMessage] = useState('');
    const [validationErrors, setValidationErrors] = useState({});


    useEffect(() => {
        const fetchUserDetails = async () => {
            try {
                const response = await axios.get(`${url}/home/get-user-details`);
                setUserDetails({
                    fullname: response.data.fullname || '',
                    email: response.data.email,
                    phone: response.data.phone || '',
                    address: response.data.address || '',
                    gender: response.data.gender ,
                    profileImage: response.data.profileImage,
                    profileImagePreview: `/assets/profileimages/${response.data.profileImage}`,
                });
            } catch (error) {
                console.error(error);
                setErrorMessage('Failed to fetch user details.');
            }
        };

        fetchUserDetails();
    }, []);

   
    const handleChange = (e) => {
        const { name, value, files } = e.target;
        if (name === 'profileImage' && files.length > 0) {
            const selectedFile = files[0];
            setUserDetails((prevDetails) => ({
                ...prevDetails,
                profileImage: selectedFile,
                profileImagePreview: URL.createObjectURL(selectedFile),
            }));
        } else {
            setUserDetails((prevDetails) => ({
                ...prevDetails,
                [name]: value,
            }));
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('fullname', userDetails.fullname);
        formData.append('email', userDetails.email);
        formData.append('phone', userDetails.phone);
        formData.append('address', userDetails.address);
        formData.append('gender', userDetails.gender);

        if (userDetails.profileImage) {
            formData.append('profileImage', userDetails.profileImage); // Append the file to FormData
        }

        axios.post(`${url}/home/update-profile`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        .then(response => {
            console.log('Response:', response.data);
            if (response.data.code === 400) {
                toast.error('An error occurred while updating your profile.');
                setValidationErrors(response.data.error); 
                setSuccessMessage(''); 
            } else {
                // Assuming success code is not 400
                toast.success(response.data.msg);
                setErrorMessage(''); 
                setValidationErrors({}); 
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error.response.data.error);
            if (error.response && error.response.data.error) {
                setValidationErrors(error.response.data.error); 
            } else {
                toast.error('An error occurred while updating your profile.');
            }
            setSuccessMessage('');
        });
    };

    return (
        <>
         <ToastContainer />
            <div class="page-wrapper">
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                            <div class="breadcrumb-title pe-3">Edit Profile</div>
                                <div class="ps-3">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0 p-0">
                                            <li class="breadcrumb-item">
                                                <a href="javascript:;">
                                                    <i class='bx bx-home-alt'></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                            <div className="user-profile-page">
                                <div className="col-xl-12 mx-auto">
                                    <div className="card radius-15">
                                        <div className="card-body">
                                            {/* Display success message */}
                                            {successMessage && (
                                                <div className="alert alert-success" role="alert">
                                                    {successMessage}
                                                </div>
                                            )}
                                            {/* Display error message */}
                                            {errorMessage && (
                                                <div className="alert alert-danger" role="alert">
                                                    {errorMessage}
                                                </div>
                                            )}
                                            <form className="row g-3" id="profile_setup_frm" onSubmit={handleSubmit} encType="multipart/form-data">
                                                <div className="row">
                                                    <div className="col-md-4 border-right ">
                                                        <div className="d-flex flex-column align-items-center text-center p-3 py-5">
                                                            {userDetails.profileImagePreview ? (
                                                                <img
                                                                    src={userDetails.profileImagePreview}
                                                                    id="image_preview_container"
                                                                    className="rounded-circle shadow"
                                                                    width="250"
                                                                    height="250"
                                                                    alt=""
                                                                />
                                                            ) : (
                                                                <img
                                                                    src="/assets/img/avatar.png"
                                                                    id="image_preview_container"
                                                                    className="rounded-circle shadow"
                                                                    width="250"
                                                                    height="250"
                                                                    alt=""
                                                                />
                                                            )}
                                                            <span className="font-weight-bold pt-3">
                                                                <input
                                                                    className="form-control"
                                                                    id="profile_image"
                                                                    type="file"
                                                                    name="profileImage"
                                                                    onChange={handleChange}
                                                                />
                                                                {validationErrors.profileImage && (
                                                                    <div className="text-danger">
                                                                        {validationErrors.profileImage[0]}
                                                                    </div>
                                                                )}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div className="col-md-8 border-right">
                                                        <div className="p-3 py-5">
                                                            <div className="d-flex justify-content-between align-items-center mb-3">
                                                                <h4 className="text-right">Profile Settings</h4>
                                                            </div>

                                                            <div className="card-body">
                                                                <div className="form-body">
                                                                    <div className="row">
                                                                        <div className="col-12 border-right">
                                                                            <div className="col-12 mb-3">
                                                                                <label className="form-label">Full Name</label>
                                                                                <input
                                                                                    type="text"
                                                                                    name="fullname"
                                                                                    value={userDetails.fullname  || ''}
                                                                                    onChange={handleChange}
                                                                                    className="form-control"
                                                                                />
                                                                                {validationErrors.fullname && (
                                                                                    <div className="text-danger">
                                                                                        {validationErrors.fullname[0]}
                                                                                    </div>
                                                                                )}
                                                                            </div>

                                                                            <div className="col-12 mb-3">
                                                                                <label className="form-label">Email Address</label>
                                                                                <input
                                                                                    name="email"
                                                                                    disabled
                                                                                    type="email"
                                                                                    value={userDetails.email || ''}
                                                                                    className="form-control"
                                                                                />
                                                                                {validationErrors.email && (
                                                                                    <div className="text-danger">
                                                                                        {validationErrors.email[0]}
                                                                                    </div>
                                                                                )}
                                                                            </div>

                                                                            <div className="col-12 mb-3">
                                                                                <label className="form-label">Phone Number</label>
                                                                                <input
                                                                                    name="phone"
                                                                                    type="text"
                                                                                    value={userDetails.phone || ''}
                                                                                    onChange={handleChange}
                                                                                    className="form-control"
                                                                                />
                                                                                {validationErrors.phone && (
                                                                                    <div className="text-danger">
                                                                                        {validationErrors.phone[0]}
                                                                                    </div>
                                                                                )}
                                                                            </div>

                                                                            <div className="col-12 mb-3">
                                                                                <label className="form-label">Address</label>
                                                                                <input
                                                                                    name="address"
                                                                                    type="text"
                                                                                    value={userDetails.address || ''}
                                                                                    onChange={handleChange}
                                                                                    className="form-control"
                                                                                    placeholder="Address"
                                                                                />
                                                                                {validationErrors.address && (
                                                                                    <div className="text-danger">
                                                                                        {validationErrors.address[0]}
                                                                                    </div>
                                                                                )}
                                                                            </div>

                                                                            <div className="col-12 mb-3">
                                                                                <label className="form-label">Gender</label>
                                                                                <select
                                                                                    name="gender"
                                                                                    value={userDetails.gender}
                                                                                    onChange={handleChange}
                                                                                    className="form-control"
                                                                                >
                                                                                    <option value="">-- Select Gender --</option>
                                                                                    <option value="male">Male</option>
                                                                                    <option value="female">Female</option>
                                                                                </select>
                                                                                {validationErrors.gender && (
                                                                                    <div className="text-danger">
                                                                                        {validationErrors.gender[0]}
                                                                                    </div>
                                                                                )}
                                                                            </div>

                                                                            <div className="col-12">
                                                                                <center>
                                                                                    <button
                                                                                        id="btn"
                                                                                        type="submit"
                                                                                        className="btn btn-sm btn-primary mt-2"
                                                                                    >
                                                                                        Save Profile
                                                                                    </button>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

if (document.getElementById('editProfile')) {
    ReactDOM.createRoot(document.getElementById('editProfile')).render(
        <React.StrictMode>
            <EditProfile />
        </React.StrictMode>
    );
}
