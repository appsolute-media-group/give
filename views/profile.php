

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

          <div class="col-md-6 item">
            <div class="item-inner">
              <div class="item-header">
                <div class="text-center">
                  <h1>Your Profile</h1>
                </div>
              </div>
            </div>
          </div>  
        </div>

        <div class="row" >
          <div class="col-md-6 item text-center">
            <div class="row">
              <div class="col-xs-12">
                <h3>Your Account</h3>
                <h2 class="points"><?=$_SESSION['user_points'];?></h2>
                <p>points</p>
                <h5 class="name"><?=$_SESSION['name'];?></h5>
              </div>
            </div>
          </div>
        </div>  

        <div class="row" onclick="nextView();">
          <div class="col-xs-12 contact-button-container">
            <div class="contact-button-inner">
              <div class="col-xs-10 text-left">
                <h4>Contact</h4>
              </div>
              <div class="col-xs-2 text-right">
                <i class="fa fa-arrow-right "></i>
              </div>
            </div>
          </div>
        </div>



        <div class="row" >






        </div>
        
      </div>

    </div>



    <div class="view" data-view="2">
      <div class="view-container">
        <div class="row">
          <div class="col-md-6 item">
            <div class="item-inner">
              <div class="item-header">
                <div class="text-center">
                  <h1>Edit Profile</h1>
                </div>
              </div>
            </div>
          </div>  
        </div>  

        <div class="row" onclick="goToView(1);">
          <div class="col-xs-12 contact-button-container">
            <div class="contact-button-inner">
              <div class="col-xs-10 text-left">
                <h4>Go Back</h4>
              </div>
              <div class="col-xs-2 text-right">
                <i class="fa fa-arrow-right "></i>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 input-container text-center">
            <div class="input-inner">
              <div style="color:red;font-weight:bold;font-family:'Gill-Sans'" id="profile_error" >
                <p><?php echo $this->strErrorMessage; ?></p>
              </div>
              <div style="color:green;font-weight:bold;font-family:'Gill-Sans'" id="profile_success" >
                <p><?php echo $this->strSuccessMessage; ?></p>
              </div>


              <form action="/profile/?doPost=true" method="post" id="profile_form" />
  
                <input type="hidden" value="<?php echo $total;?>" id="grand_total" name="grand_total" />
                <input type="hidden" name="doPost" value="true" />

                <input type="text" placeholder='Email' name="email" id="email" value="<?php echo $this->strEmail;?>" readonly="true"></input>       
                <input type="text" placeholder='First name' name="first_name" id="first_name" value="<?php echo $this->strFirstName;?>"></input>
                <input type="text" placeholder='Last name' name="last_name" id="last_name" value="<?php echo $this->strLastName;?>"></input>
                <input type="text" placeholder='Address' name="address" id="address" value="<?php echo $this->strAddress;?>"></input>
                <input type="text" placeholder='City' name="city" id="city" value="<?php echo $this->strCity;?>"></input>
                <input type="text" placeholder='Postal Code' name="postal" value="<?php echo $this->strPostal;?>"></input><br /><br />
                <text>Province</text>
                <select name="province" id="province" >
                <option <?php echo Util::isSelected($this->strProvince,"BC"); ?>>BC</option>
                <option <?php echo Util::isSelected($this->strProvince,"ON"); ?>>ON</option>
                </select><br /><br />
                <text>Country</text>
                <select name="country" id="country" >
                <option value="CA" <?php echo Util::isSelected($this->strCountry,"CA"); ?>>Canada</option>
                <option value="US" <?php echo Util::isSelected($this->strCountry,"US"); ?>>United States</option>
                </select><br /><br />
                <?php echo $this->objUser->listSublocalities; ?>

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
                <button type="button" name="cancel" class="btn btn-cancel" onclick="prevView()">Cancel</button>
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
<script src="/scripts/profile.js"></script>

</body>
