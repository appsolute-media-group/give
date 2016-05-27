<?php

$objCC_info = new InfoPages;
$pageName   = "credit_card_disclaimer";
$CC_Info    = $objCC_info->getInfoPageData($pageName);

?>

<body class="page give">
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
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
            <div class="give-title-container">
              <div class="text-center">
                <h1>give&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-group fa-1x"></i></h1>
              </div>
            </div>
          </div>
        </div>
        <div class="row">  
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
            <div class="text-center">
              <h5>take care of your community</h5>
            </div>
          </div>
        </div>
      
        <div class="text-center button-container">
          <span class="link_button text-center" ><a href="/profile/?doDonationPost=true" >Update / Cancel Donation Schedule</a></span>
        </div>
        <div style="color:red;font-weight:bold;font-family:'Gill-Sans';" class="text-center" id="cc_error" >
          <p><?php echo $this->strErrorMessage; ?></p>
        </div>
        <div class="amount-box">
          <div class="row">
            <div class="col-xs-12 text-left">
              <h4 class="box-title">Select Your Amount</h4>
            </div>
          </div>
          <div class="row amounts-container">
            <div class="col-xs-3 text-center">
              <button type="button" id="amount_1" class="btn btn-amount top_button"  value="10" onclick="setAmount(1, 10);">$10</button>
            </div>
            <div class="col-xs-3 text-center">
              <button type="button" id="amount_2" class="btn btn-amount top_button"  value="25" onclick="setAmount(2, 25);">$25</button>
            </div>
            <div class="col-xs-3 text-center">
              <button type="button" id="amount_3" class="btn btn-amount top_button"  value="50" onclick="setAmount(3, 50);">$50</button>
            </div>
            <div class="col-xs-3 text-center">
              <button type="button" id="amount_4" class="btn btn-amount top_button"  value="100" onclick="setAmount(4, 100);">$100</button>
            </div>         
          </div>
        </div>
        <div class="schedule-box">
          <div class="row">
            <div class="col-xs-12 text-left">
              <h4 class="box-title">Select Your Schedule</h4>
            </div>
          </div>
          <div class="row schedules-container">
            <div class="row">
              <div class="col-xs-6 text-center">
                <button type="button" id="freq_1" class="btn btn-amount bottom_button"  value="one-time" onclick="setFreq(1);">One-Time</button>
              </div>
              <div class="col-xs-6 text-center">
                <button type="button" id="freq_2" class="btn btn-amount bottom_button"  value="bi-weekly" onclick="setFreq(2);">Bi-Weekly</button>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6 text-center">
                <button type="button" id="freq_3" class="btn btn-amount bottom_button"  value="monthly" onclick="setFreq(3);">Monthly</button>
              </div>
              <div class="col-xs-6 text-center">
                <button type="button" id="freq_4" class="btn btn-amount bottom_button"  value="annual" onclick="setFreq(4);">Annual</button>
              </div>
            </div>
          </div>
        </div>
        <div class="button-container">
          <div class="row">
            <div class="col-xs-12 text-center">
              <button type="button" name="give" class="btn btn-give" onclick="submitform()">give</button>
            </div>
          </div>
        </div>

        <form action="/donate/form/" id="donate_form" method="post"/>
          <input type="hidden" value="" name="amount" id="amount" />
          <input type="hidden" value="1" name="freq" id="freq" />
          <!--<input type="hidden" value="true" name="doPost" id="doPost" />-->
        </form>

        <div class="disclaimer-box">
          <div class="row">
            <div class="col-xs-12 text-left">
<?php echo $CC_Info["text"]; ?>
            </div>
          </div>  
        </div>  <!-- disclaimer-box -->
      </div>    <!-- view-container -->

<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>

    </div>     <!-- container-fluid -->
  </div>       <!-- main-wrapper -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/donate.js"></script>
</body>