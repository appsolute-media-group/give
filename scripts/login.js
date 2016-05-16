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


function validateRedeemCode(){

  var code = $('#signup_code').val();
  var hidden = $('#referalCode');

  var url = "/api/validatecode/"+code+"/";

  $.ajax({
    url: url,
  })
  .done(function( data ) {
    if ( console && console.log ) {
      var objResult = JSON.parse(data);

      if(objResult.result == 'success'){
        console.log( "success:", objResult.code );
        $('#code_action').html("Refferal Code Used: "+code);
        hidden.val(code);

      } else {
        console.log( "fail:", objResult.code );
        console.log( "details:", objResult.details );
        if(code != ''){
           $('#code_action').html(objResult.details);
        }
       
      }
    }
  });


  $('#referralCodeModal').modal('toggle');
 

}



function validateLogin(){

  var user = $('#signin_email').val();
  var password = $('#signin_password').val();
  var error = false;

  if(user == '') {
    $('#login_error').html('Please enter an email');
    error = true;
  }

  if(password == '') {
    $('#login_error').html('Please enter a password');
    error = true;
  }

  if(!error){
    document.getElementById('loginForm').submit();
  }
  
}



function validateRegister(){

  var sublocality = $('#sublocality').val();
  var user = $('#signup_username').val();
  var email = $('#signup_email').val();
  var password = $('#signup_password').val();
  var error = false;

  if(user == '') {
    $('#reg_error').html('Please enter an username');
    error = true;
  }

  if(password == '') {
    $('#reg_error').html('Please enter a password');
    error = true;
  }

  if(!validateEmail(email)) {
    $('#reg_error').html('Please enter a valid email');
    error = true;
  }


  if(sublocality == '') {
    $('#reg_error').html('Please enter a location');
    error = true;
  }

  if(!error){
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
