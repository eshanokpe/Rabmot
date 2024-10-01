import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';


export default function ChangeofOwnership() {

    const url = window.location.origin;
    const [stateIdCO, setStateIdCO] = useState('');
    const [vehicleTypeIdCO, setvehicleTypeIdCO] = useState('');
    const [stateList, setStateList] = useState([]);
    const [vehicleTypeList, setVehicleTypeList] = useState([]);

    const [vehicleLicenseDate, setVehicleLicenseDate] = useState('');
    const [hacneyPermitDate, setHacneyPermitDate] = useState('');
    const [plateNumber, setPlateNumber] = useState('RPN');

    const [vehicleCost, setVehicleCost] = useState(0);
    const [hackneyPermitCost, setHackneyPermitCost] = useState(0);
    const [vehicleLicenseCost, setVehicleLicenseCost] = useState(0);
    const [policeCMRIS, setPoliceCMRIS] = useState(false);
    const [policeCMRISCost, setPoliceCMRISCost] = useState(0);

    const [totalAmount, setTotal] = useState('0.00');


    useEffect(() => { 
        axios.get(`${url}/get-state/changeofownership/`)
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
       
            axios.post(`${url}/get-changeofownership/price`, {
              stateId: stateIdCO,
              vehicleTypeId: vehicleTypeIdCO,
              vehicleLicenseDate:vehicleLicenseDate,
              numberPlateType: plateNumber,
              hacneyPermitDate:hacneyPermitDate
            }).then(response => {
              console.log('Success pricing:', response.data);
              setVehicleCost(response.data.vehicleCost);
              setHackneyPermitCost(response.data.hackneyPermitCost);
              setVehicleLicenseCost(response.data.vehicleLicenseCost);
              setPoliceCMRISCost(response.data.policeCmrisCost)
            }).catch(error => {
              console.error('Error sending vehicleCategoryId:', error);
            });
       
        }
        fetchPricing();
    }, [url, stateIdCO, vehicleTypeIdCO, vehicleLicenseDate, hacneyPermitDate ]);
    
    useEffect(() => {
        const calculateTotal = () => {
          let amount = 0;
          let policeCMRISTotal = 0;
    
          
          if(policeCMRIS){
            policeCMRISTotal = Number(policeCMRISCost);
          }
          
          amount = Number(vehicleCost) + policeCMRISTotal;
          setTotal(amount);
        };
    
        calculateTotal();
      }, [vehicleCost, hackneyPermitCost, policeCMRIS, policeCMRISCost,
    ]);

    const handleStateCO = (event) => {
        const state = event.target.value;
        setStateIdCO(state);
        setvehicleTypeIdCO(''); 
        setVehicleLicenseDate('')
        setHacneyPermitDate('')
    }
    const handleVehicleTypeIdCO = (event) => {
        const vehicleCategoryId = event.target.value;
        setvehicleTypeIdCO(vehicleCategoryId);
    }  
    const handleCheckboxChange = (event) => {
        const { name, checked } = event.target;
    
        switch (name) {
            case "policeCMRIS":
                setPoliceCMRIS(checked);
                break;
            default:
                break;
        }
    };

    const handleChangeOwnership = (event) => {
        window.location.href = `${url}/home/changeofOwnership`;
    }
    

    return (
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Change of Ownership
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <b>
                            Select the type of Vehicle, then select all the options you require, to see the acccurate price.
                        </b>
                    </div> 
                    <div class="card border-top border-0 border-4 ">
                        <div class="card-body pt-1">
                            <div class="ct_opt" id="renewwalPaper"> 
                                <div className="row mt-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label">Select State</label>
                                        <select required className="form-select" onChange={handleStateCO} value={stateIdCO} >
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
                                        <select required className="form-select" onChange={handleVehicleTypeIdCO} value={vehicleTypeIdCO} >
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
                                        <label for="inputState" class="form-label">Document Expiration Date</label>
                                        <select className="form-select" value={vehicleLicenseDate} onChange={(e) => setVehicleLicenseDate(e.target.value)}>
                                            <option  >-- Select Vehicle License: --</option>
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
                                    <div class="col-md-1"></div>
                                </div>

                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <label for="inputState" class="form-label"> Hackney Permit </label>
                                        <select className="form-select" value={hacneyPermitDate} onChange={(e) => setHacneyPermitDate(e.target.value)}>
                                            <option  >-- Select Hackney Permit: --</option>
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
                                    <div class="col-md-1 " > </div>
                                </div>

                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-10">
                                        <label for="inputState" class="form-label"> Type of Plate Number </label>
                                        <select className="form-select" value={plateNumber} onChange={(e) => setPlateNumber(e.target.value)}>
                                            <option selected disabled>-- Type of Plate Number: --</option>
                                            <option value="RPN">New Random Plate Number</option>
                                            <option value="CPN">New Customised Plate Number</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>

                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-10">
                                        <input className="form-check-input" type="checkbox"  name="policeCMRIS" checked={policeCMRIS} onChange={handleCheckboxChange} />
                                        <label class="form-check-label" for="addOne">Police CMRIS</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>

                                <div className="row card-body">
                                    <div className="col-md-1"></div>
                                    <div class=" col-md-10 text-center ">
                                        <div class="alert alert-info mt-2"  style={{ fontSize: '14px',  }}>TOTAL AMOUNT:
                                            <span className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>
                                        </div>
                                        <div class="main-btn-wrap" > 
                                            <center> <a onClick={handleChangeOwnership} class="btn btn-primary px-5 text-center" > Process Paper </a></center>
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