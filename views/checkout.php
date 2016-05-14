
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
	        <div class="receipt-container">
	          <div class="receipt-wrapper">
	              <div class="row receipt-header">
	                <div class="col-xs-8 text-left">
	                  <h2>YOUR CART</h2>
	                </div>
	                <div class="col-xs-4 text-center">
	                  <i class="fa fa-shopping-cart fa-4x"></i>
	                </div>
	              </div>
	              <div class="cart-list-wrapper">
					<?php 
					$idx = 0;
					$total = 0;
					foreach($_SESSION['arrProducts'] As $p) { 

						$new_price = number_format($_SESSION['arrQtys'][$idx] * $p['product_price'],2);
						$total += $new_price;
						?>

	                <div class="row item-row">
	                  <div class="col-xs-7">
	                    <p><?php echo $p['product_name'];?></p>
	                  </div>
	                  <div class="col-xs-3 quantity-wrapper">
	                    <p>x<?php echo $_SESSION['arrQtys'][$idx];?> @<?php echo $p['product_price'];?></p>
	                  </div>
	                  <div class="col-xs-2 cost-wrapper">
	                    <p>$<?php echo $new_price;?></p>
	                  </div>
	                </div>

					<?php 
						$idx++;
					}  ?>	                

	              </div>
	              <div class="row receipt-total-container">
	                <div class="col-xs-8 text-center">
	                  <h4>
	                    YOUR TOTAL:
	                  </h4>
	                </div>
	                <div class="col-xs-4 text-center">
	                  <h4>
	                    $<?php echo $total;?>
	                  </h4>
	                </div>
	              </div>
	              <div class="row receipt-tagline-container">
	                <div class="col-xs-12 text-center receipt-tagline">
	                  <p>
	                    Your donation puts the buying power in the hands of the Food Bank who can take the funds and purchase more for their dollar. Thank you for feeding your community!
	                  </p>
	                </div>
	              </div>
	          </div>
	        </div>
	        <div class="bottom-container">
	          <div class="row checkout-button-container">
	            <div class="col-xs-12 text-center">
	              <button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="nextView()">CHECKOUT</button>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
		<div class="view" data-view="2">
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

	              	<br /><?php echo $this->strErrorMessage; ?><br />


	              	<form action="/cart/checkout/?doPost=true" method="post" id="cc_form" />
		              	<!--
		                <input type="text" name="card_name" value="" placeholder="Cardholder Name">
		                <input type="text" name="card_number" value="" placeholder="Card Number">
		                <input type="text" name="card_expirey" value="" placeholder="Expirey Date (mm/YY)">
		                <input type="text" name="card_cvv" value="" placeholder="CVV">
		                <input type="text" name="card_street" value="" placeholder="Street Address">
		                <input type="text" name="card_city" value="" placeholder="City">
		                <input type="text" name="card_province" value="" placeholder="Province">
		                <input type="text" name="card_province" value="" placeholder="Postal Code">
		                <input type="text" name="card_country" value="Canada" placeholder="Country" disabled>-->
		                	<input type="hidden" value="<?php echo $total;?>" id="grand_total" name="grand_total" />
							<input type="hidden" name="doPost" value="true" />
		                <?php if($_SESSION['APIprofileID'] == '') {?>
			                
			                <input type="text" placeholder='First name' name="first_name" value="<?php echo $this->strFirstName;?>"></input>
							<input type="text" placeholder='Last name' name="last_name" value="<?php echo $this->strLastName;?>"></input>
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
							<input type="text" placeholder='Postal Code' name="postal" value="<?php echo $this->strPostal;?>"></input>
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
							

						<?php } else { ?>

							Your payment info is already on file (<?php echo $this->intPayProfileId; ?>)
							<input type="hidden" name="paymentprofileid" value="<?php echo $this->intPayProfileId; ?>" />
							
						<?php } ?>

					</form>
	              </div>
	            </div>
	          </div>
	          <div class="row">
	            <div class="col-xs-12 button-container text-center">
	              <div class="button-inner">
	                  <button type="button" name="card_add" class="btn btn-checkout" onclick="$('#cc_form').submit();">Process Transaction</button>
	              </div>
	            </div>
	          </div>
	          <div class="row">
	            <div class="col-xs-12 button-container text-center">
	              <div class="button-inner">
	                  <button type="button" name="cancel" class="btn btn-cancel" onclick="prevView()">Cancel</button>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	  	</div>











		    <div class="row ad-footer2">
		      <div class="ad-container">
		        <div class="col-xs-12 ad-contents text-center">
		          <?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
		        </div>
		      </div>
		    </div>



		</div>  

	  </div>

	<script src="/scripts/vendor.js"></script>
	<script src="/scripts/plugins.js"></script>
	<script src="/scripts/checkout.js"></script>

</body>