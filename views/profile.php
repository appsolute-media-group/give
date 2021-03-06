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
                  <h1>Your Profile</h1>
                </div>
              </div>
            </div>
          </div>  
        </div>

        <div class="item-inner" style="min-height: 280px;">
          <div class="row" onclick="nextView();">
            <div class="col-xs-12 contact-button-container">
              <div class="contact-button-inner">
                <div class="col-xs-10 text-left">
                  <h4>Your Details</h4>
                </div>
                <div class="col-xs-2 text-right">
                  <i class="fa fa-arrow-right "></i>
                </div>
              </div>
            </div>
          </div>


          <div class="row" onclick="goToView(3);">
            <div class="col-xs-12 contact-button-container">
              <div class="contact-button-inner">
                <div class="col-xs-10 text-left">
                  <h4>Your Dontation Schedule</h4>
                </div>
                <div class="col-xs-2 text-right">
                  <i class="fa fa-arrow-right "></i>
                </div>
              </div>
            </div>
          </div>

          <div class="row" onclick="goToView(5);">
            <div class="col-xs-12 contact-button-container">
              <div class="contact-button-inner">
                <div class="col-xs-10 text-left">
                  <h4>Your Dontation History</h4>
                </div>
                <div class="col-xs-2 text-right">
                  <i class="fa fa-arrow-right "></i>
                </div>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>   <!-- data-view="1" -->

    <div class="view" data-view="2">
      <div class="view-container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
            <div class="item-inner">
              <div class="item-header">
                <div class="text-center">
                  <h1>Edit Profile</h1>
                </div>
              </div>
            </div>
          </div>  
        </div>  

        <div class="row">
          <div class="col-xs-12 input-container ">
            <div class="cc-container">
              <div style="color:red;font-weight:bold;font-family:'Gill-Sans'" class="text-center" id="profile_error" >
                <p><?php echo $this->strErrorMessage; ?></p>
              </div>
              <div style="color:green;font-weight:bold;font-family:'Gill-Sans'" class="text-center" id="profile_success" >
                <p><?php echo $this->strSuccessMessage; ?></p>
              </div>

              <form action="/profile/?doPost=true" method="post" id="profile_form" />
  
                <input type="hidden" name="doPost" value="true" />
                
                <div class="fld_select text-left">
                  <span>Location</span>
                    <select class="fld_select"  name="sublocality" id="sublocality">
                       <?php echo $this->listSublocalities; ?>          
                    </select>
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
               
                </div><br />





              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 button-container text-center">
            <div class="button-inner">
                <button type="button" name="save_details" class="btn btn-checkout" onclick="validateForm();">Save Details</button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 button-container text-center">
            <div class="button-inner">
                <button type="button" name="cancel" class="btn btn-cancel" onclick="goToView(1);">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>   <!-- data-view="2" -->
  
    <div class="view" data-view="3">
      <div class="view-container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
            <div class="item-inner">
              <div class="item-header">
                <div class="text-center">
                  <h1>Your Donation Schedule</h1>
                </div>
              </div>
            </div>
          </div>  
        </div> 
        <div class="row">
          <div class="col-xs-12 input-container ">
            <div class="input-inner" style="min-height:180px;padding-top:30px;">

<?php if($this->objDonations) { ?>
               

              <div style="color:red;font-weight:bold;font-family:'Gill-Sans'" class="text-center" id="donation_error" >
                <p><?php echo $this->strErrorMessage; ?></p>
              </div>
              <div style="color:green;font-weight:bold;font-family:'Gill-Sans'" class="text-center" id="donation_success" >
                <p><?php echo $this->strSuccessMessage; ?></p>
              </div>


              <form action="/profile/?doDonationPost=true" method="post" id="donation_form" />
  
     
                <input type="hidden" name="doDonationPost" value="true" />
                
                <text>Donation Amount</text>
                <select class="fld_select"  name="amount" id="amount">
                   <option value="10" <?php echo Util::isSelected($this->objDonations['amount'],'10.00'); ?>>10</option> 
                   <option value="25" <?php echo Util::isSelected($this->objDonations['amount'],'25.00'); ?>>25</option>
                   <option value="50" <?php echo Util::isSelected($this->objDonations['amount'],'50.00'); ?>>50</option>
                   <option value="100" <?php echo Util::isSelected($this->objDonations['amount'],'100.00'); ?>>100</option>       
                </select><br /><br />

                <text>Frequency</text>
                <select class="fld_select"  name="freq" id="freq">
                   <option value="2" <?php echo Util::isSelected($this->objDonations['freq'],'2'); ?>>Bi-Weekly</option>
                   <option value="3" <?php echo Util::isSelected($this->objDonations['freq'],'3'); ?>>Monthly</option>
                   <option value="4" <?php echo Util::isSelected($this->objDonations['freq'],'4'); ?>>Anually</option>       
                </select><br /><br />

               <!-- <p><text>Next Bill Date: 1/1/2018</text></p> -->

                <div class="text-center link-button-container">
                  <span class="link_button text-center" ><a href="javascript:confirmdelete();">Cancel this donation schedule</a></span>
                </div>

              </form>
              
<?php } else {

      echo "<div class='text-center'><p>You do not have any donations scheduled.</p><p><a href='/donate/'>Donate Now >></a></p></div>";

} 

?>
      
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 button-container text-center">
            <div class="button-inner">
                <button type="button" name="save_details" class="btn btn-checkout" onclick="submitDonateform();">Save Details</button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 button-container text-center">
            <div class="button-inner">
                <button type="button" name="cancel" class="btn btn-cancel" onclick="goToView(1);">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>   <!-- data-view="3" -->

    <div class="view" data-view="5" >
      <div class="view-container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
            <div class="item-inner">
              <div class="item-header">
                <div class="text-center">
                  <h1>Your Donation History</h1>
                </div>
              </div>
            </div>
          </div>  
        </div> 
        <div class="row">
          <div class="col-xs-12 input-container ">
            <div class="input-inner">
              <div class="row" style="min-height:180px;padding-top:30px;">


<?php if(count($this->objDonationHistory)> 0) { ?>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Result</th>
                    </tr>
                  <?php 

                  foreach($this->objDonationHistory As $item){ ?>

                    <tr>
                      <td><?php echo $item['trans_date']; ?></td>
                      <td>$<?php echo $item['trans_amount']; ?></td>
                      <td><?php echo $item['trans_details']; ?></td>
                    </tr>


                  <?php } 


                  //Util::dump($this->objDonationHistory); ?>
                  </table>
                </div>
<?php } else {

      echo "<div class='text-center'><p>You have not made any donations.</p><p><a href='/donate/'>Donate Now >></a></p></div>";

} ?>

              </div>
              <div class="row">
                <div class="col-xs-12 button-container text-center">
                  <div class="button-inner">
                      <button type="button" name="cancel" class="btn btn-cancel" onclick="goToView(1);">Go Back</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>   <!-- data-view="5" -->

    <?php 
    //$blnLockBanner = false;
    include_once(ROOT_DIR.'/includes/banners.php'); ?>

  </div>     <!-- container-fluid -->
</div>       <!-- main-wrapper -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/profile.js"></script>

</body>
