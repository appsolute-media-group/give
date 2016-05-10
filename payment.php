<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
    <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
    <div class="header"><img class="header-logo" src="images/logo-white.png"/></div>
    <div class="payment-info">
      <input style="width: 30%;" type="text" placeholder='First name'></input>
      <input style="width: 30%;" type="text" placeholder='Last name'></input><br>
      <input style="width: 40%;" type="text" placeholder='Address'></input>
      <input style="width: 20%" type="text" placeholder='City'></input><br>
      <text style="margin-right: 2%; color: #1B898A;">Province</text>
      <select name="province" style="width:5%">
        <option>BC</option>
        <option>ON</option>
      </select>
      <input style="width: 21%; margin-left: 5%; margin-right: 5%;" type="text" placeholder='Postal Code'></input>
      <text style="margin-right: 2%; color: #1B898A;">Country</text>
      <select name="country" style="width:10%">
        <option>Canada</option>
        <option>United States</option>
      </select><br>
      <input style="width: 50%" type="text" placeholder='Credit Card Number'></input>
      <input style="width: 10%" type="text" placeholder='CCV'></input><br>
      <text style="margin-right: 2.5%; margin-top: 2%; color: #1B898A;">Exp. Month</text>
      <select name="expDate">
      <?php 
        for($mo=1; $mo<=12; $mo++) {
          echo '<option value="' .$mo. '"';
          echo '>' .$mo. '</option>';
        }
      ?>
      </select>
      <text style="margin-right: 2.5%; margin-top: 2%; margin-left: 10%; color: #1B898A;">Exp. Year</text>
      <select name="expYear">
      <?php 
        for($year=2016; $year<=2025; $year++) {
          echo '<option value="' .$year. '"';
          echo '>' .$year. '</option>';
        }
      ?>
      </select>
      <br>
      <input type="checkbox" style="margin: 1.5%;"><text style="color: #1B898A;">&nbsp;&nbsp;&nbsp;I agree to the <a hretf="#">terms and conditins</a></text></input>
      <div class="button">
        <buttonText><center>Continue</center></buttonText>
      </div>
    </div>
  </body>
  </html>