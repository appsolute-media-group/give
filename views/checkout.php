<?php 

$country_lst = array();
$prov_lst    = array();
$objProvList = new ProvList;

$country_lst = $objProvList->getCountry_dd_List();
$prov_lst    = $objProvList->getProv_dd_List('CA');


// create the list for populating a drop down for countries and provinces
// create an instance of the util object
$this->objUtils = new Util;
$country_lst_dd = $this->objUtils->get_dropdown_items($country_lst);
$prov_lst_dd    = $this->objUtils->get_dropdown_items($prov_lst);

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
                    <h1>your cart&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart fa-1x"></i></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

	        <div class="receipt-container">
	          <div class="receipt-wrapper">
	            <div class="cart-list-wrapper">
	            <br>
<?php 
					$idx = 0;
					$total = 0;
					foreach($_SESSION['arrProducts'] As $p) { 

						$new_price = number_format($_SESSION['arrQtys'][$idx] * $p['product_price'],2);
						$total += $new_price;
?>

	              <div class="row item-row">
	                <div class="col-xs-6">
	                  <p><?php echo $p['product_name'];?></p>
	                </div>
	                <div class="col-xs-4 quantity-wrapper">
	                  <p>x&nbsp;<?php echo $_SESSION['arrQtys'][$idx];?>&nbsp;@&nbsp;<?php echo $p['product_price'];?></p>
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
	                  $<?php echo number_format($total,2);?>
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
	              <button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="window.location.href='/cart/';">GO BACK</button>
	              <button type="button" name="needed-now-checkout" class="btn btn-checkout" onclick="nextView()">CHECKOUT</button>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>     <!-- data-view="1" -->
		  
		  <div class="view" data-view="2">
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
	              <div class="input-inner">
	                <div style="color:red;font-weight:bold;font-family:'Gill-Sans'" id="cc_error" >
      					    <p><?php echo $this->strErrorMessage; ?></p>
					        </div>
                  <p>You are making a purchase in the amount of $<?php echo number_format($total,2); ?></p>

	                <form action="/cart/checkout/?doPost=true" method="post" id="cc_form" />
		                <input type="hidden" value="<?php echo $total;?>" id="grand_total" name="grand_total" />
							      <input type="hidden" name="doPost" value="true" />
<?php if($_SESSION['APIprofileID'] == '') { ?>
			              <input type="text" placeholder='First name' name="first_name" id="first_name" value="<?php echo htmlspecialchars($this->strFirstName);?>"></input>
							      <input type="text" placeholder='Last name' name="last_name" id="last_name" value="<?php echo htmlspecialchars($this->strLastName);?>"></input>
							      <input type="text" placeholder='Address' name="address" id="address" value="<?php echo htmlspecialchars($this->strAddress);?>"></input>
							      <input type="text" placeholder='City' name="city" id="city" value="<?php echo htmlspecialchars($this->strCity);?>"></input><br />
							      <div class=" text-left">
									    <span>Province&nbsp;&nbsp;
									      <select name="province" id="province" >
									        <?php echo $prov_lst_dd; ?>
									      </select></span><br />
									  </div>
									  <div class=" text-left">
									    <span class="text-left">Country&nbsp;&nbsp;
									     <select name="country" id="country" >
									      <?php echo $country_lst_dd; ?>
									     </select></span><br />
									  </div>   
							      <input type="text" placeholder='Postal Code' name="postal" value="<?php echo htmlspecialchars($this->strPostal);?>"></input>
							      <input type="text" placeholder='Credit Card Number' name="cc_num" id="cc_num" value="<?php echo htmlspecialchars($this->strCCnum);?>"></input>
							      <input type="text" placeholder='CCV' name="cc_code" id="cc_code" value="<?php echo htmlspecialchars($this->strCCcode);?>"></input><br /><br />
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
							$str_yr = date('Y');
              $end_yr = $str_yr + 10;
              for($year = $str_yr; $year <= $end_yr; $year++) {
							  echo '<option value="' .$year. '"';
							  echo '>' . $year. '</option>';
							}
?>
							      </select><br /><br />

<?php } else { ?>

							      Your payment info is already on file (<?php echo $this->intPayProfileId; ?>)<br /><br />
							      <div class="text-center link-button-container">
							        <span class="link_button text-center" ><a href="javascript:confirmcarddelete();" >delete this card</a></span>
                    </div>
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
	                  <button type="button" name="cancel" class="btn btn-cancel" onclick="prevView()">Cancel</button>
	              </div>
	            </div>
	          </div>
	        </div>  <!-- card-container -->
	      </div>
	  	</div>      <!-- data-view="2" -->

		<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>


    </div>     <!-- container-fluid -->
  </div>       <!-- main-wrapper -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/checkout.js"></script>
<script src="/scripts/ccform.js"></script>
</body>