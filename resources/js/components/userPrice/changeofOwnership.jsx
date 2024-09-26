import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';


export default function ChangeofOwnership() {
    return (
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Change of Ownership
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <b>
                            Select the type of Vehicle, then select all the options you require, to see the acccurate price.
                        </b>
                    </div> 
                    <div class="card border-top border-0 border-4 ">
                        <div class="card-body pt-1">
                            <div class="ct_opt" id="renewwalPaper"> 
                                <div className="row mt-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label">Select State</label>
                                        <select required name="stateId" id="stateId" class="form-select">
                                            <option disabled selected="selected" value="">-- Select State--</option>
                                        
                                            <option   value=""></option>
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-10 "></div>
                                </div>

                                <div className="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label">Select Category of Vehicle</label>
                                        
                                        <select required name="" id="vehicleForm" class="form-select">
                                            <option disabled selected="selected" value="">-- Select Category of Vehicle--</option>
                                            
                                            <option value=""></option>
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                                <div className="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label">Document Expiration Date</label>
                                        <select class="form-select" id="vehiclelicensedate" name="vehiclelicensedate" aria-label="Default select example">
                                            <option selected disabled>-- Vehicle License: --</option>
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
                                    <div class="col-md-1"></div>
                                </div>

                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <label for="inputState" class="form-label"> Hackney Permit </label>
                                        <select class="form-select" name="hacneypermitdate" id="hacneypermitdate" aria-label="Default select example">
                                            <option>-- Hackney Permit: --</option>
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
                                    <div class="col-md-1 " > </div>
                                </div>

                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-10">
                                        <label for="inputState" class="form-label"> Type of Plate Number </label>
                                        <select class="form-select" id="platenumber" name="platenumber" aria-label="Default select example">
                                            <option selected disabled>-- Type of Plate Number: --</option>
                                            <option value="RPN">New Random Plate Number</option>
                                            <option value="CPN">New Customised Plate Number</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>

                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-10">
                                        <input  class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne">Police CMRIS</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>

                                <div className="row card-body">
                                    <div className="col-md-1"></div>
                                    <div class=" col-md-10 text-center ">
                                        <div class="alert alert-info mt-2">TOTAL AMOUNT: ₦ <span class="check-listgk" style={{fontSize: '16px'}}>0.00</span></div>
                                        <div class="main-btn-wrap" > 
                                            <center> <a href="" class="btn btn-primary px-5 text-center" > Process Paper </a></center>
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