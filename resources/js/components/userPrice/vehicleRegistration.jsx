import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';


export default function VehicleRegistration() {

    const url = window.location.origin;
    const [stateId, setStateId] = useState(0);
    const [stateList, setStateList] = useState([]);
    const [vehicleTypeList, setVehicleTypeList] = useState([]);
    const [vehicleTypeId, setVehicleTypeId] = useState(0);
    const [vehicleRegistrationTypeList, setVehicleRegistrationTypeList] = useState([]);
    const [vehicleRegistrationTypeId, setVehicleRegistrationTypeId] = useState(0);
    const [numberPlateType, setNumberPlateType] = useState('RPN');

    const [hackneyPermit, setHackneyPermit] = useState(false);
    const [policeCMRIS, setPoliceCMRIS] = useState(false);

    const [hackneyPermitCost, setHackneyPermitCost] = useState(0);
    const [policeCMRISCost, setPoliceCMRISCost] = useState(0);

    const [total, setTotal] = useState(0.00);
    const [amount, setAmountCost] = useState(0);

    useEffect(() => { 

      axios.get(`${url}/get-state/vehicleregistration/`)
            .then(response => {
                setStateList(response.data.stateList);
                setVehicleTypeList(response.data.vehicleTypeList);
                setVehicleRegistrationTypeList(response.data.vehicleRegistrationType);
            
            })
            .catch(error => {
                console.error('Error fetching vehicle data:', error);
            });
    }, [ url]);

    const handleState = (event) => {
        const state = event.target.value;
        setStateId(state);
        setVehicleTypeId('');
        setVehicleRegistrationTypeId('');
    }
    const handleVehicleTypeId = (event) => {
        const vehicleCategoryId = event.target.value;
        setVehicleTypeId(vehicleCategoryId);
    }   
    const handleVehiclRegistrationeTypeId = (event) => {
        const vehicleRegistrationId = event.target.value;
        setVehicleRegistrationTypeId(vehicleRegistrationId);
    }   
    const handleNumberPlateType = (event) => {
        const plateType = event.target.value;
        setNumberPlateType(plateType);
    }   

    useEffect(() => {
      
        const fetchPricing = async () => {
          if(stateId && vehicleTypeId && vehicleRegistrationTypeId){
            
            axios.post('/get-vehicle-registration/price', {
              stateId: stateId,
              vehicleTypeId: vehicleTypeId,
              vehicleRegistrationTypeId: vehicleRegistrationTypeId,
              numberPlateType:numberPlateType,
            }).then(response => {
              console.log('Success pricing:', response.data);
              setHackneyPermitCost(response.data.hackneyPermitCost);
              setPoliceCMRISCost(response.data.policeCmrisCost)

              setAmountCost(response.data.totalAmount);
             
            }).catch(error => {
              console.error('Error sending vehicleCategoryId:', error);
            });
          }else{
            setAmountCost('0.00');

          }
        }
        fetchPricing();
    }, [stateId, vehicleTypeId, vehicleRegistrationTypeId,numberPlateType ]);
    
    useEffect(() => {
        const calculateTotal = () => {
          let totalAmount = 0;
          let hackneyPermitTotal = 0;
          let policeCMRISTotal = 0;
    
          
          if(hackneyPermit){
            hackneyPermitTotal = Number(hackneyPermitCost); 
          }
          if(policeCMRIS){
            policeCMRISTotal = Number(policeCMRISCost);
          }
          
          totalAmount =  Number(amount) + Number(hackneyPermitTotal) + Number(policeCMRISTotal);
          setTotal(totalAmount);
        };
    
        calculateTotal();
      }, [amount, hackneyPermit, hackneyPermitCost, policeCMRIS, policeCMRISCost,
      ]);

    const handleVehicleRegistration = (event) => {
        window.location.href = `${url}/home/new/vehicle/registration`;
    }

    const handleCheckboxChange = (event) => {
        const { name, checked } = event.target;
    
        switch (name) {
            case "hackneyPermit":
                setHackneyPermit(checked);
                break;
            case "policeCMRIS":
                setPoliceCMRIS(checked);
                break;
            default:
                break;
        }
    };
    

    return ( 
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    New Vehicle Registration
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <b>
                            Select the type of Vehicle, then select all the options you require to see the accurate price.
                            For instance, if it's a commercial vehicle that carries loads and passengers , remember to select the Hackney Permit option.
                        </b>
                    </div> 
                    <div class="card border-top border-0 border-4 ">
                        <div class="card-body pt-1">
                            <div class="ct_opt" id="renewwalPaper"> 
                                <div className="row mt-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-4">
                                        <label for="inputState" class="form-label">Select State</label>
                                        <select required name="stateId" id="stateId" className="form-select" onChange={handleState} value={stateId} >
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
                                            className="form-select" onChange={handleVehicleTypeId} value={vehicleTypeId} >
                                            <option  value="">-- Select Vehicle --</option>
                                            {vehicleTypeList.map((vehicleType) => (
                                            <option key={vehicleType.id} value={vehicleType.id}>{vehicleType.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div className="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label"> Registration Type</label>
                                        <select required value={vehicleRegistrationTypeId} onChange={handleVehiclRegistrationeTypeId} className="form-select">
                                            <option selected="selected">-- Select Registration Type --</option>
                                            {vehicleRegistrationTypeList.map((vehicleRegistrationType) => (
                                            <option key={vehicleRegistrationType.id} value={vehicleRegistrationType.id}>{vehicleRegistrationType.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div className="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label"> Plate Number Type</label>
                                        <select required className="form-select" value={numberPlateType} onChange={handleNumberPlateType}>
                                            <option disabled selected="selected">-- Type of Number Plate --</option>
                                            <option selected="selected" value="RPN">Random Plate Number</option>
                                            <option value="PCN">Personalized/Customize Number</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <input onChange={handleCheckboxChange} checked={hackneyPermit} class="form-check-input me-2" type="checkbox"  name="hackneyPermit" />
                                        <label class="form-check-label" for="addOne">Hackney Permit</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-10">
                                        <input onChange={handleCheckboxChange} checked={policeCMRIS} class="form-check-input me-2" type="checkbox"  name="policeCMRIS"  />
                                        <label class="form-check-label" for="addOne">Police CMRIS</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>

                 
                                <div className="row card-body">
                                    <div className="col-md-1"></div>
                                    <div class=" col-md-10 text-center ">
                                        <div class="alert alert-info mt-2">TOTAL AMOUNT: 
                                            <span className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(total)}</span>
                                        
                                        </div>
                                        <div class="main-btn-wrap" > 
                                            <center> <a onClick={handleVehicleRegistration} class="btn btn-primary px-5 text-center" > Process Paper </a></center>
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