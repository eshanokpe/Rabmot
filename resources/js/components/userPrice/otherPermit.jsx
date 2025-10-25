import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';


export default function OtherPermit() {

    const url = window.location.origin;
    const [otherPermits, setOtherPermits] = useState([]);
    const [selectedPermitId, setSelectedPermitId] = useState('');
    const [totalAmount, setTotalAmountOP] = useState('0.00');
 
    useEffect(() => { 
        const fetchStates = async () => {
            axios.get(`${url}/get-otherPermit`)
              .then(response => {
                setOtherPermits(response.data.permitType);
              })
              .catch(error => {
                  console.error('Error fetching vehicle data:', error);
              });
        }
        fetchStates();
    }, [ url]);

    useEffect(() => { 
        console.log('Other Permit :', otherPermits);
        const fetchLengthNDL = async () => {
            axios.post(`${url}/get-otherPermit/price`, {
                otherPermits: selectedPermitId,
              }).then(response => {
                console.log('Other Permit pricing:', response.data);
                setTotalAmountOP(response.data.amount);
              }).catch(error => {
                console.error('Error sending :', error);
              });
        }
        fetchLengthNDL();
    }, [ url, selectedPermitId]);

   

    const handlePermitChange = (event) => {
        setSelectedPermitId(event.target.value);
    };

    const handleOtherPermit = (e) => {
        window.location.href = `${url}/home/otherpermit`;
    }

    return (
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                    Other Permits/Papers
                </button>
            </h2>
            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <b>
                            Select your type of vehicle below.
                        </b>
                    </div> 
                    <div class="card border-top border-0 border-4 ">
                        <div class="card-body pt-1">
                            <div class="ct_opt" id="renewwalPaper"> 
                                <div className="row mt-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label">Select Type of Permit</label>
                                         <select
                                            className="form-select"
                                            id="otherPermitId"
                                            name="otherPermitId"
                                            aria-label="Default select example"
                                            onChange={handlePermitChange}
                                            value={selectedPermitId}
                                        >
                                            <option value="">-- Select the Others Permit --</option>
                                            {otherPermits.map((permit, index) => (
                                                <option key={index} value={permit.id}>
                                                   {permit.name}
                                                </option>
                                            ))}
                                        </select>
                                    </div>
                                    <div class="col-md-10 "></div>
                                </div>


                                <div className="row card-body">
                                    <div className="col-md-1"></div>
                                    <div class=" col-md-10 text-center ">
                                        <div class="alert alert-info mt-2">TOTAL AMOUNT: 
                                            <span className="check-listgk" style={{fontSize: '16px'}}>{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>

                                        </div>
                                        <div class="main-btn-wrap" > 
                                            <center> <a onClick={handleOtherPermit} class="btn btn-primary px-5 text-center" > Process Paper </a></center>
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