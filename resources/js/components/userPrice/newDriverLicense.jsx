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
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                    New Driver's License 
                </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <b>
                            Select the number of years of validity you require.
                        </b>
                    </div> 
                    <div class="card border-top border-0 border-4 ">
                        <div class="card-body pt-1">
                            <div class="ct_opt" id="renewwalPaper"> 
                                <div className="row mt-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                    <label for="inputState" class="form-label">Select State</label>
                                        <select required name="stateIdNDLVL" id="stateIdNDLVL" className="form-select" onChange={handleStateChange}>
                                            <option disabled selected value="">-- Select State --</option>
                                            {statesNDL.map(state => (
                                                <option key={state.id} value={state.id}>{state.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-10 "></div>
                                </div>

                                <div className="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label">Choose Length of Validity</label>
                                        <select required  className="form-select" onChange={handleLengthChange} value={selectedLengthNDL}>
                                            <option disabled selected value="">-- Select length of Years --</option>
                                            {lengthOfYearsNDL.map(length => (
                                                <option key={length.id} value={length.years_type} >{length.years_type} Years</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div className="row card-body">
                                    <div className="col-md-1"></div>
                                    <div class=" col-md-10 text-center ">
                                        <div class="alert alert-info mt-2"  style={{ fontSize: '14px',  }}>TOTAL AMOUNT:
                                             <span className="check-listgk" style={{fontSize: '16px'}}>{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>
                                        </div>
                                        <div class="main-btn-wrap" > 
                                            <center> <a  onClick={handleNewdriverlicense} class="btn btn-primary px-5 text-center" > Process Paper </a></center>
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