import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

export default function InternationalDriverLicense() {
    const url = window.location.origin;
    const [statesIDL, setStatesIDL] = useState([]);
    const [stateIdIDL, setStateIdIDL] = useState('');
    const [lengthOfYearsIDL, setLengthOfYearsIDL] = useState([]);
    const [selectedLength, setSelectedLength] = useState('');
    const [totalAmount, setTotalAmountIDL] = useState('0.00');
 
    useEffect(() => { 
        const fetchStates = async () => {
            axios.get(`${url}/get-state/pricing`)
              .then(response => {
                setStatesIDL(response.data.stateList);
              })
              .catch(error => {
                  console.error('Error fetching vehicle data:', error);
              });
        }
        fetchStates();
    }, [ url]);

    useEffect(() => { 
        const fetchLength = async () => {
            axios.post(`${url}/get-internationaDriverLicense/length`, {
                stateIdIDL: stateIdIDL,
              }).then(response => {
                console.log('New drive pricing:', response.data);
                setLengthOfYearsIDL(response.data.lengthYear);
              }).catch(error => {
                console.error('Error sending :', error);
              });
        }
        fetchLength();
    }, [ url, stateIdIDL]);

    useEffect(() => { 
        console.log('selectedLength:', selectedLength);
        
        const fetchLengthNDL = async () => {
            axios.post(`${url}/get-internationaDriverLicense/price`, {
                stateIdIDL: stateIdIDL,
                lengthOfYearsIDL: selectedLength,
              }).then(response => {
                console.log('Int pricing:', response.data);
                setTotalAmountIDL(response.data.amount);
              }).catch(error => {
                console.error('Error sending :', error);
              });
        }
        fetchLengthNDL();
    }, [ url, stateIdIDL, selectedLength]);


    const handleStateChange = (event) => {
        setStateIdIDL(event.target.value);
        setSelectedLength(''); // Reset lengthOfYears on state change
    };

    const handleLengthChange = (event) => {
        setSelectedLength(event.target.value);
    };

    const handleIntdriverlicense = (event) => {
        window.location.href = `${url}/home/internationaldriverlicense`;
    }

    return (
        <div className='container'>
            <div className="col-lg-12 vehic" id="ndl">
                <h2 className="widget-title padding-top-30 padding-bottom-20">
                    <b>International Driver License</b>
                </h2>
                <div className="border-bottom padding-bottom-20">
                    <div className="row">
                        <div className="col-sm-5 mb-3">
                            <div className="bg-white border1 shadow">
                                <div className="note5 shadow-sm">
                                    <p>
                                        PROCESSING TIME<br />
                                        International Driver’s License [72 Hours - 5 Working Days]<br /><br />
                                        INSTRUCTION:<br />
                                        It's Come with One year of validity.<br /><br />
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="col-sm-6 mb-3">
                            <div className="bg-white border1 shadow">
                                <div className="note shadow-sm">
                                    <span style={{ fontSize: '16px' }}>
                                        Select the Option of your choice.
                                    </span>
                                </div>

                                <div className="note1" id="vehicleFormIDL">
                                    <div className="input-group input-group-merge pt-2">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
                                        <select required value={stateIdIDL} className="form-select" onChange={handleStateChange}>
                                            <option disabled selected value="">-- Select State --</option>
                                            {statesIDL.map(state => (
                                                <option key={state.id} value={state.id}>{state.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div className="input-group input-group-merge pt-3">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
                                        <select required className="form-select" onChange={handleLengthChange} value={selectedLength}>
                                            <option disabled selected value="">-- Select length of Years --</option>
                                            {lengthOfYearsIDL.map(length => (
                                                <option key={length.id} value={length.years_type} >{length.years_type} Years</option>
                                            ))}
                                        </select>
                                    </div>

                                    <div className="col-sm-12 pt-3">
                                        <div className="check-listg">
                                                <p className="check-listgk" id="mainPriceVReg" style={{ fontSize: '14px',  }}>TOTAL AMOUNT: 
                                                    <span className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>
                                                </p>
                                            <div className="main-btn-wrap">
                                                <center>
                                                    <a onClick={handleIntdriverlicense} className="btn btn-primary" style={{ backgroundColor: '#142444', borderColor: '#142444', color:'#fff' }}>
                                                        Process Paper
                                                    </a>
                                                </center>
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
