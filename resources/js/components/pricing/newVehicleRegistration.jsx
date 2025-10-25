import React, { useState, useEffect } from 'react';
import axios from 'axios';


export default  function NewVehicleRegistration() {
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
        console.log('stateId :', stateId);
        console.log('vehicleTypeId :', vehicleTypeId);
        console.log('vehicleRegistrationTypeId :', vehicleRegistrationTypeId);
        console.log('numberPlateType :', numberPlateType);
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
        <div className="container">
            <div className="col-lg-12 vehic" id="nvr">
                <h2 className="widget-title padding-top-0 padding-bottom-20"> <b>New Vehicle Registration</b></h2>
                <div className="border-bottom padding-bottom-20">
                    <div className="row">
                        <div className="col-sm-5 mb-3">
                            <div className="bg-white border1 shadow">
                                <div className="note5 shadow-sm">
                                    <p>
                                        PROCESSING TIME <br />
                                        New Vehicle Reg. [48-72 hours] <br /><br />
                                        INSTRUCTION: <br />
                                        Only a brand new, foreign used vehicle, or a vehicle used in Nigeria and yet to
                                        be registered, qualify for New Vehicle Registration;
                                        <br /><br />
                                        Select the type of Vehicle,
                                        then select all the options you require to see the accurate price <br /><br />
                                        NOTE: <br /> You must select the HACKNEY PERMIT option for a vehicle that carries
                                        loads and passengers (Taxi, Commercial vehicle, Company Vehicle)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="col-sm-6 mb-3">
                            <div className="bg-white border1 shadow">
                                <div className="note shadow-sm">
                                    <span style={{ fontSize: '16px' }}> Select the Option of your choice. </span>
                                </div>

                                <div className="note1">
                                    <div className="input-group input-group-merge pt-2">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
                                        <select required name="stateId" id="stateId" className="form-select" onChange={handleState} value={stateId} >
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
                                        <select required name="vehicleForm" id="vehicleForm"
                                            className="form-select" onChange={handleVehicleTypeId} value={vehicleTypeId} >
                                            <option  value="">-- Select Vehicle --</option>
                                            {vehicleTypeList.map((vehicleType) => (
                                            <option key={vehicleType.id} value={vehicleType.id}>{vehicleType.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div className="input-group input-group-merge pt-3">
                                        <span id="fullname" className="input-group-text"><i className="fa fa-car"></i></span>
                                        <select required value={vehicleRegistrationTypeId} onChange={handleVehiclRegistrationeTypeId} className="form-select">
                                            <option selected="selected">-- Select Registration Type --</option>
                                            {vehicleRegistrationTypeList.map((vehicleRegistrationType) => (
                                            <option key={vehicleRegistrationType.id} value={vehicleRegistrationType.id}>{vehicleRegistrationType.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div className="input-group input-group-merge pt-3">
                                        <span id="fullname" className="input-group-text"><i className="fa fa-car"></i></span>
                                        <select required className="form-select" value={numberPlateType} onChange={handleNumberPlateType}>
                                            <option disabled selected="selected">-- Type of Number Plate --</option>
                                            <option selected="selected" value="RPN">Random Plate Number</option>
                                            <option value="PCN">Personalized/Customize Number</option>
                                        </select>
                                    </div>
                                    <div className="col-sm-6 col-md-6 pt-2">
                                        <div className="hackneyPermit">
                                            <input onChange={handleCheckboxChange} checked={hackneyPermit} className="form-check-input" type="checkbox"  name="hackneyPermit" />
                                            <label className="form-check-label" htmlFor="addOneReg"> Hackney Permit</label>
                                        </div>
                                    </div>
                                    <div className="col-sm-6 col-md-6 pt-2">
                                        <div className="hackneyPermit">
                                            <input onChange={handleCheckboxChange} checked={policeCMRIS} className="form-check-input" type="checkbox" name="policeCMRIS" />
                                            <label className="form-check-label" htmlFor="addTwoReg"> Police CMRIS</label>
                                        </div>
                                    </div>
                                    <div className="col-sm-12">
                                        <div className="check-listg">
                                            <p className="check-listgk" id="mainPriceVReg" style={{ fontSize: '14px',  }}>TOTAL AMOUNT: 
                                                <span className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(total)}</span>
                                            </p>
                                            <div className="main-btn-wrap">
                                                <center> <a onClick={handleVehicleRegistration} className="btn btn-primary" style={{ backgroundColor: '#142444', borderColor: '#142444',color:'white' }}> Process Paper </a></center>
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


