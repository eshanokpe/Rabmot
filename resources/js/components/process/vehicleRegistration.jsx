import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

export default function VehicleRegistration() {
    
    const url = window.location.origin; 
    const [vehicleCount, setVehicleCount] = useState(0);
    const [vehicleList, setVehicleList] = useState([]);
    const [stateList, setStateList] = useState([]);
    const [vehicleResTypeList, setVehicleResTypeList] = useState([]);
    const [stateVehicleList, setStateVehicleList] = useState([]);
    const [stateId, setStateId] = useState('');
    const [vehicleCategoryId, setVehicleCategoryId] = useState('');
    const [vehicleResType, setVehicleResType] = useState(null);
    const [loading, setLoading] = useState(true);
    const [addVehicleReg, setAddVehicleReg] = useState(null);
    const [plateType, setPlateType] = useState('RPN');
    const [totalAmount, setTotalAmount] = useState(0);
    const [amount, setAmount] = useState(0);
    const [hackneyPermitCost, setHackneyPermitCost] = useState(0);
    const [policeCmrisCost, setPoliceCmrisCost] = useState(0);
    // State to track checkbox selections
    const [isHackneyPermitChecked, setIsHackneyPermitChecked] = useState(false);
    const [isPoliceCmrisChecked, setIsPoliceCmrisChecked] = useState(false);

    const [policeCMRISTotal, setPoliceCMRISTotal] = useState(0);
    const [hackneyPermitTotal, setHackneyPermitTotal] = useState(0);

    const [preferredNumber, setPreferredNumber] = useState('');

    const handleStateChange = (event) => {
        const selectedStateId = event.target.value;
        setStateId(selectedStateId);

        if (selectedStateId) {
            axios.post(`${url}/home/vehicleRegistration-state-selection`, { 
                stateId: selectedStateId 
            }).then(response => {
                setStateVehicleList(response.data.stateVehicleList);
            }).catch(error => {
                console.error('Error sending stateId:', error);
            });
        }
    };

    const handleVehicleCategoryId = (event) => {
        const vehicleCategoryId = event.target.value;
        setVehicleCategoryId(vehicleCategoryId);
    };

    useEffect(() => {
        setVehicleList([]);
        axios
            .post(`${url}/home/vehicleRegistration-vehicleCategoryId-selection`, {
                vehicleCategoryId,
                stateId
            })
            .then(response => {
                console.log('Success vehicleCategoryId:', response.data);
                setVehicleList(response.data.vehicleList  || []);
            })
            .catch(error => {
                console.error('Error sending vehicleCategoryId:', error);
            });
        
    }, [vehicleCategoryId, stateId]);

    const handleAddVehicleChange = (event) => {
        const addVehicleValue = event.target.value;
        setAddVehicleReg(addVehicleValue);
        if (addVehicleValue === "add-registration") {
            window.location.href = `${url}/home/addvehicleregistration`;
        } 
    };

    const handleVehicleResType = (event) => {
        const selectedVehicleResType = event.target.value;
        setVehicleResType(selectedVehicleResType);
    };

    const handlePlateTypeChange = (event) => {
        const selectedValue = event.target.value;
        setPlateType(selectedValue);
    };

    useEffect(() => {
        axios.get(`${url}/home/get-user-add-vehicles-registration`)
            .then(response => {
                setVehicleCount(response.data.vehicleCount);
                setStateList(response.data.stateList);
                setVehicleResTypeList(response.data.vehicleResType);
                setLoading(false);
            })
            .catch(error => {
                console.error('Error fetching vehicle data:', error);
                setLoading(false);
            });
    }, [url]);

    // Send vehicle registration cost and update state
    useEffect(() => {
        const sendVehicleRegCost = () => {
            console.log('Successfully sent VehicleResType:', vehicleResType);
            console.log('Successfully sent vehicleCategoryId:', vehicleCategoryId);
            console.log('Successfully sent plateType:', plateType);

            axios.post(`${url}/home/vehicleRegistration-addVehicleRegCost`, {
                stateId,
                vehicleCategoryId,
                addVehicleReg,
                vehicleResType,
                plateType
            })
            .then(response => {
                console.log('Successfully sent vehicle registration cost:', response.data);
                setAmount(response.data.amount);
                setHackneyPermitCost(response.data.hackneyPermitCost);
                setPoliceCmrisCost(response.data.policeCmrisCost);
            })
            .catch(error => {
                console.error('Error sending vehicle registration cost:', error);
            });
        };
        sendVehicleRegCost();
    },[
        stateId, vehicleCategoryId, addVehicleReg, 
        vehicleResType, plateType
    ]);

    // Calculate total amount
    useEffect(() => {
        const calculateTotalAmount = () => {
            const hackneyPermitTotal = isHackneyPermitChecked ? Number(hackneyPermitCost) : 0;
            const policeCMRISTotal = isPoliceCmrisChecked ? Number(policeCmrisCost) : 0;
            setHackneyPermitTotal(hackneyPermitTotal);
            setPoliceCMRISTotal(policeCMRISTotal);
            setTotalAmount(
                Number(amount) + hackneyPermitTotal + policeCMRISTotal 
            ); 
            // Set the individual totals in state
            
        };
        calculateTotalAmount();
        },[
            amount, isHackneyPermitChecked, hackneyPermitCost, 
            isPoliceCmrisChecked, policeCmrisCost
    ]);
 

    // Handle checkbox change
    const handleCheckboxChange = (event) => {
        const { name, checked } = event.target;
    
        switch (name) {
            case "hackneyPermit":
                setIsHackneyPermitChecked(checked);
                break;
            case "policeCMRIS":
                setIsPoliceCmrisChecked(checked);
                break;
            default:
                break;
        }
    };

    // Handle form submission
    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = {
            stateId,
            vehicleCategoryId,
            vehicleResType,
            addVehicleReg,
            hackneyPermitTotal,
            policeCMRISTotal,
            preferredNumber,
            totalAmount,
        };
        axios.post(`${url}/home/post-vehicleRegistration`, {
            stateId:stateId,
            userType:'user',
            vehicleRegCategoryId: vehicleCategoryId,
            vehicleResType:vehicleResType,
            addVehicleReg:addVehicleReg,
            hackneyPermitTotal:hackneyPermitTotal,
            policeCMRISTotal:policeCMRISTotal,
            preferredNumber:preferredNumber,
            totalAmount:totalAmount,
            plateNumberType:plateType
        })
        .then(response => {
            console.log('Successfully sent vehicleCategoryId:', response.data);
            // setVehicleList(response.data.vehicleList);
            setTimeout(()=>{
                window.location.href = `${url}/home/cart`;
            },1100)
        })
        .catch(error => {
            console.error('Error sending vehicleCategoryId:', error);
        });
        console.log("Form data submitted: ", formData);
    };

    const handleVehicleRegistration = ()=>{
        window.location.href = `${url}/home/addvehicleregistration`;
    }

    if (loading) {
        return <p>Loading...</p>;
    }


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
                                            New Vehicle Registration
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
                                    <h5 className="mb-0 text-primary">New Vehicle Registration</h5>
                                </div>
                                <hr />

                                {vehicleCount < 1 ? (
                                    <>
                                        <div className="card border-top border-0 border-4 border-primary">
                                            <div className="row">
                                                <div className="col-12 col-lg-12 col-xl-12">
                                                    <div className="radius-15">
                                                        <div className="card-body">
                                                            <h6 className="text-justify text-success card-title">
                                                                REQUIRED
                                                            </h6>
                                                            <h6 className="card-subtitle mb-2">
                                                                - Choose the Vehicle Category. <br/>
                                                                - Mark the desired options to calculate the total cost. <br/>
                                                                - Specify the vehicle type: Commercial or Private. <br/>
                                                                - Complete the submission of essential documents.
                                                            
                                                            </h6>
                                                            <h6 className="text-justify card-title text-danger">
                                                                TIMELINE
                                                            </h6>
                                                            <h6 className="card-subtitle mb-2">
                                                                72 Hours
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div className="alert alert-danger alert-dismissible fade show" role="alert">
                                                <span className="alert-link">Oh Snap!</span> 
                                                You need to Add New Vehicle to start the registration process. 
                                                <a onClick={handleVehicleRegistration} className="alert-link"  style={{cursor:'pointer'}}> Add New Vehicle Registration</a>
                                            </div>
                                        </div>
                                    </>
                                ) : (
                                    <>
                                        <div className="card radius-15 border-top border-0 border-4 ">
                                            <div className="row">
                                                <div className="col-12 col-lg-12 col-xl-12">
                                                    <div className="radius-15">
                                                        <div className="card-body">
                                                            <h6 className="text-justify text-primary card-title">
                                                                ELIGIBILITY:
                                                            </h6>
                                                            <h6 className="card-subtitle mb-2">
                                                                Only a vehicle used and registered before in Nigeria by the former owner is eligible for a Change of Ownership.
                                                            </h6>
                                                            <h6 className="text-justify text-success card-title">
                                                                INSTRUCTION:
                                                            </h6>
                                                            <h6 className="card-subtitle mb-2">
                                                                Select the type of Vehicle, then select all the options you require to see the accurate price.
                                                            </h6>
                                                            <h6>
                                                                <b>Note:</b> You must select the HACKNEY PERMIT option for a vehicle that carries loads and passengers (Taxi, Commercial vehicle, Company Vehicle).
                                                            </h6>
                                                            <h6 className="text-justify card-title text-danger">
                                                                TIMELINE:
                                                            </h6>
                                                            <h6 className="card-subtitle mb-2">
                                                                <b>Processing and Delivery Time:</b> 72 hours
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="card border-top border-0 border-4 border-primary">
                                            <div className="row card-body p-4">
                                                <form id="form_calc" action='' onSubmit={handleSubmit}>
                                                    <input type="hidden" name="uID" value='' />
                                                    <input type="hidden" name="paperType" value="rw" />
                                                    <h6 className="card-subtitle mb-2">
                                                        Select the category of Vehicle, then check the options you require to see the price, also select the type of vehicle commercial or private vehicle.
                                                    </h6>
                                                    
                                                    <div className="ct_opt card-body" id="ct_opt">
                                                        <div className="row mb-2">
                                                            <div className="col-md-1 mb-2"></div>
                                                            <div className="col-md-10">
                                                                <label htmlFor="stateId" className="form-label">Select State</label>
                                                                <select
                                                                    required
                                                                    value={stateId || ''}
                                                                    onChange={handleStateChange}
                                                                    className="form-select"
                                                                    id="stateId"
                                                                >
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

                                                        <div className="row mb-2">
                                                            <div className="col-md-1 mb-2"></div>
                                                            <div className="col-md-10">
                                                            <label htmlFor="vehicleCategoryId" className="form-label">Select the Vehicle Category</label>
                                                            <select
                                                                required
                                                                value={vehicleCategoryId || ''}
                                                                onChange={handleVehicleCategoryId}
                                                                name="vehicleCategoryId"
                                                                id="vehicleCategoryId"
                                                                className="form-select"
                                                            >
                                                                <option disabled value="">-- Select Vehicle Type --</option>
                                                                {stateVehicleList.map((vehicleType) => (
                                                                <option key={vehicleType.vehicle_type.id} value={vehicleType.vehicle_type.id}>
                                                                    {vehicleType.vehicle_type.name} {vehicleType.vehicle_type.id}
                                                                </option>
                                                                ))}
                                                            </select>
                                                            </div>
                                                            <div className="col-md-1 mb-2"></div>
                                                        </div>

                                                        <div className="row mt-2 mb-2">
                                                            <div className="col-md-1 mb-2"></div>
                                                            <div className="col-md-10">
                                                            <label htmlFor="vehicleForm" className="form-label">Select the Option of your choice</label>
                                                            <select
                                                                required
                                                                value={addVehicleReg || ''}
                                                                name="vehicleType"
                                                                id="vehicleForm"
                                                                className="form-select"
                                                                onChange={handleAddVehicleChange}
                                                            >
                                                                <option disabled value="">-- Select Vehicle --</option>
                                                                <option value="add-registration">+ Add Vehicle Registration</option>
                                                                {vehicleList.map((vehicle) => (
                                                                <option key={vehicle.category} value={vehicle.category}>
                                                                    {vehicle.vehiclebrand} {vehicle.vehiclemodel}
                                                                </option>
                                                                ))}
                                                            </select>
                                                            </div>
                                                            <div className="col-md-1 mb-2"></div>
                                                        </div>

                                                        {addVehicleReg && (
                                                            <>
                                                            <div className="row mb-2 mt-2">
                                                                <div className="col-md-1 mb-2"></div>
                                                                <div className="col-md-10">
                                                                <label  className="form-label">Select Registration Type</label>
                                                                <select
                                                                    required
                                                                    value={vehicleResType}
                                                                    onChange={handleVehicleResType}
                                                                    name="vehicleResType"
                                                                    id="vehicleResType"
                                                                    className="form-select"
                                                                >
                                                                    <option value="">-- Select Vehicle Registration Type --</option>
                                                                    {vehicleResTypeList.map((resType) => (
                                                                    <option key={resType.id} value={resType.id}>
                                                                        {resType.name}
                                                                    </option>
                                                                    ))}
                                                                </select>
                                                                </div>
                                                                <div className="col-md-1 mb-2"></div>
                                                            </div>

                                                            <div className="row mb-0 card-body">
                                                                <div className="col-1"></div>
                                                                <div className="col-10">
                                                                <input
                                                                    checked={isHackneyPermitChecked}
                                                                    onChange={handleCheckboxChange}
                                                                    name="hackneyPermit"
                                                                    className="form-check-input me-2"
                                                                    type="checkbox"
                                                                    id="hackneyPermit"
                                                                />
                                                                <label className="form-check-label" htmlFor="hackneyPermit">Hackney Permit</label>
                                                                </div>
                                                                <div className="col-1"></div>
                                                            </div>

                                                            <div className="row mb-0 card-body">
                                                                <div className="col-1"></div>
                                                                <div className="col-10">
                                                                <input
                                                                    checked={isPoliceCmrisChecked}
                                                                    onChange={handleCheckboxChange}
                                                                    name="policeCMRIS"
                                                                    className="form-check-input me-2"
                                                                    type="checkbox"
                                                                    id="policeCMRIS"
                                                                />
                                                                <label className="form-check-label" htmlFor="policeCmr">Police CMRIS</label>
                                                                </div>
                                                                <div className="col-1"></div>
                                                            </div>

                                                            <div className="row ">
                                                                <div className="col-md-1"></div>
                                                                <div className="col-md-10 mb-2">
                                                                <label htmlFor="plateType" className="form-label">Type of Plate Number</label>
                                                                <select
                                                                    required
                                                                    value={plateType}
                                                                    onChange={handlePlateTypeChange}
                                                                    name="plateType"
                                                                    id="plateType"
                                                                    className="form-select"
                                                                >
                                                                    <option disabled value="">-- Select type of Number Plate --</option>
                                                                    <option value="RPN">Random Plate Number</option>
                                                                    <option value="PCN">Personalized/Customize Number</option>
                                                                </select>
                                                                </div>
                                                                <div className="col-md-1"></div>
                                                            </div>

                                                            {plateType === 'PCN' && (
                                                                <div className="row">
                                                                    <div className="col-md-1 "></div>
                                                                    <div className="col-md-10 mb-2">
                                                                        <div id="elementHide" className="col-sm-12 mb-3">
                                                                        <label htmlFor="preferredNumber" className="mb-1">Enter Preferred Number</label>
                                                                        <input
                                                                            type="text"
                                                                            value={preferredNumber}
                                                                            name="preferredNumber"
                                                                            className="form-control mb-1"
                                                                            placeholder="Preferred Number"
                                                                            onChange={(e) => setPreferredNumber(e.target.value)}
                                                                        />
                                                                        <span style={{ color: 'red' }}>Must not be more than 8 characters</span>
                                                                        </div>
                                                                    </div>
                                                                    <div className="col-md-1"></div>
                                                                </div>
                                                            )}
                                                            </>
                                                        )}
                                                        <div className="row ">
                                                            <div className="col-md-1 "></div>
                                                            <div className=" col-md-10 align-items-center text-center">
                                                                <div id="mainPrice" className="alert alert-info mt-3">
                                                                Total Amount: 
                                                                <span  >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>

                                                                </div>
                                                            </div>
                                                            <div className="col-md-1 "></div>
                                                        </div>
                                                    </div>


                                                    <div className="card-body  col-md-12 align-items-center text-center ">
                                                        <button type="submit" className="btn btn-primary">Process Payment</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

if (document.getElementById('vehicleRegistration')) {
    ReactDOM.createRoot(document.getElementById('vehicleRegistration')).render(
        <React.StrictMode>
            <VehicleRegistration />
        </React.StrictMode>
    );
}
