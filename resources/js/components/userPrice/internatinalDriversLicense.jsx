import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';


export default function InternatinalDriversLicense() {

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
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                    Internatinal Driver's License 
                </button>
            </h2>
            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
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
                                        <select required value={stateIdIDL} className="form-select" onChange={handleStateChange}>
                                            <option disabled selected value="">-- Select State --</option>
                                            {statesIDL.map(state => (
                                                <option key={state.id} value={state.id}>{state.name}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-10 "></div>
                                </div>

                                <div className="row card-body">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label">Choose Length of Validity</label>
                                        <select required className="form-select" onChange={handleLengthChange} value={selectedLength}>
                                            <option disabled selected value="">-- Select length of Years --</option>
                                            {lengthOfYearsIDL.map(length => (
                                                <option key={length.id} value={length.years_type} >{length.years_type} Years</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div className="row">
                                    <div className="col-md-1"></div>
                                    <div class=" col-md-10 text-center ">
                                        <div class="alert alert-info mt-2">TOTAL AMOUNT:
                                            <span className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>
                                        </div>
                                        <div class="main-btn-wrap" > 
                                            <center> <a onClick={handleIntdriverlicense} class="btn btn-primary px-5 text-center" > Process Paper </a></center>
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