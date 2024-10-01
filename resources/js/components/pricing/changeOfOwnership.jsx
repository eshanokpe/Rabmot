import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

export default function ChangeOfOwnership() {
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
        <div className='container'>
            <div className="col-lg-12 vehic" id="coo">
                <h2 className="widget-title padding-top-30 padding-bottom-20">
                    Change Of Ownership
                </h2>
                <div className="border-bottom padding-bottom-20">
                    <div className="row">
                        <div className="col-sm-5 mb-3">
                            <div className="bg-white border1 shadow">
                                <div className="note5 shadow-sm">
                                    <p>
                                        PROCESSING TIME <br />
                                        Change of Ownership. [72 hours -2.5 weeks] <br /><br />
                                        INSTRUCTION: <br />
                                        Only a vehicle registered in Nigeria by the previous owner is eligible for a
                                        Change of Ownership; <br /><br />
                                        Select the type of Vehicle, then select all the options you require, to see the
                                        accurate price. <br /><br />
                                        NOTE: <br /> You must select the HACKNEY PERMIT option for a vehicle that carries
                                        loads and passengers (Taxi, Commercial vehicle, Company Vehicle)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="col-sm-6 mb-3">
                            <div className="bg-white border1 shadow">
                                <div className="note shadow-sm">
                                    <span style={{ fontSize: '16px' }}>Select the Option of your choice.</span>
                                </div>

                                <div className="note1">
                                    <div className="input-group input-group-merge pt-2">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
                                        <select required className="form-select" onChange={handleStateCO} value={stateIdCO} >
                                            <option  value="">-- Select State --</option>
                                            {stateList.map((state) => (
                                                <option key={state.id} value={state.id}>
                                                    {state.name}
                                                </option>
                                            ))}
                                        </select>
                                    </div>
                                    <div className="input-group input-group-merge pt-3">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
                                        <select required className="form-select" onChange={handleVehicleTypeIdCO} value={vehicleTypeIdCO} >
                                            <option  value="">-- Select Vehicle --</option>
                                            {vehicleTypeList.map((vehicleType) => (
                                            <option key={vehicleType.id} value={vehicleType.id}>{vehicleType.name}</option>
                                            ))}
                                        </select>
                                    </div>

                                    <label className="pt-3">Document Expiration Date</label>
                                    <div className="input-group input-group-merge">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
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

                                    <div className="input-group input-group-merge pt-3">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
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

                                    <div className="input-group input-group-merge pt-3">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
                                        <select className="form-select" value={plateNumber} onChange={(e) => setPlateNumber(e.target.value)}>
                                            <option selected disabled>-- Type of Plate Number: --</option>
                                            <option value="RPN">New Random Plate Number</option>
                                            <option value="CPN">New Customised Plate Number</option>
                                        </select>
                                    </div>

                                    <div className="col-sm-6 col-md-6 pt-3">
                                        <div className="hackneyPermit">
                                            <input className="form-check-input" type="checkbox"  name="policeCMRIS" checked={policeCMRIS} onChange={handleCheckboxChange} />
                                            <label className="form-check-label" htmlFor="addTwo">Police CMRIS</label>
                                        </div>
                                    </div>

                                    <div className="col-sm-12">
                                        <div className="check-listg">
                                            <p className="check-listgk" id="mainPriceVReg" style={{ fontSize: '14px',  }}>TOTAL AMOUNT: 
                                                <span className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>
                                            </p>
                                            <div className="main-btn-wrap">
                                                <center><a onClick={handleChangeOwnership} className="btn btn-primary" style={{ backgroundColor: '#142444', borderColor: '#142444', color:'#fff' }}>Process Paper</a></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

