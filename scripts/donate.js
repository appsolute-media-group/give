'use strict';


function setAmount(op, amount) {
  var i;
	$('#amount').val(amount);
  
  for (i = 1; i < 5; i++) { 
    $('#amount_'+i).removeClass('active');  
  }

  // add the data-toggle
  $('#amount_'+op).addClass('active');

	console.log('setting amount:',amount);

}

function setFreq(freq){
  var i;
	$('#freq').val(freq);

  for (i = 1; i < 5; i++) { 
    $('#freq_'+i).removeClass('active');  
  }

  // add the data-toggle
  $('#freq_'+freq).addClass('active');

  console.log('setting freq:',freq);
}

function submitform(){

	$('#donate_form').submit();

}

$(document).ready(function () {

  var freq = $('#freq').val(0);
  var amount = $('#amount').val(0);


});