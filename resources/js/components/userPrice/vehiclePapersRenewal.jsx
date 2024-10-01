import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';


export default function VehiclePapersRenewal() {
    const url = window.location.origin; 
    const [stateIdVR, setStateIdVR] = useState(0);
    const [stateList, setStateList] = useState([]);
    const [vehicleTypeList, setVehicleTypeList] = useState([]);
    const [vehicleTypeIdVR, setVehicleTypeIdVR] = useState(0);
    const [vehicleLicense, setVehicleLicense] = useState(false);
    const [vehicleLicenseCost, setVehicleLicenseCost] = useState(0);
    const [roadWorthiness, setRoadWorthiness] = useState(false);
    const [roadWorthinessCost, setRoadWorthinessCost] = useState(0);
    const [thirdPartyInsurance, setThirdPartyInsurance] = useState(false);
    const [thirdPartyInsuranceCost, setThirdPartyInsuranceCost] = useState(0);
    const [hackneyPermit, setHackneyPermit] = useState(false);
    const [hackneyPermitCost, setHackneyPermitCost] = useState(0);
    const [proofOwnership, setProofOwnership] = useState(false);
    const [proofOwnershipCost, setProofOwnershipCost] = useState(0);
    const [vehicleInspectionPickanddrop, setVehicleInspectionPickandDrop] = useState(false);
    const [vehicleInspectionPickanddropCost, setVehicleInspectionPickandDropCost] = useState(0);
    const [policeCMRIS, setPoliceCMRIS] = useState(false);
    const [policeCMRISCost, setPoliceCMRISCost] = useState(0);
    const [vehicleLicenseCount, setVehicleLicenseCount] = useState(1);
    const [hackneyPermitCount, setHackneyPermitCount] = useState(1);


  
    const [total, setTotal] = useState(0.00);

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

    useEffect(() => { 

        axios.get(`${url}/get-state/pricing`)
              .then(response => {
                  setStateList(response.data.stateList);
                  setVehicleTypeList(response.data.vehicleTypeList);
              
              })
              .catch(error => {
                  console.error('Error fetching vehicle data:', error);
              });
      }, [ url]);
  
    useEffect(() => {
      const fetchPricing = async () => {
          axios.post('/get-vehicle/renewal', {
            stateId: stateIdVR,
            vehicleTypeId: vehicleTypeIdVR,
          }).then(response => {
            console.log('Success pricing:', response.data);
            setVehicleLicenseCost(response.data.vehicleLicense);
            setRoadWorthinessCost(response.data.roadWorthiness);
            setProofOwnershipCost(response.data.proofOwnership);
            setThirdPartyInsuranceCost(response.data.thirdPartyInsurance);
            setHackneyPermitCost(response.data.hackneyPermit);
            setVehicleInspectionPickandDropCost(response.data.vehicleInspectionPickandDrop);
            setPoliceCMRISCost(response.data.policeCmris)
           
          }).catch(error => {
            console.error('Error sending vehicleCategoryId:', error);
        });
     
      }
      fetchPricing();
    }, [stateIdVR, vehicleTypeIdVR]);
  
    useEffect(() => {
      const calculateTotal = () => {
        let totalAmount = 0;
        
        const vehicleLicenseTotal = vehicleLicense ? Number(vehicleLicenseCost) * vehicleLicenseCount : 0; 
        const roadWorthinessTotal = roadWorthiness ? Number(roadWorthinessCost) : 0; 
        const proofOwnershipTotal = proofOwnership ? Number(proofOwnershipCost) : 0; 
        const thirdPartyInsuranceTotal = thirdPartyInsurance ? Number(thirdPartyInsuranceCost) : 0; 
        const hackneyPermitTotal = hackneyPermit ? Number(hackneyPermitCost) * hackneyPermitCount : 0; 
        const policeCMRISTotal = policeCMRIS ? Number(policeCMRISCost) : 0; 
        const vehicleInspectionPickanddropTotal = vehicleInspectionPickanddrop ? Number(vehicleInspectionPickanddropCost) : 0;
    
        totalAmount = Number(vehicleLicenseTotal) + roadWorthinessTotal + proofOwnershipTotal 
          + thirdPartyInsuranceTotal + hackneyPermitTotal + policeCMRISTotal + vehicleInspectionPickanddropTotal;
    
        setTotal(totalAmount);
      };
    
      calculateTotal();
    }, [vehicleLicense, vehicleLicenseCost, roadWorthiness, roadWorthinessCost, 
      proofOwnership, proofOwnershipCost, thirdPartyInsurance, thirdPartyInsuranceCost,
      hackneyPermit, hackneyPermitCost, policeCMRIS, policeCMRISCost, vehicleInspectionPickanddrop, 
      vehicleInspectionPickanddropCost, vehicleLicenseCount, hackneyPermitCount
    ]);
    
  
    const handleCheckboxChange = (event) => {
      const { name, checked } = event.target;
  
      switch (name) {
          case "roadWorthiness":
              setRoadWorthiness(checked);
              break;
          case "vehicleLicense":
              setVehicleLicense(checked);
              break;
          case "proofOfOwnership":
              setProofOwnership(checked);
              break;
          case "thirdPartyInsurance":
              setThirdPartyInsurance(checked);
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
    
    const handleState = (event) => {
      const state = event.target.value;
      setStateIdVR(state);
      setVehicleTypeIdVR('');
  }
    const handleVehicleTypeIdVR = (event) => {
        const vehicleCategoryId = event.target.value;
        setVehicleTypeIdVR(vehicleCategoryId);
    }   
  
    const handleVehicleRenewal = (event) => {
      const vehicleCategoryId = event.target.value;
      window.location.href = `${url}/home/vehicle/paper/renewal`;
    }

    return (
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Vehicle Papers Renewal
                </button> 
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <b>
                        Hey there! Choose the vehicle type and Select the options 
                        you need to view the price. For instance, 
                        if it's a commercial vehicle that carries loads and passengers 
                        , remember to select 
                        the Hackney Permit option.
                        </b>
                    </div> 
                    <div class="card border-top border-0 border-4 ">
                        <div class="card-body pt-1">
                            <div class="ct_opt" id="renewwalPaper"> 
                                <div className="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-4">
                                        <label for="inputState" class="form-label">Select State</label>
                                        <select required name="stateIdVR"
                                            id="stateIdVR" className="form-select" onChange={handleState} value={stateIdVR}
                                        >
                                            <option  value="">-- Select State --</option>
                                            {stateList.map((state) => (
                                                <option key={state.id} value={state.id}>
                                                    {state.name}
                                                </option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-10 "></div>
                                </div>

                                <div className="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label">Select Category of Vehicle</label>
                                        <select required name="vehicleForm" id="vehicleForm"
                                            className="form-select" onChange={handleVehicleTypeIdVR} value={vehicleTypeIdVR} >
                                            <option  value="">-- Select Vehicle --</option>
                                            {vehicleTypeList.map((vehicleType) => (
                                            <option key={vehicleType.id} value={vehicleType.id}>{vehicleType.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div class=" row mt-3 " >
                                    <div class="col-md-1" > </div>
                                    <div class="col-md-5">
                                        <input onChange={handleCheckboxChange} checked={vehicleLicense} name="vehicleLicense" class="form-check-input  me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne"> Vehicle License</label>  
                                    </div>

                                    <div class="col-md-5">
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
                                                    <div class= "additionSubtraction plusFigure" onClick={incrementCount} >+</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>

                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <input onChange={handleCheckboxChange} checked={roadWorthiness} class="form-check-input me-2" type="checkbox"  name="roadWorthiness" />
                                        <label class="form-check-label" for="addOne">Road Worthiness</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <input onChange={handleCheckboxChange} checked={proofOwnership} class="form-check-input me-2" type="checkbox"  name="vehicleInspectionPickanddrop" />
                                        <label class="form-check-label" for="addOne"> Proof Ownership</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                                
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-10">
                                        <input onChange={handleCheckboxChange} checked={thirdPartyInsurance} class="form-check-input me-2" type="checkbox"  name="thirdPartyInsurance" />
                                        <label class="form-check-label" for="addOne">Third-Party Insurance</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                               
                                <div class=" row mt-2 " >
                                    <div class="col-sm col-md-1 " > </div>
                                    <div class="col-sm col-md-5">
                                        <input onChange={handleCheckboxChange} checked={hackneyPermit} class="form-check-input me-2" type="checkbox"  name="hackneyPermit" />
                                        <label class="form-check-label" for="addOne">Hackney Permit</label>
                                    </div>

                                    <div class="col-sm col-md-5">
                                        <label for="inputAddress2" class="form-label"> Expiry Date</label>
                                        <table class="padding-no margin-no additionSubtractionTable  ">
                                            <tr>
                                                <td class= "padding-no margin-righ-no col-md-1" >			
                                                    <div className="additionSubtraction minusFigure" onClick={decrementCountHP} >-</div>
                                                </td>
                                                <td className="padding-no margin-right-no col-md-5">
                                                    <div className="padding-xs">
                                                        <input name="addvehicleLicense" type="number" className="form-control additionSubtractionForm additionSubtractionButtonTwo" id="addSubInput" min="1" value={hackneyPermitCount} readOnly />
                                                    </div>
                                                </td>
                                                <td class= "padding-no margin-right-no col-md-1">
                                                    <div class= "additionSubtraction plusFigure" onClick={incrementCountHP} >+</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class= "col-sm col-md-1 " > </div>
                                </div>
                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <input onChange={handleCheckboxChange} checked={vehicleInspectionPickanddrop} class="form-check-input me-2" type="checkbox"  name="vehicleInspectionPickanddrop" />
                                        <label class="form-check-label" for="addOne">Book Vehicle Inspection Pick & Drop</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                                
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-10">
                                        <input onChange={handleCheckboxChange} checked={policeCMRIS} class="form-check-input me-2" type="checkbox"  name="policeCMRIS" />
                                        <label class="form-check-label" for="addOne">Police CMRIS</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                                <div className="row card-body">
                                    <div className="col-md-1"></div>
                                    <div class=" col-md-10 text-center ">
                                        <div class="alert alert-info mt-2">TOTAL AMOUNT: 
                                            <span style={{fontSize: '16px'}} className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(total)}</span>
                                        </div>
                                        <div class="main-btn-wrap" > 
                                            <center> <a onClick={handleVehicleRenewal}  class="btn btn-primary px-5 text-center" > Process Paper </a></center>
                                        </div>
                                    </div>
                                    <div className="col-md-1"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    );
}