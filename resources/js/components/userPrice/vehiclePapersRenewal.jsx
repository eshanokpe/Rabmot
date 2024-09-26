import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';


export default function VehiclePapersRenewal() {
    return (
       
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Vehicle Papers Renewal
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <b>
                        Hey there! Choose the vehicle type and Select the options 
                        you need to view the price. For instance, 
                        if it's a commercial vehicle that carries loads and passengers 
                        , remember to select 
                        the Hackney Permit option.
                        </b>
                    </div> 
                    <div class="card border-top border-0 border-4 ">
                        <div class="card-body pt-1">
                            <div class="ct_opt" id="renewwalPaper"> 
                                <div className="row">
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

                                <div class=" row mt-3 " >
                                    <div class="col-md-1" > </div>
                                    <div class="col-md-5">
                                        <input  class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne">Vehicle License</label>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="inputAddress2" class="form-label"> Expiry Date</label>
                                        <table class="padding-no margin-no additionSubtractionTable  ">
                                            <tr>
                                                <td class= "padding-no margin-righ-no col-md-1" >			
                                                    <div className="additionSubtraction minusFigure" >-</div>
                                                </td>
                                                <td className="padding-no margin-right-no col-md-5">
                                                    <div className="padding-xs">
                                                        <input name="addvehicleLicense" type="number" className="form-control additionSubtractionForm additionSubtractionButtonTwo" id="addSubInput" min="1" readOnly />
                                                    </div>
                                                </td>
                                                <td class= "padding-no margin-right-no col-md-1">
                                                    <div class= "additionSubtraction plusFigure"  >+</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>

                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <input  class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne">Road Worthiness</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <input  class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne"> Proof Ownership</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                                
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-10">
                                        <input  class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne">Third-Party Insurance</label>
                                    </div>
                                    <div class="col-md-1 " > </div>
                                </div>
                               
                                <div class=" row mt-2 " >
                                    <div class="col-sm col-md-1 " > </div>
                                    <div class="col-sm col-md-5">
                                        <input  class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne">Hackney Permit</label>
                                    </div>

                                    <div class="col-sm col-md-5">
                                        <label for="inputAddress2" class="form-label"> Expiry Date</label>
                                        <table class="padding-no margin-no additionSubtractionTable  ">
                                            <tr>
                                                <td class= "padding-no margin-righ-no col-md-1" >			
                                                    <div className="additionSubtraction minusFigure" >-</div>
                                                </td>
                                                <td className="padding-no margin-right-no col-md-5">
                                                    <div className="padding-xs">
                                                        <input name="addvehicleLicense" type="number" className="form-control additionSubtractionForm additionSubtractionButtonTwo" id="addSubInput" min="1" readOnly />
                                                    </div>
                                                </td>
                                                <td class= "padding-no margin-right-no col-md-1">
                                                    <div class= "additionSubtraction plusFigure"  >+</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class= "col-sm col-md-1 " > </div>
                                </div>
                               
                                <div class=" row mt-2 " >
                                    <div class="col-md-1 " > </div>
                                    <div class="col-md-10">
                                        <input  class="form-check-input me-2" type="checkbox"  id="vehicleLicense" />
                                        <label class="form-check-label" for="addOne">Book Vehicle Inspection Pick & Drop</label>
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