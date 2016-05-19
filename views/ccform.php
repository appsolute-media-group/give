
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
	        <div class="card-container">
	          <div class="row">
	            <div class="col-xs-12 info-container text-center">
	              <h3>Card Details <i class="fa fa-credit-card"></i></h3>
	            </div>
	          </div>
	          <div class="row">
	            <div class="col-xs-12 input-container text-center">
	              <div class="input-inner">

							<div style="color:red;font-weight:bold;font-family:'Gill-Sans'" id="cc_error" >
              					<p><?php echo $this->strErrorMessage; ?></p>
							</div>

							<p>You are making a <?php echo $this->getFequencyString($this->intFreq); ?> 
								contribution of $<?php echo $this->decAmount; ?></p>


							<form action="/donate/form/?doPost=true" method="post" id="cc_form" />

									<input type="hidden" name="amount" value="<?php echo $this->decAmount; ?>" />
									<input type="hidden" name="doPost" value="true" />

								<?php if($_SESSION['APIprofileID'] == '') {?>

							      	<input type="text" placeholder='First name' name="first_name" id="first_name" value="<?php echo $this->strFirstName;?>"></input>
									<input type="text" placeholder='Last name' name="last_name" id="last_name" value="<?php echo $this->strLastName;?>"></input>
									<input type="text" placeholder='Address' name="address" id="address" value="<?php echo $this->strAddress;?>"></input>
									<input type="text" placeholder='City' name="city" id="city" value="<?php echo $this->strCity;?>"></input><br /><br />
									<text>Province</text>
									<select name="province" id="province" >
									<option>BC</option>
									<option>ON</option>
									</select><br /><br />
									<text>Country</text>
									<select name="country" id="country" >
									<option value="CA">Canada</option>
									<option value="US">United States</option>
									</select><br /><br />
									<input type="text" placeholder='Postal Code' name="postal" value="<?php echo $this->strPostal;?>"></input>
									<input type="text" placeholder='Credit Card Number' name="cc_num" id="cc_num" value="<?php echo $this->strCCnum;?>"></input>
									<input type="text" placeholder='CCV' name="cc_code" id="cc_code" value="<?php echo $this->strCCcode;?>"></input><br /><br />
									<text>Exp. Month</text>
									<select name="expMonth" id="expMonth">
									<?php 
									for($mo=1; $mo<=12; $mo++) {
									  echo '<option value="' .$mo. '"';
									  echo '>' .$mo. '</option>';
									}
									?>
									</select>
									<text>Exp. Year</text>
									<select name="expYear" id="expYear">
									<?php 
									for($year=2016; $year<=2025; $year++) {
									  echo '<option value="' .$year. '"';
									  echo '>' . $year. '</option>';
									}
									?>
									</select>

							    <?php } else { ?>
							    	<p>Your payment info is already on file (<?php echo $this->intPayProfileId; ?>)</p>
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
	  	</div>




<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>

	    </div>

	  </div>

	</div>
	<script src="/scripts/vendor.js"></script>
<script src="/scripts/plugins.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/ccform.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


</body>