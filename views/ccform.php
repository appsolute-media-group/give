<?php 

$country_lst = array();
$prov_lst    = array();
$objProvList = new ProvList;

$country_lst = $objProvList->getCountry_dd_List();
$prov_lst    = $objProvList->getProv_dd_List('CA');


// create the list for populating a drop down for countries and provinces
// create an instance of the util object
$this->objUtils = new Util;
$country_lst_dd = $this->objUtils->get_dropdown_items($country_lst,$this->strCountry);
$prov_lst_dd    = $this->objUtils->get_dropdown_items($prov_lst,$this->strProvince);

?>
<body class="page needed-now">
	<!--[if lt IE 10]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div class="main-wrapper">
	  <div class="container-fluid">
	    <div class="row header">
	      
	      <?php include_once(ROOT_DIR.'/includes/menu.php'); ?>

	    </div>

	    <div class="view initial" data-view="1">
	      <div class="view-container">
	        <div class="row">  
	          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
              <div class="item-inner">
                <div class="item-header">
                  <div class="text-center">
                    <h1>card details&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-credit-card"></i></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
	        <div class="card-container">
	          <div class="row">
	            <div class="col-xs-12 input-container text-center">
	              <div class="cc-container">

							    <div style="color:red;font-weight:bold;font-family:'Gill-Sans'" id="cc_error" >
              					<p><?php echo $this->strErrorMessage; ?></p>
							    </div>

							    <p>You are making a <?php echo $this->getFequencyString($this->intFreq); ?> 
								   contribution of $<?php echo $this->decAmount; ?></p>


							    <form action="/donate/form/?doPost=true" method="post" id="cc_form" />

									  <input type="hidden" name="amount" value="<?php echo $this->decAmount; ?>" />
									  <input type="hidden" name="doPost" value="true" />

								<?php if($_SESSION['APIprofileID'] == '') {?>


								  <div class="fld_select text-left">
				              		  <span class="text-left">First Name&nbsp;&nbsp;</span>
				              		  <input type="text" placeholder='First name' name="first_name" id="first_name" value="<?php echo htmlspecialchars($this->strFirstName);?>"></input>
								      
								  </div> 
								  <div class="fld_select text-left">
				              		  <span class="text-left">Last Name&nbsp;&nbsp;</span>
								      <input type="text" placeholder='Last name' name="last_name" id="last_name" value="<?php echo htmlspecialchars($this->strLastName);?>"></input>
								      
								  </div> 

								  <div class="fld_select text-left">
				              		  <span class="text-left">Address&nbsp;&nbsp;</span>
								      <input type="text" placeholder='Address' name="address" id="address" value="<?php echo htmlspecialchars($this->strAddress);?>"></input>
								  	  
								  </div> 

								  <div class="fld_select text-left">
				              		  <span class="text-left">City&nbsp;&nbsp; </span>  
								      <input type="text" placeholder='City' name="city" id="city" value="<?php echo htmlspecialchars($this->strCity);?>"></input>
								   	 
								  </div> 

								  <div class="fld_select text-left">
				              		  <span class="text-left">Postal Code&nbsp;&nbsp;</span>    
								      <input type="text" placeholder='Postal Code' name="postal" value="<?php echo htmlspecialchars($this->strPostal);?>"></input>
								 
								  </div>

								  

							      <div class="fld_select text-left">
									<span>Province&nbsp;&nbsp;</span> 
								      <select name="province" id="province" >
								        <?php echo $prov_lst_dd; ?>
								      </select>
								  </div>
								  <div class="fld_select text-left">
								    <span class="text-left">Country&nbsp;&nbsp;</span>  
								     <select name="country" id="country" >
								      <?php echo $country_lst_dd; ?>
								     </select>
								  </div> 

								  <div class="fld_select text-left">
				              		  <span class="text-left">Credit Card&nbsp;&nbsp;</span>  
								      <input type="text" placeholder='Credit Card Number' name="cc_num" id="cc_num" value="<?php echo htmlspecialchars($this->strCCnum);?>"></input>
								   	 
								  </div> 
								  <div class="fld_select text-left">
				              		  <span class="text-left">CVV&nbsp;&nbsp;  </span>   
								      <input type="text" placeholder='CCV' name="cc_code" id="cc_code" value="<?php echo htmlspecialchars($this->strCCcode);?>"></input>
							     	
							      </div>

							      <div class="fld_select text-left">
									    <span class="text-left">Exp. Month&nbsp;&nbsp;</span>  
										  <select name="expMonth" id="expMonth">
	<?php							      for($mo=1; $mo<=12; $mo++) {
										        echo '<option value="' .$mo. '"';
										        echo '>' .$mo. '</option>';
										      } ?>
									      </select>
									</div>


									<div class="fld_select text-left">
									    <span class="text-left">Exp. Year&nbsp;&nbsp;</span>  
									  <select name="expYear" id="expYear">
	<?php 			            
				                        $str_yr = date('Y');
				                        $end_yr = $str_yr + 10;
				                        for($year = $str_yr; $year <= $end_yr; $year++) {
									        echo '<option value="' .$year. '"';
									        echo '>' . $year. '</option>';
									      }  ?>
								 	  </select>
								    </div>
								  </div><br />




<?php } else { ?>
							    	<p>Your payment info is already on file (<?php echo $this->intPayProfileId; ?>)<br />
							    	<div class="text-center link-button-container">
                      <span class="link_button text-center" ><a href="javascript:confirmcarddelete();" >delete this card</a></span>
                    </div>
							        </p><br />
							    	<input type="hidden" name="paymentprofileid" value="<?php echo $this->intPayProfileId; ?>" />
							    	
<?php } ?>

							    </form>
					      </div>
	            </div>
	          </div>
	          <div class="row">
	            <div class="col-xs-12 button-container text-center">
	              <div class="button-inner">
	                  <button type="button" name="card_add" class="btn btn-checkout" onclick="validateForm();">Process Transaction</button>
	              </div>
	            </div>
	          </div>
	          <div class="row">
	            <div class="col-xs-12 button-container text-center">
	              <div class="button-inner">
	                  <button type="button" name="cancel" class="btn btn-cancel" onclick="window.location.href='/donate/';">Cancel</button>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	  	</div>   <!-- view -->
			
		<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>

	  </div>     <!-- container-fluid -->
	</div>       <!-- main-wrapper -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/ccform.js"></script>

</body>