import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

export default function ChangeofOwnership() {
    
    const url = window.location.origin;
    const [buttonloading, setButtonLoading] = useState(false);

    const [vehicleCount, setVehicleCount] = useState(0);
    const [vehicleList, setVehicleList] = useState([]);
    const [stateList, setStateList] = useState([]);
    const [stateVehicleList, setStateVehicleList] = useState([]);
    const [stateId, setStateId] = useState('');
    const [userList, setUserList] = useState([]);
    const [userId, setUserId] = useState('');
    const [vehicleCategoryId, setVehicleCategoryId] = useState('');
    const [vLExpirydate, setHandleVLExpirydate] = useState('');
    const [hackneyPermit, setHackneyPermit] = useState('');

    const [loading, setLoading] = useState(true);
    const [addVehicleOwnership, setAddVehicleOwnership] = useState('');
    const [plateType, setPlateType] = useState('RPN');

    const [totalAmount, setTotalAmount] = useState(0);
    const [vehicleCost, setVehicleCost] = useState(0);

    const [hackneyPermitCost, setHackneyPermitCost] = useState(0);
    const [vehicleLicenseCost, setVehicleLicenseCost] = useState(0);

    const [policeCmrisCost, setPoliceCmrisCost] = useState(0);
    const [policeCMRISTotal, setPoliceCMRISTotal] = useState(0);
    const [isPoliceCmrisChecked, setIsPoliceCmrisChecked] = useState(false);

    const handleUserChange = (event) => {
        const selectedOwnerId = event.target.value;
        setUserId(selectedOwnerId);
        setVehicleCategoryId('');
        if(selectedOwnerId && stateId){
            axios.post(`${url}/agent/owner-vehicleOwnership-vehicleCategory`, { 
                stateId: stateId ,
                ownerId: selectedOwnerId,
            }).then(response => {
                setStateVehicleList(response.data.stateVehicleList || []);
            }).catch(error => {
                console.error('Error sending stateId:', error);
            });
        }
    }

    useEffect(() => {
        axios.get(`${url}/agent/get-user-add-vehicles-ownership`)
            .then(response => {
                setVehicleCount(response.data.vehicleCount);
                setStateList(response.data.stateList);
                setLoading(false);
            })
            .catch(error => {
                console.error('Error fetching vehicle data:', error);
                setLoading(false);
            });
    }, [url]);

    useEffect(() => {
      
        const calculateTotalAmount = () => {
           
            axios.post(`${url}/agent/vehicleOwnershipCost`, { 
                stateId,
                vehicleCategoryId,
                addVehicleOwnership,
                vLExpirydate,
                hackneyPermit, 
                plateType
            })
                .then(response => {
                    console.log(` updated successfully`, response.data);
                    setVehicleCost(response.data.vehicleCost);
                    setHackneyPermitCost(response.data.hackneyPermitCost);
                    setVehicleLicenseCost(response.data.vehicleLicenseCost); 
                    setPoliceCmrisCost(response.data.policeCMRISCost); 
                })
                .catch(error => {
                    console.error(`Error updating ${option}:`, error);
                });
        };
        calculateTotalAmount();

      

        if (stateId) {
            axios.get(`${url}/agent/owner-vehicleOwnership-selection`)
            .then(response => {
                setUserList(response.data.userList);
            })
            .catch(error => {
                console.error('Error fetching users data:', error);
                setLoading(false);
            });
        }
   
        axios.post(`${url}/agent/vehicleOwnership-vehicleCategoryId-selection`, {
                vehicleCategoryId,
                stateId
            })
            .then(response => {
                setVehicleList(response.data.vehicleList  || []);
            })
            .catch(error => {
                console.error('Error sending vehicleCategoryId:', error);
        });
        
    }, [vehicleCategoryId, stateId, vLExpirydate, hackneyPermit, addVehicleOwnership,  plateType]);

    useEffect(() => {

        const PoliceCmrisTotel = isPoliceCmrisChecked ? policeCmrisCost: 0;
        setPoliceCMRISTotal(PoliceCmrisTotel);
        setTotalAmount(
            Number(vehicleCost) + Number(hackneyPermitCost) + Number(vehicleLicenseCost) + Number(PoliceCmrisTotel)
        );

    }, [vehicleCost, hackneyPermitCost, vehicleLicenseCost, isPoliceCmrisChecked, policeCmrisCost]);


    const handleVehicleOwnership = ()=>{
        window.location.href = `${url}/agent/addvehicleownership`;
    }

    const sendUpdateToBackend = (option, value) => {
        console.log(`${option} updated successfully ${value}`,);
    };
    const handleCheckboxChange = (event) => {
        const { name, checked } = event.target;
    
        switch (name) {
            case "policeCMRIS":
                setIsPoliceCmrisChecked(checked);
                break;
            default:
                break;
        }
    };
    const handleSelectChange = (event, option) => {
       
        const value = event.target.value;
        switch (option) {
            case 'stateId':
                setStateId(value);
                break;
            case 'vehicleCategoryId':
                    setVehicleCategoryId(value);
                    break;
            case 'addVehicleOwnership':
                setAddVehicleOwnership(value);
                if (value === "add-vehicle-ownership") {
                    window.location.href = `${url}/agent/addvehicleownership`;
                    return;
                }
                break;
            case 'vLExpirydate':
                setHandleVLExpirydate(value);
                break;
            case 'hackneyPermit':
                setHackneyPermit(value);
                break;
            case 'plateNumber':
                setPlateType(value);
                break;
            default:
                break;
        }
        sendUpdateToBackend(option, value); 
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setButtonLoading(true);
        const formData = {
            stateId,
            vehicleCategoryId,
            addVehicleOwnership,
            vLExpirydate,
            hackneyPermit,
            plateType,
            policeCMRISTotal,
            totalAmount,
        };
        axios.post(`${url}/agent/post-changeofownership`, {
            stateId:stateId,
            ownerId:userId,
            userType:'agent',
            vehicleCategoryId: vehicleCategoryId,
            addVehicleOwnership:addVehicleOwnership,
            vLExpirydate:vLExpirydate,
            hackneyPermit:hackneyPermit,
            plateType:plateType,
            policeCMRISTotal:policeCMRISTotal,
            totalAmount:totalAmount,
        })
        .then(response => {
            console.log('Successfully sent vehicleCategoryId:', response.data);

            setTimeout(()=>{
                window.location.href = `${url}/agent/cart`;
                setButtonLoading(false);
            },1100)
        })
        .catch(error => {
            console.error('Error sending vehicleCategoryId:', error);
        });
        console.log("Form data submitted: ", formData);
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
                                            <a href='#'>
                                                <i className="bx bx-home-alt"></i>
                                            </a>
                                        </li>
                                        <li className="breadcrumb-item active" aria-current="page">
                                           Change of Ownership
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
                                    <h5 className="mb-0 text-primary"> Change of Ownership</h5>
                                </div>
                                <hr />
 
                                
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
                                                                Processing and Delivery Time: 72 hours to 5 working days
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
                                                        <div className="row mb-2">
                                                            <div className="col-md-1 mb-2"></div>
                                                            <div className="col-md-10">
                                                                <label htmlFor="stateId" className="form-label">Select State</label>
                                                                <select
                                                                    required
                                                                    value={stateId || ''}
                                                                    onChange={(e) => handleSelectChange(e, 'stateId')}
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
                                                            <div className=" col-md-1 mb-2"></div>
                                                            <div className=" col-md-10">
                                                                <label className="form-label">Select Owner</label>
                                                                <select
                                                                    required 
                                                                    value={userId || ''}
                                                                    onChange={handleUserChange}
                                                                    name="userId"
                                                                    id="userId"
                                                                    className="form-select"
                                                                >
                                                                    <option disabled value="">-- Select Owner --</option>
                                                                    {userList.map((userList) => (
                                                                        <option key={userList.id} value={userList.id}>
                                                                              {userList.ownerfullname} ({userList.user_email})
                                                                        </option>
                                                                    ))}
                                                                </select>
                                                            </div>
                                                            <div className=" col-md-1 mb-2"></div>
                                                        </div>

                                                        <div className="row mb-2">
                                                            <div className="col-md-1 mb-2"></div>
                                                            <div className="col-md-10">
                                                            <label htmlFor="vehicleCategoryId" className="form-label">Select the Vehicle Category</label>
                                                            <select required value={vehicleCategoryId || ''} onChange={(e) => handleSelectChange(e, 'vehicleCategoryId')} name="vehicleCategoryId" id="vehicleCategoryId" className="form-select"  >
                                                                <option disabled value="">-- Select Vehicle Type --</option>
                                                                {stateVehicleList.map((vehicleType) => (
                                                                <option key={vehicleType.vehicle_type.id} value={vehicleType.vehicle_type.id}>
                                                                    {vehicleType.vehicle_type.name}
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
                                                                required value={addVehicleOwnership || ''} name="addVehicleOwnership"
                                                                id="addVehicleOwnership" className="form-select"
                                                                onChange={(e) => handleSelectChange(e, 'addVehicleOwnership')}
                                                            >
                                                                <option disabled value="">-- Select Vehicle --</option>
                                                                <option value="add-vehicle-ownership">+ Add Vehicle Ownership</option>
                                                                {vehicleList.map((vehicle) => (
                                                                <option key={vehicle.id} value={vehicle.category}>
                                                                    {vehicle.vehiclemodel} -  {vehicle.platenumber} 
                                                                </option>
                                                                ))}
                                                            </select>
                                                            </div>
                                                            <div className="col-md-1 mb-2"></div>
                                                        </div>

                                                        {addVehicleOwnership && (
                                                            <>
                                                            <div className="row mb-2 mt-2">
                                                                <div className="col-md-1 mb-2"></div>
                                                                <div className="col-md-10">
                                                                <label  className="form-label"> Vehicle License Expiry Date </label>
                                                                <select required value={vLExpirydate}  onChange={(e) => handleSelectChange(e, 'vLExpirydate')} name="vLExpirydate" id="vLExpirydate" className="form-select"  >
                                                                    <option value="">-- Select Vehicle License Expiry  --</option>
                                                                    <option value="lessthan1month">Less than 1 month</option>
                                                                    <option value="morethan1month">More than 1 month</option>
                                                                    <option value="morethan1year">More than 1 year</option>
                                                                    <option value="morethan2year">More than 2 year</option>
                                                                    <option value="morethan3year">More than 3 year</option>
                                                                    <option value="morethan4year">More than 4 year</option>
                                                                    <option value="morethan5year">More than 5 year</option>
                                                                    <option value="morethan6year">More than 6 year</option>
                                                                    <option value="morethan7year">More than 7 year</option>
                                                                </select>
                                                                </div>
                                                                <div className="col-md-1 mb-2"></div>
                                                            </div>

                                                            <div className="row mb-0 ">
                                                                <div className="col-1"></div>
                                                                <div class="col-md-10 mb-3">
                                                                    <label for="inputState" class="form-label"> Hackney Permit</label>
                                                                    <select required value={hackneyPermit} onChange={(e) => handleSelectChange(e, 'hackneyPermit')}  id="hackneyPermit" name="hackneyPermit" class="form-select">
                                                                        <option selected disabled>-- Select Hackney Permit: --</option>
                                                                        <option value="lessthan1month">Less than 1 month</option>
                                                                        <option value="morethan1month">More than 1 month</option>
                                                                        <option value="morethan1year">More than 1 year</option>
                                                                        <option value="morethan2year">More than 2 year</option>
                                                                        <option value="morethan3year">More than 3 year</option>
                                                                        <option value="morethan4year">More than 4 year</option>
                                                                        <option value="morethan5year">More than 5 year</option>
                                                                        <option value="morethan6year">More than 6 year</option>
                                                                        <option value="morethan7year">More than 7 year</option>
                                                                    </select>
                                                                </div>
                                                                <div className="col-1"></div>
                                                            </div>

                                                            <div className="row mb-2 mt-2">
                                                                <div className="col-md-1"></div>
                                                                <div className="col-md-10">
                                                                <label className="form-label">Type of Plate Number</label>
                                                                <select required value={plateType} onChange={(e) => handleSelectChange(e, 'plateNumber')}  name="plateType" id="plateType" className="form-select">
                                                                    <option disabled >-- Select type of Plate Number --</option>
                                                                    <option value="RPN">New Random Plate Number</option>
                                                                    <option value="CPN">New Customised Plate Number</option>
                                                                </select>
                                                                </div>
                                                                <div className="col-md-1"></div>
                                                            </div>

                                                            <div className="row mb-0 card-body">
                                                                <div className="col-1"></div>
                                                                <div className="col-10">
                                                                <input
                                                                    checked={isPoliceCmrisChecked}
                                                                    onChange={(e) => handleCheckboxChange(e, 'policeCMRIS')}
                                                                    name="policeCMRIS"
                                                                    className="form-check-input me-2"
                                                                    type="checkbox"
                                                                    id="policeCMRIS"
                                                                />
                                                                <label className="form-check-label" htmlFor="policeCmr">Police CMRIS</label>
                                                                </div>
                                                                <div className="col-1"></div>
                                                            </div>

                                                           
                                                            </>
                                                        )}
                                                        <div className="row mb-2 mt-2">
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


                                                    <div className="col-md-12 align-items-center text-center">
                                                        <button
                                                            type="submit"
                                                            className="btn btn-primary"
                                                            disabled={buttonloading} 
                                                        >
                                                            {buttonloading ? 'Processing...' : 'Process Payment'} 
                                                        </button>
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

if (document.getElementById('agentChangeofOwnership')) {
    ReactDOM.createRoot(document.getElementById('agentChangeofOwnership')).render(
        <React.StrictMode>
            <ChangeofOwnership />
        </React.StrictMode>
    );
}
