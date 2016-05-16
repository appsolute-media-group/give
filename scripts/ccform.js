function validateForm(){

  var error = false;
  $('#cc_error').html('');

  if($('#cc_code').val() == '') {
    $('#cc_error').html('Please enter a credit card verification code');
    error = true;
  }

  if($('#cc_num').val() == '') {
    $('#cc_error').html('Please enter a credit card number');
    error = true;
  }

  if($('#postal').val() == '') {
    $('#cc_error').html('Please enter a postal code');
    error = true;
  }

  if($('#city').val() == '') {
    $('#cc_error').html('Please enter a city');
    error = true;
  }

  if($('#address').val() == '') {
    $('#cc_error').html('Please enter a address');
    error = true;
  }

  if($('#last_name').val() == '') {
    $('#cc_error').html('Please enter a last name');
    error = true;
  }

  if($('#first_name').val() == '') {
    $('#cc_error').html('Please enter an first name');
    error = true;
  }

  if(!error){
    $('#cc_form').submit();
  }
  
}
