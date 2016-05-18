<body class="page login">
  <!--[if lt IE 10]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
<div class="main-wrapper">
  <div class="container-fluid">

    <div class="view initial" data-view="1">
      <div class="view-container">
        <div class="row">
          <div class="col-xs-12 logo-container text-center">
            <div class="logo-inner">
                <img src="/images/CA-Logo-lg.png" alt="" class="logo-blue"/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 welcome-container text-center">
            <div class="welcome-inner">
                <p>
                  Welcome to Club Appetite where we work to feed our local communities.
                </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-8 col-xs-offset-2 button-container text-center">
            <div class="button-inner">
                <button type="button" name="sign_up" class="btn btn-signup"  onclick="nextView()">Sign-Up</button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-8 col-xs-offset-2  button-container text-center">
            <div class="button-inner">
                <button type="button" name="sign_up" class="btn btn-signin" onclick="goToView(4)">Sign-In</button>
            </div>
          </div>
        </div>
      </div>
    </div>   <!-- data-view 1 -->

    <div class="view" data-view="2">
      <div class="view-container">
        <div class="row">
          <div class="col-xs-12 logo-container text-center">
            <div class="logo-inner">
              <img src="/images/CA-Logo-lg.png" alt="" class="logo-blue"/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 welcome-container text-center">
          </div>
        </div>
      
        <form method="post" action="?doRegister=true" id="regForm">
          <div class="row">
            <div class="col-xs-8 col-xs-offset-2 input-container text-center">
              <div style="color:red;font-weight:bold;font-family:'Gill-Sans'" id="reg_error">
<?php  echo $this->objUsers->strErrorMessage;  ?>
              </div>
              <div class="row">
                <div class="col-xs-2 input-container text-center">&nbsp;</div>
                <div class="col-xs-2 input-container ">
                  <div class="fld_desc text-right">Food Bank</div>  
                </div>
                <div class="col-xs-7 input-container text-left">
                  <div class="input-inner">
                    <select class="fld_select"  name="sublocality" id="sublocality">
                       <?php echo $this->listSublocalities; ?>          
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-2 input-container text-center">&nbsp;</div>
                <div class="col-xs-2 input-container ">
                  <div class="fld_desc text-right">User name</div>  
                </div>
                <div class="col-xs-7 input-container text-left">
                  <div class="input-inner">
                    <input type="text"     name="signup_username" id="signup_username" value="<?php echo $this->objUsers->strUsername; ?>" placeholder="Username">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-2 input-container text-center">&nbsp;</div>
                <div class="col-xs-2 input-container ">
                  <div class="fld_desc text-right">Email</div>  
                </div>
                <div class="col-xs-7 input-container text-left">
                  <div class="input-inner">
                    <input type="text"     name="signup_email"    id="signup_email"    value="<?php echo $this->objUsers->strUseremail; ?>" placeholder="Email">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-2 input-container text-center">&nbsp;</div>
                <div class="col-xs-2 input-container ">
                  <div class="fld_desc text-right">Password</div>  
                </div>
                <div class="col-xs-7 input-container text-left">
                  <div class="input-inner">
                    <input type="password" name="signup_password" id="signup_password" value="<?php echo $this->objUsers->strPassword; ?>" placeholder="Password">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-2 input-container text-center">&nbsp;</div>
                <div class="col-xs-2 input-container ">
                  <div class="fld_desc text-right">Referral Code</div>  
                </div>
                <div class="col-xs-7 input-container text-left">
                  <div class="input-inner">
                    <input type="text"     name="referalCode"     id="referalCode"     value="<?php echo $this->objUsers->referalCode; ?>" placeholder="Referral Code">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 col-xs-offset-2  button-container text-center">
              <div class="button-inner">
                <button type="button" name="sign_up" class="btn btn-signup" onclick="validateRegister();">Sign-Up</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 col-xs-offset-2  button-container text-center">
              <div class="button-inner">
                <button type="button" name="sign_up" class="btn btn-cancel" onclick="goToView(1)">Cancel</button>
              </div>
            </div>
          </div>
          <input type="hidden" name="doRegister" value="true" />
        </form>
      </div>
    </div>   <!-- data-view 2 -->

    <div class="view" data-view="4">
      <div class="view-container">
        <div class="row">
          <div class="col-xs-12 logo-container text-center">
            <div class="logo-inner">
              <img src="/images/CA-Logo-lg.png" alt="" class="logo-blue"/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 welcome-container text-center">
            <div style="color:red;font-weight:bold;font-family:'Gill-Sans'" id="login_error">
<?php echo $this->objUsers->strLoginErrorMessage; ?>
            </div>
          </div>
        </div>
        <form method="post" action="?doLogin=true" id="loginForm">
          <div class="row">
            <div class="col-xs-3 input-container text-center">
              &nbsp;
            </div>
            <div class="col-xs-1 input-container ">
              <div class="fld_desc text-right">
                Email
              </div>  
            </div>
            <div class="col-xs-7 input-container text-left">
              <div class="input-inner">
                <input type="text" name="signin_email" id="signin_email" class="input-inner" value="" placeholder="Email">
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-xs-3 input-container text-center">
              &nbsp;
            </div>
            <div class="col-xs-1 input-container ">
              <div class="fld_desc text-right">
                Password
              </div>
            </div>
            <div class="col-xs-6 input-container text-left">
              <div class="input-inner">
                <input type="password" name="signin_password" id="signin_password" value="" placeholder="Password">
              </div>
            </div>
          </div> 

          <div class="row">
            <div class="col-xs-8 col-xs-offset-2 button-container text-left"> 
              <div class="button-inner">
                <button type="button" name="sign_up" class="btn btn-signup" onclick="validateLogin();">Sign-In</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 col-xs-offset-2  button-container text-center">
              <div class="button-inner">
                <button type="button" name="sign_up" class="btn btn-cancel" onclick="goToView(1)">Cancel</button>
              </div>
            </div>
          </div>
          <input type="hidden" name="doLogin" value="true" />
        </form>
      </div>
    </div>   <!-- data-view 4 -->
  </div>     <!-- container-fluid -->

</div>
<script src="/scripts/vendor.js"></script>
<script src="/scripts/plugins.js"></script>
<script src="/scripts/login.js"></script>

</body>