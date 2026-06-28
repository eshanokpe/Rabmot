import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

export default function DriverLicenseRenewal() {
    const url = window.location.origin;
    const [statesDLR, setStatesDLR] = useState([]);
    const [stateIdDLR, setStateIdDLR] = useState('');
    const [lengthOfYearsDLR, setLengthOfYearsDLR] = useState([]);
    const [selectedLengthDLR, setSelectedLengthDLR] = useState('');
    const [totalAmount, setTotalAmountDLR] = useState('0.00');

    useEffect(() => { 
        const fetchStates = async () => {
            axios.get(`${url}/get-state/pricing`)
              .then(response => {
                setStatesDLR(response.data.stateList);
              })
              .catch(error => {
                  console.error('Error fetching vehicle data:', error);
              });
        }
        fetchStates();
      }, [ url]);

    useEffect(() => { 
        const fetchLength = async () => {
            axios.post(`${url}/get-driverLicenseRenewal/length`, {
                statesDLR: statesDLR,
              }).then(response => {
                console.log('New drive pricing:', response.data);
                setLengthOfYearsDLR(response.data.lengthYear);
              }).catch(error => {
                console.error('Error sending :', error);
              });
        }
        fetchLength();
    }, [ url, statesDLR]);

    useEffect(() => { 
        const fetchLengthNDL = async () => {
            axios.post(`${url}/get-driverLicenseRenewal/price`, {
                stateIdDLR: stateIdDLR,
                selectedLengthDLR: selectedLengthDLR,
              }).then(response => {
                console.log('New drive pricing:', response.data);
                setTotalAmountDLR(response.data.amount);
              }).catch(error => {
                console.error('Error sending :', error);
              });
        }
        fetchLengthNDL();
    }, [ url, stateIdDLR, selectedLengthDLR]);

    const handleStateChange = (event) => {
        setStateIdDLR(event.target.value);
        setSelectedLengthDLR(''); // Reset lengthOfYears on state change
    };

    const handleLengthChange = (event) => {
        setSelectedLengthDLR(event.target.value);
    };

    const handleDriverlicenseRenewal = (event) => {
        window.location.href = `${url}/home/drivers/license/renewal`;
    }

    return (
        <div className='container'>
        <div className="col-lg-12 vehic" id="dlr">
            <h2 className="widget-title padding-top-30 padding-bottom-20">
                <b>Driver License Renewal</b>
            </h2>
            <div className="border-bottom padding-bottom-20">
                <div className="row">
                    <div className="col-sm-5 mb-3">
                        <div className="bg-white border1 shadow">
                            <div className="note5 shadow-sm">
                                <p>
                                    PROCESSING TIME<br />
                                    New Driver’s License [72 Hours - 3 weeks]<br /><br />
                                    INSTRUCTION:<br />
                                    Select the number of years of validity you require.<br /><br />
                                    PROCESS:<br />
                                    <span>
                                        You'll obtain the temporary paperwork within 72 hours. Your physical presence is required only if there are any errors, for which we'll schedule a recapture session.<br /><br />
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

                            <div className="note1" id="vehicleFormDLR">
                                <div className="input-group input-group-merge pt-2">
                                    <span className="input-group-text"><i className="fa fa-car"></i></span>
                                    <select required  className="form-select" onChange={handleStateChange}  value={stateIdDLR}>
                                        <option disabled selected value="">-- Select State --</option>
                                        {statesDLR.map(state => (
                                            <option key={state.id} value={state.id}>{state.name}</option>
                                        ))}
                                    </select>
                                </div>
                                <div className="input-group input-group-merge pt-3">
                                    <span className="input-group-text"><i className="fa fa-car"></i></span>
                                    <select required  className="form-select" onChange={handleLengthChange} value={selectedLengthDLR}>
                                        <option disabled selected value="">-- Select length of Years --</option>
                                        {lengthOfYearsDLR.map(length => (
                                            <option key={length.id} value={length.years_type} >{length.years_type} Years Validity</option>
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
                                                <a onClick={handleDriverlicenseRenewal} className="btn btn-primary" style={{ backgroundColor: '#142444', borderColor: '#142444', color:'#fff' }}>
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
