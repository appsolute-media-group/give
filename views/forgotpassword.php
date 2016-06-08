<body class="page faq-terms">
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
                  <h1>Recover Your Password</h1>
                </div>
              </div>
            </div>
	        <div class="col-xs-12 ">
	          <div class="info-container">
		        <div class="row">
		          <div class="col-xs-12 info-wrapper">
		            <div class="info-inner">


					<p>Please enter your email address you signed up with and we will send you and email with your login information.</p>

					<div style="color:red;font-weight:bold;font-family:'Gill-Sans'" id="cc_error" >
      					<p><?php echo $this->objUsers->strErrorMessage; ?></p>
					</div>



					<div class="cc-container" style="margin:50px 0 50px 0">
						<form action="/forgotpassword/" method="post" >

						  <div class="fld_select text-left">
		              		  <input type="text" placeholder='Registration Email' name="email" id="email" value="<?php echo htmlspecialchars($this->objUsers->strUseremail);?>" style="float:left;margin-top:5px;margin-right:10px;width:200px;border:1px solid #cccccc;"></input>
						      <button type="button" name="cancel" class="btn btn-cancel" style="float:left;" onclick="this.form.submit();">Send Reminder</button>
						  	  <input type="hidden" name="doRecover" value="true" />	
						  </div> 
						  <div class="row" >
				            <div class="col-xs-12 button-container text-center">
				              <div class="button-inner">
				                  
				              </div>
				            </div>
				          </div>


						</form>
					</div>

					<p>Any quesions please contact us for more information:<br />	
					<a href="tel:(236) 420-5249">(236) 420-5249</a><br />
					<a href="http://clubappetite.com" target="blank">clubappetite.com</a></p>

				  </div>
		        </div>
		      </div>
	        </div>



				
	        </div>
	      </div>

		</div>  


		<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>

	  </div>     <!-- container-fluid -->
	</div>       <!-- main-wrapper -->
	
<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>

</body>
