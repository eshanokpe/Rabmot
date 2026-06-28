import React, { useState, useEffect } from 'react';
import axios from 'axios';

export default function VehicleRenewalPricing() {
  const url = window.location.origin; 
  const [stateIdVR, setStateIdVR] = useState(0);
  const [stateList, setStateList] = useState([]);
  const [vehicleTypeList, setVehicleTypeList] = useState([]);
  const [vehicleTypeIdVR, setVehicleTypeIdVR] = useState(0);
  const [vehicleLicense, setVehicleLicense] = useState(false);
  const [vehicleLicenseCost, setVehicleLicenseCost] = useState(0);
  const [roadWorthiness, setRoadWorthiness] = useState(false);
  const [roadWorthinessCost, setRoadWorthinessCost] = useState(0);
  const [thirdPartyInsurance, setThirdPartyInsurance] = useState(false);
  const [thirdPartyInsuranceCost, setThirdPartyInsuranceCost] = useState(0);
  const [hackneyPermit, setHackneyPermit] = useState(false);
  const [hackneyPermitCost, setHackneyPermitCost] = useState(0);
  const [proofOwnership, setProofOwnership] = useState(false);
  const [proofOwnershipCost, setProofOwnershipCost] = useState(0);
  const [vehicleInspectionPickanddrop, setVehicleInspectionPickandDrop] = useState(false);
  const [vehicleInspectionPickanddropCost, setVehicleInspectionPickandDropCost] = useState(0);
  const [policeCMRIS, setPoliceCMRIS] = useState(false);
  const [policeCMRISCost, setPoliceCMRISCost] = useState(0);

  
  const [total, setTotal] = useState(0.00);

  useEffect(() => { 

      axios.get(`${url}/get-state/pricing`)
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
        axios.post('/get-vehicle/renewal', {
          stateId: stateIdVR,
          vehicleTypeId: vehicleTypeIdVR,
        }).then(response => {
          console.log('Success pricing:', response.data);
          setVehicleLicenseCost(response.data.vehicleLicense);
          setRoadWorthinessCost(response.data.roadWorthiness);
          setProofOwnershipCost(response.data.proofOwnership);
          setThirdPartyInsuranceCost(response.data.thirdPartyInsurance);
          setHackneyPermitCost(response.data.hackneyPermit);
          setVehicleInspectionPickandDropCost(response.data.vehicleInspectionPickandDrop);
          setPoliceCMRISCost(response.data.policeCmris)
         
        }).catch(error => {
          console.error('Error sending vehicleCategoryId:', error);
      });
   
    }
    fetchPricing();
  }, [stateIdVR, vehicleTypeIdVR]);

  useEffect(() => {
    const calculateTotal = () => {
      let totalAmount = 0;
      
      const vehicleLicenseTotal = vehicleLicense ? Number(vehicleLicenseCost) : 0; 
      const roadWorthinessTotal = roadWorthiness ? Number(roadWorthinessCost) : 0; 
      const proofOwnershipTotal = proofOwnership ? Number(proofOwnershipCost) : 0; 
      const thirdPartyInsuranceTotal = thirdPartyInsurance ? Number(thirdPartyInsuranceCost) : 0; 
      const hackneyPermitTotal = hackneyPermit ? Number(hackneyPermitCost) : 0; 
      const policeCMRISTotal = policeCMRIS ? Number(policeCMRISCost) : 0; 
      const vehicleInspectionPickanddropTotal = vehicleInspectionPickanddrop ? Number(vehicleInspectionPickanddropCost) : 0;
  
      totalAmount = Number(vehicleLicenseTotal) + roadWorthinessTotal + proofOwnershipTotal 
        + thirdPartyInsuranceTotal + hackneyPermitTotal + policeCMRISTotal + vehicleInspectionPickanddropTotal;
  
      setTotal(totalAmount);
    };
  
    calculateTotal();
  }, [vehicleLicense, vehicleLicenseCost, roadWorthiness, roadWorthinessCost, 
    proofOwnership, proofOwnershipCost, thirdPartyInsurance, thirdPartyInsuranceCost,
    hackneyPermit, hackneyPermitCost, policeCMRIS, policeCMRISCost, vehicleInspectionPickanddrop, 
    vehicleInspectionPickanddropCost
  ]);
  

  const handleCheckboxChange = (event) => {
    const { name, checked } = event.target;

    switch (name) {
        case "roadWorthiness":
            setRoadWorthiness(checked);
            break;
        case "vehicleLicense":
            setVehicleLicense(checked);
            break;
        case "proofOfOwnership":
            setProofOwnership(checked);
            break;
        case "thirdPartyInsurance":
            setThirdPartyInsurance(checked);
            break;
        
        case "hackneyPermit":
            setHackneyPermit(checked);
            break;
        case "policeCMRIS":
            setPoliceCMRIS(checked);
            break;
        case "vehicleInspectionPickanddrop":
            setVehicleInspectionPickandDrop(checked);
        default:
            break;
    }
};
  
  const handleState = (event) => {
    const state = event.target.value;
    setStateIdVR(state);
    setVehicleTypeIdVR('');
}
  const handleVehicleTypeIdVR = (event) => {
      const vehicleCategoryId = event.target.value;
      setVehicleTypeIdVR(vehicleCategoryId);
  }   

  const handleVehicleRenewal = (event) => {
    const vehicleCategoryId = event.target.value;
    window.location.href = `${url}/home/vehicle/paper/renewal`;
  }

  

  return (
    <section className="how-we-are padding-top-50 padding-bottom-50" style={{ paddingTop: '80px' }}>
      <div className="container">
        <div className="col-lg-12">
          <div className="border-bottom padding-bottom-5">
            <div className="row">
              <div className="col-sm-6">
                <h4 className="widget-title"><b>Check Pricing</b></h4>
              </div>
            </div>
          </div>
        </div>

        <div className="col-lg-12" id="">
          <h2 className="widget-title padding-top-30 padding-bottom-20"><b>Vehicle Papers Renewal</b></h2>
          <div className="border-bottom padding-bottom-20">
            <div className="row">
              <div className="col-sm-5 mb-3">
                <div className="bg-white border1 shadow">
                  <div className="note5 shadow-sm">
                    <p>PROCESSING TIME <br /> Paper Renewals [72 hours]</p>
                    <p>INSTRUCTION: <br /> Select Vehicle type from drop-down, Choose which documents you wish to see its price by checking the boxes.</p>
                    <p>NOTE: <br /> You must select the HACKNEY PERMIT option for a vehicle that carries loads and passengers (Taxi, Commercial vehicle, Company Vehicle).</p>
                    <p>ELIGIBILITY: <br /> Only a vehicle used and registered in Nigeria are eligible for a renewal.</p>
                  </div>
                </div>
              </div>

              <div className="col-sm-6 mb-3">
                <div className="bg-white border1 shadow">
                  <div className="note shadow-sm">
                    <span style={{ fontSize: '16px' }}>Select the Option of your choice.</span>
                  </div>

                  <div className="note1" id="renewwalPaper">
                    <div className="input-group input-group-merge pt-2">
                      <span className="input-group-text"><i className="fa fa-car"></i></span>
                      <select required name="stateIdVR"
                        id="stateIdVR" className="form-select" onChange={handleState} value={stateIdVR}
                      >
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
                        className="form-select" onChange={handleVehicleTypeIdVR} value={vehicleTypeIdVR} >
                        <option  value="">-- Select Vehicle --</option>
                        {vehicleTypeList.map((vehicleType) => (
                          <option key={vehicleType.id} value={vehicleType.id}>{vehicleType.name}</option>
                        ))}
                      </select>
                    </div>

                    <div class="col-sm-12">
                        <div class="check-listg">
                            <input onChange={handleCheckboxChange} checked={vehicleLicense} name="vehicleLicense" class="form-check-input" type="checkbox"  id="vehicleLicense" />
                            <label class="form-check-label" for="addOne"> Vehicle License</label>                 
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="check-listg">
                            <input onChange={handleCheckboxChange} checked={roadWorthiness} class="form-check-input " type="checkbox"  name="roadWorthiness" />
                            <label class="form-check-label" for="addTwo"> Road Worthiness</label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="check-listg">
                            <input onChange={handleCheckboxChange} checked={thirdPartyInsurance} class="form-check-input" type="checkbox" name="thirdPartyInsurance" />
                            <label class="form-check-label" for="addThree"> Third-Party Insurance</label>
                        </div>
                    </div> 
                
                    <div class="col-sm-12">
                        <div class="check-listg">
                            <input onChange={handleCheckboxChange} checked={hackneyPermit} class="form-check-input" type="checkbox" name="hackneyPermit" />
                            <label class="form-check-label" for="addFour"> Hackney Permit</label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="check-listg">
                            <input onChange={handleCheckboxChange} checked={vehicleInspectionPickanddrop} class="form-check-input" type="checkbox" name="vehicleInspectionPickanddrop" />
                            <label class="form-check-label" for="addFive"> Book Vehicle Inspection Pick & Drop</label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="check-listg">
                            <input onChange={handleCheckboxChange} checked={proofOwnership} class="form-check-input " type="checkbox"  name="proofOfOwnership" />
                            <label class="form-check-label" for="addTwo"> Proof of Ownership</label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="check-listg">
                            <input onChange={handleCheckboxChange} checked={policeCMRIS} class="form-check-input " type="checkbox" name="policeCMRIS" />
                            <label class="form-check-label" for="addSeven"> Police CMRIS</label>
                        </div>
                    </div>

                    <div className="col-sm-12">
                      <div className="check-listg">
                        <p className="check-listgk" id="mainPrice">TOTAL AMOUNT: 
                          <span className="check-listgk" >{new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN', minimumFractionDigits: 2 }).format(total)}</span>
                        </p>
                        <div className="main-btn-wrap">
                          <center><a onClick={handleVehicleRenewal} className="btn btn-primary" style={{ backgroundColor: '#142444', borderColor: '#142444', color: '#fff' }}>Process Paper</a></center>
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
    </section>
  );
}
 