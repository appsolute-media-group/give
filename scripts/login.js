'use strict';

function goToView(view) {
  $('.view:visible').hide();
  $('.view[data-view=' + '"' + view + '"' + ']').show();
}

function debugView() {
  var on = false;
  var view = 4;

  if (on) {
    goToView(view);
  }
}

function nextView() {
  var current = parseInt($('.view:visible').attr('data-view'));
  var next = current + 1;
  goToView(next);
}

function prevView() {
  var current = parseInt($('.view:visible').attr('data-view'));
  var prev = current - 1;
  goToView(prev);
}

$(document).ready(function () {
  debugView();
  if (getQueryVariable('doLogin')){
    goToView(4);
  }
  if (getQueryVariable('doRegister')){
    goToView(2);
  }

});


function validateLogin(){

  var email    = $('#signin_email').val();
  var password = $('#signin_password').val();
  var password2 = $('#signin_password2').val();
  var error    = false;

  if (email == '') {
    $('#login_error').html('Please enter an email');
    error = true;
  }

  if (!error && password == '') {
    $('#login_error').html('Please enter a password');
    error = true;
  } 

  

  if (!error){
    document.getElementById('loginForm').submit();
  }
  
}

function validateRegister(){

  var sublocality = $('#sublocality').val();
  var email       = $('#signup_email').val();
  var password    = $('#signup_password').val();
  var password2 = $('#signup_password2').val();
  var terms = $('#terms');

  var error       = false;

  if (sublocality == '0' || sublocality == '') {
    $('#reg_error').html('Please select a food bank');
    error = true;
  }
  
  if (!error && !validateEmail(email)) {
    $('#reg_error').html('Please enter a valid email');
    error = true;
  }


  if (!error && password == '') {
    $('#reg_error').html('Please enter a password');
    error = true;
  } else {

    if (!error && password != password2) {
      $('#reg_error').html('Your passwords do not match, please enter them again.<br /');
      error = true;
    }
  
  }

  if (!error && !terms.is(':checked')) {
    $('#reg_error').html('You must agree to the terms and conditions to use this service.');
    error = true;
  } 




  if (!error){
    document.getElementById('regForm').submit();
  }
  
}

function validateEmail(str) {
    var lastAtPos = str.lastIndexOf('@');
    var lastDotPos = str.lastIndexOf('.');
    return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
}

function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
