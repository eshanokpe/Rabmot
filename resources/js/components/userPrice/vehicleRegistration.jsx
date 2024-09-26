import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';


export default function VehicleRegistration() {
    return (
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    New Vehicle Registration
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <b>
                            Select the type of Vehicle, then select all the options you require to see the accurate price.
                            For instance, if it's a commercial vehicle that carries loads and passengers , remember to select the Hackney Permit option.
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
                                        <label for="inputState" class="form-label"> Registration Type</label>
                                        
                                        <select required name="" id="vehicleForm" class="form-select">
                                            <option disabled selected="selected" value="">-- Select  Registration Type--</option>
                                            
                                            <option value=""></option>
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>

                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <input  class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne">Hackney Permit</label>
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

                                <div className="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 pt-2">
                                        <label for="inputState" class="form-label"> Number Plate </label>
                                        <select required class="form-select" id="numberplate" name="country" aria-label="Default select example">
                                            <option disabled selected="selected" >-- Type of Number Plate --</option>
                                            <option selected="selected" value="RPN">Random Plate Number</option>
                                            <option value="PCN">Personalized/Customize Number</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
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