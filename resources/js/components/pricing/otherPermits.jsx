import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

export default function OtherPermits() {
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
        <div className='container'>
            <div className="col-lg-12 vehic" id="ndl">
                <h2 className="widget-title padding-top-30 padding-bottom-20">
                    <b>Other Permits</b>
                </h2>
                <div className="border-bottom padding-bottom-20">
                    <div className="row">
                        <div className="col-sm-5 mb-3">
                            <div className="bg-white border1 shadow">
                                <div className="note5 shadow-sm">
                                    <p>
                                        PROCESSING TIME<br />
                                        Other Permits [72 Hours]<br /><br />
                                        INSTRUCTION:<br />
                                        Select the Permits type for the Price.<br /><br />
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

                                <div className="note1">
                                    <div className="input-group input-group-merge pt-3">
                                        <span className="input-group-text"><i className="fa fa-car"></i></span>
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

                                    <div className="col-sm-12 pt-3">
                                        <div className="check-listg">
                                                <p className="check-listgk" id="mainPriceVReg" style={{ fontSize: '14px',  }}>TOTAL AMOUNT: 
                                                    <span className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(totalAmount)}</span>
                                                </p>
                                            <div className="main-btn-wrap">
                                                <center>
                                                    <a onClick={handleOtherPermit} className="btn btn-primary" style={{ backgroundColor: '#142444', borderColor: '#142444', color:'#fff' }}>
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

