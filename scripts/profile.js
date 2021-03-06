
$(document).ready(function () {

  if (getQueryVariable('doPost')){
    goToView(2);
  }
  if (getQueryVariable('doDonationPost')){
    goToView(3);
  }
});



function confirmdelete(){


  if(confirm('Are you sure you want to delete this?')) {


    $.ajax({
      url: "/api/deletedonation/",
    })
    .done(function( data ) {
      if ( console && console.log ) {
        var objResult = JSON.parse(data);

        if(objResult.result == 'success'){
          console.log( "success:", objResult.code );
          console.log( "details:", objResult.details );

          window.location.href='/profile/?doDonationPost=true';
        } else {
          console.log( "fail:", objResult.code );
          console.log( "details:", objResult.details );
        }
      }
    });
   
  }

}


function submitDonateform(){
 // if($('#amount').val() == '') {
    //$('#donation_error').html('Please choose an amount');
 // } else{
    $('#donation_form').submit();
 // }

}




function validateForm(){

  var error = false;
  $('#profile_error').html('');
  $('#profile_success').html('');



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
