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
          <div class="col-xs-12 button-container text-center">
            <div class="button-inner">
                <button type="button" name="sign_up" class="btn btn-signup"  onclick="nextView()">Sign-Up</button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 button-container text-center">
            <div class="button-inner">
                <button type="button" name="sign_up" class="btn btn-signin" onclick="goToView(4)">Sign-In</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      <div class="row">
        <div class="col-xs-12 input-container text-center">
          <div class="input-inner">
            <input type="text" name="signup_foodbank" value="" placeholder="Select a Food Bank">
            <input type="text" name="signup_username" value="" placeholder="Username">
            <input type="text" name="signup_username" value="" placeholder="Email">
            <input type="password" name="signup_password" value="" placeholder="Password">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 button-container text-center">
          <div class="button-inner">
              <button type="button" name="sign_up" class="btn btn-signup" onclick="goToView(3)">Sign-Up</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 button-container text-center">
          <div class="button-inner">
              <button type="button" name="sign_up" class="btn btn-cancel" onclick="goToView(1)">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="view" data-view="3">
      <div class="view-container">
      <div class="row">
        <div class="col-xs-12 logo-container text-center">
          <div class="logo-inner">
              <img src="/images/Club-Appetite-logo-white.png" alt="" class="logo-white"/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 redeem-container text-center">
          <div class="redeem-inner">
              <p>
                Do you have a points code to redeem?
              </p>
              <p>
                Enter below to receive your Club Appetite points.
              </p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 input-container text-center">
          <div class="input-inner">
              <input type="password" name="signup_code" value="" placeholder="****">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 button-container text-center">
          <div class="button-inner">
              <button type="button" name="sign_up" class="btn btn-redeem">Redeem</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 button-container text-center">
          <div class="button-inner">
              <button type="button" name="sign_up" class="btn btn-skip">Skip</button>
          </div>
        </div>
      </div>
    </div>
  </div>
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
      </div>
    </div>
    <div class="row">
      <form method="post" action="?doLogin=true" id="loginForm">
        <div class="col-xs-12 input-container text-center">
          <div class="input-inner">
            <input type="text" name="signin_email" value="" placeholder="Email">
            <input type="password" name="signin_password" value="" placeholder="Password">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 button-container text-center">
          <div class="button-inner">
              <button type="button" name="sign_up" class="btn btn-signup" onclick="document.getElementById('loginForm').submit();">Sign-In</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 button-container text-center">
          <div class="button-inner">
              <button type="button" name="sign_up" class="btn btn-cancel" onclick="goToView(1)">Cancel</button>
          </div>
        </div>
      </div>
      <input type="hidden" name="doLogin" value="true" />
    </form>
  </div>
</div>
</div>
</div>