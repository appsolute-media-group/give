
$(document).ready(function () {

  if (getQueryVariable('doPost')){
    goToView(2);
  }

});

function validateForm(){

  var error = false;
  $('#profile_error').html('');

  if (!error && !validateEmail($('#email').val())) {
    $('#profile_error').html('Please enter a valid email');
    error = true;
  }

  if(!error && $('#postal').val() == '') {
    $('#profile_error').html('Please enter a postal code');
    error = true;
  }

  if(!error && $('#city').val() == '') {
    $('#profile_error').html('Please enter a city');
    error = true;
  }

  if(!error && $('#address').val() == '') {
    $('#profile_error').html('Please enter a address');
    error = true;
  }

  if(!error && $('#last_name').val() == '') {
    $('#profile_error').html('Please enter a last name');
    error = true;
  }

  if(!error && $('#first_name').val() == '') {
    $('#profile_error').html('Please enter an first name');
    error = true;
  }

  if(!error){
    $('#profile_form').submit();
  }
  
}


function validateEmail(str) {
    var lastAtPos = str.lastIndexOf('@');
    var lastDotPos = str.lastIndexOf('.');
    return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
}
