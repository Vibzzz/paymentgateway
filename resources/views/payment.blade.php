@extends('layouts.master')
@section('content')
  <div class="content">
			
			<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
					<script type="text/javascript">
						$(document).ready(function () {
							$('#horizontalTab').easyResponsiveTabs({
								type: 'default', //Types: default, vertical, accordion           
								width: 'auto', //auto or any width like 600px
								fit: true   // 100% fit in a container
							});
						});
						
						function detectCardType(number) {
					        
					        var types = {
					            maestro: /^(5[06789]|6)[0-9]{0,}$/,
					            visa: /^4[0-9]{0,}$/,
					            master: /^(5[1-5]|222[1-9]|22[3-9]|2[3-6]|27[01]|2720)[0-9]{0,}$/,
					            amex: /^3[47][0-9]{0,}$/,
					            dinersclub: /^3(?:0[0-59]{1}|[689])[0-9]{0,}$/
					        };

					        for(var key in types) {
					            if (types[key].test(number)) {
					            	
					            	var ele = document.getElementById("foo");
									if(ele !== null){ ele.parentNode.removeChild(ele);}
					            	var elem = document.createElement("img");	
					            	if (key=='master') {
					            			elem.setAttribute("src", "{{ URL::to('/') }}/images/mastercard.png");
					            	}
					            	else if(key=='visa'){
					            		elem.setAttribute("src", "{{ URL::to('/') }}/images/visa.png");
					            	}
					            	else if(key=='maestro'){
					            		elem.setAttribute("src", "{{ URL::to('/') }}/images/mestro.png");
					            	}
					            	else if(key=='amex'){
					            		elem.setAttribute("src", "{{ URL::to('/') }}/images/amex.jpeg");
					            	}
					            	else if(key=='dinersclub'){
					            		elem.setAttribute("src", "{{ URL::to('/') }}/images/dinersclub.png");
					            	}
					            	elem.setAttribute("id","foo");
					            	document.getElementById("cardType").appendChild(elem);
									
									elem.setAttribute("height", "30");
									elem.setAttribute("width", "50");
									// elem.setAttribute("alt", "Flower");
									
					                // document.getElementById('cardType').innerHTML = key;
					                // return key;
					            }
					        }

					    }
					</script>
						<div class="sap_tabs">
							<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
								<div class="pay-tabs">
									<h2>Select Payment Method</h2>
									  <ul class="resp-tabs-list">
										  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span><label class="pic1"></label>Credit Card</span></li>
										  <li class="resp-tab-item" aria-controls="tab_item-3" role="tab"><span><label class="pic2"></label>Debit Card</span></li>
										  <div class="clear"></div>
									  </ul>	
								</div>
								<div class="resp-tabs-container">
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="payment-info">
											<h3>Personal Information</h3>
											<form method = "POST" action="/payment" >
												<div class="tab-for">				
													<h5>EMAIL ADDRESS</h5>
														<input type="email" class="text_box" name="email" value="" required="true">
													<h5>FIRST NAME</h5>	
														<input type="text" name="firstname" value="" required="true"/>
													<h5>LAST NAME</h5>	
														<input type="text" name="lastname" value="" />
													<h5>PH No</h5>
														<input type="text" name="phone" maxlength="10" value="" required="true" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
													<h5>PRODUCT INFO </h5>
														<input type="text" name="productinfo" value=""  />
													<h5>AMOUNT </h5>
														<input type="text" name="amount" value="" required="true" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
												</div>			
											
											<h3 class="pay-title">Credit Card Info</h3>
											
												<div class="tab-for">				
													<h5>NAME ON CARD</h5>
														<input type="text" name="ccname" value="" required="true">
													<h5>CARD NUMBER</h5>													
														<input class="pay-logo" name="ccnum" maxlength="16" type="text" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  onblur="detectCardType(this.value)" required="true" > 
														<label id = 'cardType' for="brand"><span></span></label>
												</div>	
												<div class="transaction">
													<div class="tab-form-left user-form">
														<h5>EXPIRATION</h5>
															<ul>
																<li>
																	<input type="number" name= "ccexpmon" class="text_box" type="text" value="6" min="1" max ="12"required="true"/>	
																</li>
																<li>
																	<input type="number" name= "ccexpyr" class="text_box" type="text" value="2020" min="1" required="true" width="100" />	
																</li>
																
															</ul>
													</div>
													<div class="tab-form-right user-form-rt">
														<h5>CVV NUMBER</h5>													
														<input type="text" name="ccvv" value="" maxlength="4"required="true">
													</div>
													<div class="clear"></div>
												</div>
												<input type="hidden" name="pg" value="CC">
												<input type="hidden" name="bankcode" value="CC">
												<input type="submit" value="SUBMIT">
											</form>
											
										</div>
									</div>
									
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-3">	
										<div class="payment-info">
											<h3>Personal Information</h3>
											<form method = "POST" action="/payment" >
												<div class="tab-for">				
													<h5>EMAIL ADDRESS</h5>
														<input type="email" class="text_box" name="email" value="" required="true">
													<h5>FIRST NAME</h5>	
														<input type="text" name="firstname" value="" required="true"/>
													<h5>LAST NAME</h5>	
														<input type="text" name="lastname" value="" />
													<h5>PH No</h5>
														<input type="text" name="phone" maxlength="10" value="" required="true" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
													<h5>PRODUCT INFO </h5>
														<input type="text" name="productinfo" value=""  />
													<h5>AMOUNT </h5>
														<input type="text" name="amount" value="" required="true" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
												</div>			
											
											<h3 class="pay-title">Debit Card Info</h3>
											
												<div class="tab-for">				
													<h5>NAME ON CARD</h5>
														<input type="text" name="ccname" value="" required="true">
													<h5>CARD NUMBER</h5>													
														<input class="pay-logo" name="ccnum" maxlength="16" type="text" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  onblur="detectCardType(this.value)" required="true" > 
														<label id = 'cardType' for="brand"><span></span></label>
												</div>	
												<div class="transaction">
													<div class="tab-form-left user-form">
														<h5>EXPIRATION</h5>
															<ul>
																<li>
																	<input type="number" name= "ccexpmon" class="text_box" type="text" value="6" min="1" max ="12"required="true"/>	
																</li>
																<li>
																	<input type="number" name= "ccexpyr" class="text_box" type="text" value="2020" min="1" required="true" width="100" />	
																</li>
																
															</ul>
													</div>
													<div class="tab-form-right user-form-rt">
														<h5>CVV NUMBER</h5>													
														<input type="text" name="ccvv" value="" maxlength="4"required="true">
													</div>
													<div class="clear"></div>
												</div>
												<input type="hidden" name="pg" value="DC">
												<input type="hidden" name="bankcode" value="DC">
												<input type="submit" value="SUBMIT">
											</form>
											
										</div>
									</div>	
									</div>
								</div>	
							</div>
						</div>	

		</div>
@stop