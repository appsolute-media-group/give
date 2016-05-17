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
        <div class="col-xs-12 give-header-container text-center">
          <i class="fa fa-group fa-3x"></i>
          <h2>Give</h2>
          <h5>take care of your community</h5>
        </div>
      </div>
      <div class="amount-box">
        <div class="row">
          <div class="col-xs-12 text-left">
            <h4 class="box-title">Select Your Amount</h4>
          </div>
        </div>
        <div class="row amounts-container">
          <div class="col-xs-3 text-center">
            <button type="button" id="amount_1" class="btn btn-amount"  value="10" onclick="setAmount(1, 10);">$10</button>
          </div>
          <div class="col-xs-3 text-center">
            <button type="button" id="amount_2" class="btn btn-amount"  value="25" onclick="setAmount(2, 25);">$25</button>
          </div>
          <div class="col-xs-3 text-center">
            <button type="button" id="amount_3" class="btn btn-amount"  value="50" onclick="setAmount(3, 50);">$50</button>
          </div>
          <div class="col-xs-3 text-center">
            <button type="button" id="amount_4" class="btn btn-amount"  value="100" onclick="setAmount(4, 100);">$100</button>
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
                <button type="button" id="freq_1" class="btn btn-amount"  value="one-time" onclick="setFreq(1);">One-Time</button>
              </div>
              <div class="col-xs-6 text-center">
                <button type="button" id="freq_2" class="btn btn-amount"  value="bi-weekly" onclick="setFreq(2);">Bi-Weekly</button>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6 text-center">
                <button type="button" id="freq_3" class="btn btn-amount"  value="monthly" onclick="setFreq(3);">Monthly</button>
              </div>
              <div class="col-xs-6 text-center">
                <button type="button" id="freq_4" class="btn btn-amount"  value="annual" onclick="setFreq(4);">Annual</button>
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

        <input type="hidden" value="0" name="amount" id="amount" />
        <input type="hidden" value="0" name="freq" id="freq" />

      </form>

      <div class="disclaimer-box">
        <div class="row">
          <div class="col-xs-12 text-left">
            <h4 class="box-title">Cancel at Anytime</h4>
          </div>
        </div>
        <div class="row disclaimer-container">
          <div class="row">
            <div class="col-xs-12 text-justify">
              <p>
                By using and/or visiting this Service (collectively including all content, functionality and tools available through the ClubAppetite.com domain and Club Appetite’s mobile apps), you signify your agreement to (1) these terms and conditions (the ‘Terms of Service’), (2)Club Appetite’s privacy policy, found at http://www.ClubAppetite.com/privacy and incorporated here by reference and also incorporated here by reference. If you do not agree to any of these terms, the Club Appetite’s privacy policy, or the Community Guidelines, please do not use the Club Appetite Service. Changes in these Terms are almost certain to happen. We’ll announce changes over our website, and we may notify you of changes by sending an email to the address you have provided to us. You are free to decide whether to accept the changes in the terms or to stop using our Service. If you continue to use our Service after the effectiveness of that update, you agree to be bound by such modiﬁcations or revisions. Such revisions shall become effective ten (10) days after the notiﬁcation has been sent.
              </p>
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
<script src="/scripts/donate.js"></script>
</body>