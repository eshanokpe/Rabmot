import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

export default function NewDriverLicense() {
    const url = window.location.origin;
    const [statesNDL, setStatesNDL] = useState([]);
    const [stateIdNDL, setStateIdNDLNDL] = useState('');
    const [lengthOfYearsNDL, setLengthOfYearsNDL] = useState([]);
    const [selectedLengthNDL, setSelectedLengthNDLNDL] = useState('');
    const [totalAmount, setTotalAmountNDL] = useState('0.00');
 
    useEffect(() => { 
        const fetchStates = async () => {
            axios.get(`${url}/get-state/pricing`)
              .then(response => {
                setStatesNDL(response.data.stateList);
              })
              .catch(error => {
                  console.error('Error fetching vehicle data:', error);
              });
        }
        fetchStates();
      }, [ url]);

    useEffect(() => { 
        const fetchLength = async () => {
            axios.post(`${url}/get-newdriverLicenses/length`, {
                stateIdNDL: stateIdNDL,
              }).then(response => {
                console.log('New drive pricing:', response.data);
                setLengthOfYearsNDL(response.data.lengthYear);
              }).catch(error => {
                console.error('Error sending :', error);
              });
        }
        fetchLength();
    }, [ url, stateIdNDL]);

    useEffect(() => { 
        const fetchLengthNDL = async () => {
            axios.post(`${url}/get-newdriverLicenses/price`, {
                stateIdNDL: stateIdNDL,
                selectedLengthNDL: selectedLengthNDL,
              }).then(response => {
                console.log('New drive pricing:', response.data);
                setTotalAmountNDL(response.data.amount);
              }).catch(error => {
                console.error('Error sending :', error);
              });
        }
        fetchLengthNDL();
    }, [ url, stateIdNDL, selectedLengthNDL]);

    const handleStateChange = (event) => {
        setStateIdNDLNDL(event.target.value);
        setSelectedLengthNDLNDL(''); 
    };

    const handleLengthChange = (event) => {
        setSelectedLengthNDLNDL(event.target.value);
    };

    const handleNewdriverlicense = (event) => {
        window.location.href = `${url}/home/newdriverlicense`;
    }

    return (
        <div className='container'>
        <div className="col-lg-12 vehic" id="ndl">
            <h2 className="widget-title padding-top-30 padding-bottom-20">
                <b>New Driver License</b>
            </h2>
            <div className="border-bottom padding-bottom-20">
                <div className="row">
                    <div className="col-sm-5 mb-3">
                        <div className="bg-white border1 shadow">
                            <div className="note5 shadow-sm">
                                <p>
                                    PROCESSING AND CAPTURING TIMELINE<br />
                                    26 Working Days<br /><br />
                                    INSTRUCTION:<br />
                                    Select the number of years of validity you require.<br /><br />
                                    ELIGIBLE LOCATION:<br />
                                    <b>Note:</b> We only process new driver’s licenses in Lagos, Abuja, Oyo, Ogun, Abia, Rivers, and Anambra States<br /><br />
                                    PROCESS:<br />
                                    <span>
                                        It takes 6 weeks, and you will only show up once for capturing and CBT
                                        In the 4th week and you will receive your temporary card immediately. <br />
                                        Then, two weeks later, an SMS will be sent to you stating your permanent card is
                                        ready… then we will pick it up and deliver it to your doorstep.<br /><br />
                                    </span>
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

                            <div className="note1" id="vehicleForm">
                                <div className="input-group input-group-merge pt-2">
                                    <span className="input-group-text"><i className="fa fa-car"></i></span>
                                    <select required name="stateIdNDLVL" id="stateIdNDLVL" className="form-select" onChange={handleStateChange}>
                                        <option disabled selected value="">-- Select State --</option>
                                        {statesNDL.map(state => (
                                            <option key={state.id} value={state.id}>{state.name}</option>
                                        ))}
                                    </select>
                                </div>
                                <div className="input-group input-group-merge pt-3">
                                    <span id="fullname" className="input-group-text"><i className="fa fa-car"></i></span>
                                    <select required  className="form-select" onChange={handleLengthChange} value={selectedLengthNDL}>
                                        <option disabled selected value="">-- Select length of Years --</option>
                                        {lengthOfYearsNDL.map(length => (
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
                                                <a onClick={handleNewdriverlicense} className="btn btn-primary" style={{ backgroundColor: '#142444', borderColor: '#142444', color:'#fff' }}>
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
