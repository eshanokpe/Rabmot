import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

export default function VehicleRenewalPaper() {
    const url = window.location.origin;
    const [vehicleCount, setVehicleCount] = useState(0);
    const [vehicleList, setVehicleList] = useState([]);
    const [stateList, setStateList] = useState([]);
    const [stateVehicleList, setStateVehicleList] = useState([]);
    const [stateId, setStateId] = useState('');
    const [vehicleCategoryId, setVehicleCategoryId] = useState('');
    const [loading, setLoading] = useState(true);
    const [vehicleLicenseCount, setVehicleLicenseCount] = useState(1);
    const [addVehicleRenewal, setAddVehicleRenewal] = useState(null);
    const [vehicleLicense, setVehicleLicense] = useState(false);
    const [vehicleLicenseCost, setVehicleLicenseCost] = useState(0);
    const [roadWorthiness, setRoadWorthiness] = useState(false);
    const [roadWorthinessCost, setRoadWorthinessCost] = useState(0);
    const [thirdPartyInsurance, setThirdPartyInsurance] = useState(false);
    const [thirdPartyInsuranceCost, setThirdPartyInsuranceCost] = useState(0);
    const [proofOfOwnership, setProofOfOwnership] = useState(false);
    const [proofOfOwnershipCost, setProofOfOwnershipCost] = useState(0);
    const [hackneyPermit, setHackneyPermit] = useState(false);
    const [hackneyPermitCost, setHackneyPermitCost] = useState(null);
    const [policeCMRIS, setPoliceCMRIS] = useState(false);
    const [policeCMRISCost, setPoliceCMRISCost] = useState(null);
    const [hackneyPermitCount, setHackneyPermitCount] = useState(1);
    const [vehicleInspectionPickanddrop, setVehicleInspectionPickandDrop] = useState(false);
    const [vehicleInspectionPickanddropCost, setVehicleInspectionPickanddropCost] = useState(null);
    const [totalAmount, setTotalAmount] = useState(0);

    // Individual totals state
    const [vehicleLicenseTotal, setVehicleLicenseTotal] = useState(0);
    const [roadWorthinessTotal, setRoadWorthinessTotal] = useState(0);
    const [thirdPartyInsuranceTotal, setThirdPartyInsuranceTotal] = useState(0);
    const [proofOfOwnershipTotal, setProofOfOwnershipTotal] = useState(0);
    const [hackneyPermitTotal, setHackneyPermitTotal] = useState(0);
    const [vehicleInspectionPickanddropTotal, setVehicleInspectionPickanddropTotal] = useState(0);
    const [policeCMRISTotal, setPoliceCMRISTotal] = useState(0);

    const handleStateChange = (event) => {
        const selectedStateId = event.target.value;
        setStateId(selectedStateId);
        setVehicleCategoryId('');

        if (selectedStateId) {
            axios.post(`${url}/home/vehicleRenewal-state-selection`, {
                stateId: selectedStateId,
            })
            .then(response => {
                console.log('Successfully sent stateId:', response.data);
                setStateVehicleList(response.data.stateVehicleList);
            })
            .catch(error => {
                console.error('Error sending stateId:', error);
            });
        }
    };

    const incrementCount = () => {
        setVehicleLicenseCount(prevCount => prevCount + 1);
    };
    const decrementCount = () => {
        if (vehicleLicenseCount > 1) {
            setVehicleLicenseCount(prevCount => prevCount - 1);
        }
    };
    
    const incrementCountHP = () => {
        setHackneyPermitCount(prevCount => prevCount + 1);
    };

    const decrementCountHP = () => {
        if (hackneyPermitCount > 1) {
            setHackneyPermitCount(prevCount => prevCount - 1);
        }
    };

    const handleVehicleCategoryId = (event) => {
        const vehicleCategoryId = event.target.value;
        setVehicleCategoryId(vehicleCategoryId);
    }

    useEffect(() => {
        setVehicleList([]);
        axios
            .post(`${url}/home/vehicleRenewal-vehicleCategoryId-selection`, {
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
        setAddVehicleRenewal(addVehicleValue);
        if (addVehicleValue === "add-renewal") {
            window.location.href = `${url}/home/addvehiclerenewal`;
        } else if (addVehicleValue !== "") {
            console.log('Selected vehicle ID:', addVehicleValue);
            axios.post(`${url}/home/vehicleRenewal-addVehicleValue-selection`, {
                addVehicleValue: addVehicleValue,
                vehicleCategoryId: vehicleCategoryId,
                stateId: stateId,
            })
            .then(response => {
                console.log('VehicleLicenseCost:', response.data.vehicleLicenseCost);
                console.log('VehicleRenewal:', response.data);
                setVehicleLicenseCost(response.data.vehicleLicenseCost);
                setRoadWorthinessCost(response.data.roadWorthinessCost);
                setThirdPartyInsuranceCost(response.data.thirdPartyInsuranceCost);
                setProofOfOwnershipCost(response.data.proofOfOwnershipCost);
                setHackneyPermitCost(response.data.hackneyPermitCost);
                setPoliceCMRISCost(response.data.policeCmrisCost);
                setVehicleInspectionPickanddropCost(response.data.vehicleInspectionPickanddropCost);

               
            })
            .catch(error => {
                console.error('Error sending vehicleCategoryId:', error);
            });
        }
    };

    useEffect(() => {
        
        axios.get(`${url}/home/get-user-add-vehicles-renewal`)
            .then(response => {
                setVehicleCount(response.data.vehicleCount);
                setStateList(response.data.stateList);
                setLoading(false);
            })
            .catch(error => {
                console.error('Error fetching vehicle data:', error);
                setLoading(false);
            });
    }, [
       url
    ]);
    
    useEffect(() => {
    const calculateTotalAmount = () => {
        
        const vehicleLicenseTotal = vehicleLicense ? Number(vehicleLicenseCost) * vehicleLicenseCount : 0;
        const roadWorthinessTotal = roadWorthiness ? Number(roadWorthinessCost) : 0;
        const thirdPartyInsuranceTotal = thirdPartyInsurance ? Number(thirdPartyInsuranceCost) : 0;
        const proofOfOwnershipTotal = proofOfOwnership ? Number(proofOfOwnershipCost) : 0;
        const hackneyPermitTotal = hackneyPermit ? Number(hackneyPermitCost) * hackneyPermitCount : 0;
        const policeCMRISTotal = policeCMRIS ? Number(policeCMRISCost) : 0;
        const vehicleInspectionPickanddropTotal = vehicleInspectionPickanddrop ? Number(vehicleInspectionPickanddropCost) : 0;

        setTotalAmount(
            vehicleLicenseTotal +
            roadWorthinessTotal +
            thirdPartyInsuranceTotal +
            proofOfOwnershipTotal +
            hackneyPermitTotal +
            policeCMRISTotal +
            vehicleInspectionPickanddropTotal
        );
        // Set the individual totals in state
        setVehicleLicenseTotal(vehicleLicenseTotal);
        setRoadWorthinessTotal(roadWorthinessTotal);
        setThirdPartyInsuranceTotal(thirdPartyInsuranceTotal);
        setProofOfOwnershipTotal(proofOfOwnershipTotal);
        setHackneyPermitTotal(hackneyPermitTotal);
        setPoliceCMRISTotal(policeCMRISTotal);
        setVehicleInspectionPickanddropTotal(vehicleInspectionPickanddropTotal);

        
    };
    calculateTotalAmount();
    },[
        vehicleLicense, vehicleLicenseCost, vehicleLicenseCount,
        roadWorthiness, roadWorthinessCost,
        thirdPartyInsurance, thirdPartyInsuranceCost,
        proofOfOwnership, proofOfOwnershipCost,
        hackneyPermit, hackneyPermitCost, hackneyPermitCount,
        policeCMRIS, policeCMRISCost,
        vehicleInspectionPickanddrop, vehicleInspectionPickanddropCost
    ]);
    
    const handleCheckboxChange = (event) => {
        const { name, checked } = event.target;
    
        switch (name) {
            case "vehicleLicense":
                setVehicleLicense(checked);
                break;
            case "roadWorthiness":
                setRoadWorthiness(checked);
                break;
            case "thirdPartyInsurance":
                setThirdPartyInsurance(checked);
                break;
            case "proofOfOwnership":
                setProofOfOwnership(checked);
                break;
            case "hackneyPermit":
                setHackneyPermit(checked);
                break;
            case "policeCMRIS":
                setPoliceCMRIS(checked);
                break;
            case "vehicleInspectionPickanddrop":
                setVehicleInspectionPickandDrop(checked);
            default:
                break;
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (totalAmount === 0) {
            // Show a message or alert to the user
            alert('Please select an option to proceed. The total amount cannot be 0.');
            return; // Stop the form submission if totalAmount is 0
        }
        const formData = {
            stateId,
            vehicleCategoryId,
            addVehicleRenewal,
            vehicleLicenseTotal,
            roadWorthinessTotal,
            thirdPartyInsuranceTotal,
            proofOfOwnershipTotal,
            hackneyPermitTotal,
            vehicleInspectionPickanddropTotal,
            policeCMRISTotal,
            totalAmount
        }; 
        axios.post(`${url}/home/post-vehicleRenewal`, {
            stateId:stateId,
            userType:'user',
            vehicleCategoryId: vehicleCategoryId,
            addVehicleRenewal:addVehicleRenewal,
            vehicleLicenseTotal:vehicleLicenseTotal,
            roadWorthinessTotal:roadWorthinessTotal,
            thirdPartyInsuranceTotal:thirdPartyInsuranceTotal,
            proofOfOwnershipTotal:proofOfOwnershipTotal,
            hackneyPermitTotal:hackneyPermitTotal,
            vehicleInspectionPickanddropTotal:vehicleInspectionPickanddropTotal,
            policeCMRISTotal:policeCMRISTotal,
            totalAmount:totalAmount
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
    }
    
    const handleVehicleRenawel = ()=>{
        window.location.href = `${url}/home/addvehiclerenewal`;
    }

    if (loading) {
        return <div>Loading...</div>;
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
                                            Renew Vehicle
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
                                    <h5 className="mb-0 text-primary">Vehicles Papers Renewal</h5>
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
                                                                Please Check or Uncheck what papers you want renewed. Note that for Lagos State, you only get a Road Worthiness Referral Note to visit a LACVIS Centre within 30 days of payment
                                                            </h6>
                                                            <h6 className="text-justify card-title text-danger">
                                                                TIMELINE
                                                            </h6>
                                                            <h6 className="card-subtitle mb-2">
                                                                Renewals of vehicle papers are done within 24 hours but during festive periods, there may be slight delays.
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div className="alert alert-danger alert-dismissible fade show" role="alert">
                                                <span className="alert-link">Oh Snap!</span> You need to add a vehicle to start the Renewal Process. 
                                                <a onClick={handleVehicleRenawel}  style={{cursor:'pointer'}} className="alert-link">Add Vehicle Renewal</a>
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
                                                   
                                                    <div className="ct_opt" >
                                                        <div className="row">
                                                            <div className=" col-md-1 mb-2"></div>
                                                                <div className=" col-md-10 mb-2">
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
                                                            <div className=" col-md-1 mb-2"></div>
                                                        </div>
                                                        
                                                        <div className="row">
                                                            <div className=" col-md-1 mb-3"></div>
                                                            <div className=" col-md-10">
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
                                                            <div className=" col-md-1 mb-3"></div>
                                                        </div>

                                                        <div className="row">
                                                            <div className=" col-md-1 mb-3"></div>
                                                            <div className="col-md-10">
                                                                <label htmlFor="vehicleForm" className="form-label">
                                                                    Select the Option of your choice
                                                                </label>
                                                                <select
                                                                    required
                                                                    value={addVehicleRenewal || ''}
                                                                    name="vehicleType"
                                                                    id="vehicleForm"
                                                                    className="form-select"
                                                                    onChange={handleAddVehicleChange}
                                                                >
                                                                    <option disabled value="">
                                                                        -- Select Vehicle --
                                                                    </option>
                                                                    <option value="add-renewal">
                                                                        + Add Vehicle Renewal
                                                                    </option>
                                                                    {vehicleList.map((vehicle) => (
                                                                        <option key={vehicle.category} value={vehicle.category}>
                                                                            {vehicle.vehiclebrand} {vehicle.vehiclemodel} ({vehicle.platenumber})
                                                                        </option>
                                                                    ))}
                                                                </select>
                                                            </div>
                                                            <div className=" col-md-1 mb-3"></div>
                                                        </div>


                                                        <div class="card-body">
                                                            <div class=" row mb-0 " >
                                                                <div class="col-1 " >
                                                                </div>
                                                                <div class="col-6">
                                                                    <input onChange={handleCheckboxChange} name='vehicleLicense' checked={vehicleLicense} class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                                                    <label class="form-check-label" for="addOne">Vehicle License</label>
                                                                </div>

                                                                <div class="col-5">
                                                                    <label for="inputAddress2" class="form-label"> Expiry Date</label>
                                                                
                                                                    <table class="padding-no margin-no additionSubtractionTable  ">
                                                                        <tr>
                                                                            <td class= "padding-no margin-righ-no col-md-1" >			
                                                                                <div className="additionSubtraction minusFigure" onClick={decrementCount}>-</div>
                                                                            </td>
                                                                            <td className="padding-no margin-right-no col-md-5">
                                                                                <div className="padding-xs">
                                                                                    <input name="addvehicleLicense" type="number" className="form-control additionSubtractionForm additionSubtractionButtonTwo" id="addSubInput" min="1" value={vehicleLicenseCount} readOnly />
                                                                                </div>
                                                                            </td>
                                                                            <td class= "padding-no margin-right-no col-md-1">
                                                                                <div class= "additionSubtraction plusFigure"  onClick={incrementCount}>+</div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class=" row mb-0 " >
                                                                <div class="col-1 " >
                                                                </div>
                                                                <div class="col-10 mb-2">
                                                                    <input onChange={handleCheckboxChange} name="roadWorthiness" checked={roadWorthiness} class="form-check-input me-2" type="checkbox"  id="roadWorthiness"/>
                                                                    <label class="form-check-label" for="flexCheckDefault">Road Worthiness</label>
                                                                </div>
                                                            </div>
                                                            <div class=" row mb-0 " >
                                                                <div class="col-1 " >
                                                                </div>
                                                                <div class="col-10 mb-2">
                                                                    <input onChange={handleCheckboxChange} name="thirdPartyInsurance" checked={thirdPartyInsurance} class="form-check-input me-2" type="checkbox"  id="thirdPartyInsurance"/>
                                                                    <label class="form-check-label" for="flexCheckDefault">Third Party Insurance</label>
                                                                </div>
                                                            </div>
                                                            <div class=" row mb-0 " >
                                                                <div class="col-1 " >
                                                                </div>
                                                                <div class="col-10 mb-2">
                                                                    <input onChange={handleCheckboxChange} name="proofOfOwnership" checked={proofOfOwnership} class="form-check-input me-2" type="checkbox"  id="proofOfOwnership"/>
                                                                    <label class="form-check-label" for="flexCheckDefault">Proof Of Ownership</label>
                                                                </div>
                                                            </div>
                                                            <div class=" row mb-0 " >
                                                                <div class="col-1 " >
                                                                </div>
                                                                <div class="col-6">
                                                                    <input onChange={handleCheckboxChange} name='hackneyPermit' checked={hackneyPermit} class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                                                    <label class="form-check-label" for="addOne">Hackney Permit</label>
                                                                </div>

                                                                <div class="col-5">
                                                                    <label for="inputAddress2" class="form-label"> Expiry Date</label>
                                                                
                                                                    <table class="padding-no margin-no additionSubtractionTable  ">
                                                                        <tr>
                                                                            <td class= "padding-no margin-righ-no col-md-1" >			
                                                                                <div className="additionSubtraction minusFigure" onClick={decrementCountHP}>-</div>
                                                                            </td>
                                                                            <td className="padding-no margin-right-no col-md-5">
                                                                                <div className="padding-xs">
                                                                                    <input name="addvehicleLicense" type="number" className="form-control additionSubtractionForm additionSubtractionButtonTwo" id="addSubInput" min="1" value={hackneyPermitCount} readOnly />
                                                                                </div>
                                                                            </td>
                                                                            <td class= "padding-no margin-right-no col-md-1">
                                                                                <div class= "additionSubtraction plusFigure"  onClick={incrementCountHP}>+</div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class=" row mb-0 " >
                                                                <div class="col-1 " >
                                                                </div>
                                                                <div class="col-10 mb-2">
                                                                    <input onChange={handleCheckboxChange} name="vehicleInspectionPickanddrop" checked={vehicleInspectionPickanddrop} class="form-check-input me-2" type="checkbox"  id="vehicleInspectionPickanddrop"/>
                                                                    <label class="form-check-label" for="flexCheckDefault">Vehicle Inspection Pick and Drop</label>
                                                                </div>
                                                            </div>
                                                            <div class=" row mb-0 " >
                                                                <div class="col-1 " >
                                                                </div>
                                                                <div class="col-10 mb-2">
                                                                    <input onChange={handleCheckboxChange} name="policeCMRIS" checked={policeCMRIS} class="form-check-input me-2" type="checkbox"  id="policeCMRIS"/>
                                                                    <label class="form-check-label" for="flexCheckDefault">Police CMRIS</label>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="card-body  col-md-12 align-items-center text-center ">
                                                            <div id="mainPrice" class="alert alert-info mt-3">Total Amount: 
                                                                <span  >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>

                                                            </div>
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

if (document.getElementById('vehiclerenewalpaper')) {
    ReactDOM.createRoot(document.getElementById('vehiclerenewalpaper')).render(
        <React.StrictMode>
            <VehicleRenewalPaper />
        </React.StrictMode>
    );
}

