'use strict';


function setAmount(op, amount) {
  var i;
	$('#amount').val(amount);

  $('.top_button').removeClass('active');  

  // add the data-toggle
  $('#amount_'+op).addClass('active');

	//console.log('setting amount:',amount);

}

function setFreq(freq){
  var i;
	$('#freq').val(freq);
  $('.bottom_button').removeClass('active');  
  // add the data-toggle
  $('#freq_'+freq).addClass('active');

  //console.log('setting freq:',freq);
}

function submitform(){
  if($('#amount').val() == '') {
    $('#cc_error').html('Please choose an amount');
  } else{
    $('#donate_form').submit();
  }
	

}

$(document).ready(function () {

  var freq = $('#freq').val(1);
  var amount = $('#amount').val();


});