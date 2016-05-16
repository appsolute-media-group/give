'use strict';


function setAmount(amount){

	$('#amount').val(amount);

	console.log('setting amount:',amount);

}

function setFreq(freq){

	console.log('setting freq:',freq);
	$('#freq').val(freq);

}

function submitform(){

	$('#donate_form').submit();

}

$(document).ready(function () {

  var freq = $('#freq').val(0);
  var amount = $('#amount').val();


});