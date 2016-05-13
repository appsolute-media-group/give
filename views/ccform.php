
<body class="page my-account">
	<!--[if lt IE 10]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div class="main-wrapper">

	  <div class="container-fluid">
	    
	    <div class="row header">
	      
	      <?php include_once(ROOT_DIR.'/includes/menu.php'); ?>

	    </div>

	    <div class="view-container">
	      <div class="row">
	      	<div class="col-md-6 item">
	          <div class="item-inner">
	            <div class="item-header">
	              <div class="text-center">
	                <h1>Your Payment Information</h1>
	              </div>
	            </div>
	            <div class="item-detail text-center">
              		<div class="item-detail-contents">

              			<form action="/donate/form/" method="post" id="cc_form" />

              				<br /><?php echo $this->strErrorMessage; ?><br />
							

							<br />You are donating $<?php echo $this->decAmount; ?><br />


							

								<div class="payment-info">



								<?php if($_SESSION['APIprofileID'] == '') {?>
							      <input type="text" placeholder='First name' name="first_name" value="<?php echo $this->strFirstName;?>"></input>
							      <input type="text" placeholder='Last name' name="last_name" value="<?php echo $this->strLastName;?>"></input><br /><br />
							      <input type="text" placeholder='Address' name="address" value="<?php echo $this->strAddress;?>"></input>
							      <input type="text" placeholder='City' name="city" value="<?php echo $this->strCity;?>"></input><br /><br />
							      <text>Province</text>
							      <select name="province" >
							        <option>BC</option>
							        <option>ON</option>
							      </select><br /><br />
							      <text>Country</text>
							      <select name="country" >
							        <option value="CA">Canada</option>
							        <option value="US">United States</option>
							      </select><br /><br />
							      <input type="text" placeholder='Postal Code' name="postal" value="<?php echo $this->strPostal;?>"></input><br /><br />
							      <input type="text" placeholder='Credit Card Number' name="cc_num" value="<?php echo $this->strCCnum;?>"></input>
							      <input type="text" placeholder='CCV' name="cc_code" value="<?php echo $this->strCCcode;?>"></input><br /><br />
							      <text>Exp. Month</text>
							      <select name="expMonth">
							      <?php 
							        for($mo=1; $mo<=12; $mo++) {
							          echo '<option value="' .$mo. '"';
							          echo '>' .$mo. '</option>';
							        }
							      ?>
							      </select>
							      <text>Exp. Year</text>
							      <select name="expYear">
							      <?php 
							        for($year=2016; $year<=2025; $year++) {
							          echo '<option value="' .$year. '"';
							          echo '>' . $year. '</option>';
							        }
							      ?>
							      </select>
							      <br /><br />

							    <?php } else { ?>
							    	Your payment info is already on file (<?php echo $this->intPayProfileId; ?>)
							    	<input type="hidden" name="paymentprofileid" value="<?php echo $this->intPayProfileId; ?>" />
							    	<input type="hidden" name="amount" value="<?php echo $this->decAmount; ?>" />
							    <?php } ?>

							      <div class="row">
							        <div class="col-xs-12 button-container text-center">
							          <div class="button-inner">
							              <input type="submit" name="submit" class="btn" value="Continue" />
							          </div>
							        </div>
							      </div><br /><br />
							      
							    </div>
							  

              			</form>

              		</div>
                </div>	
	          </div>
	        </div>

	      </div>

	      <div class="row">
	        <div class="ad-container">
	          <div class="col-xs-12 ad-contents text-center">
	            <?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
	          </div>
	        </div>
	      </div>

	    </div>

	  </div>

	</div>
	<script src="/scripts/vendor.js"></script>
<script src="/scripts/plugins.js"></script>
<script src="/scripts/main.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


</body>