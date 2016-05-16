'use strict';

$(document).ready(function () {
  var user_qty = $('.user_qty');
  var grand_total = $('#grand_total');
  
  user_qty.val(0);
  grand_total.val(0);

});

function validateCheckout(){

	var grand_total = $('#grand_total').val();
	console.log("grand_total",grand_total);


	//if(parseFloat(grand_total) > 0){
		//$('#cart_form').submit();
	//}

}

function Checkout(){

	var grand_total = $('#grand_total').val();
	console.log("grand_total",grand_total);


	if(parseFloat(grand_total) > 0){
		$('#cart_form').submit();
	}

}

function increaseProductAmount(pID, product_amount){

	var user_qty = $('#user_qty_'+pID);
	var grand_total = $('#grand_total');
	var user_qty_display = $('#user_qty_display_'+pID);

	var startVal = parseFloat(user_qty.val());
	startVal ++;

	user_qty.val(startVal);

	var new_amount = (startVal*parseFloat(product_amount)).toFixed(2);
	console.log("new_amount",new_amount);

	user_qty_display.text(new_amount);

	var startTotal = parseFloat(grand_total.val());
	console.log("startTotal",startTotal);

	var new_total = (startTotal+parseFloat(product_amount)).toFixed(2);
	console.log("new_total",new_total);

	grand_total.val(new_total);
	$('#grand_total_display').text(new_total);

}

function decreaseProductAmount(pID, product_amount){

	var user_qty = $('#user_qty_'+pID);
	var grand_total = $('#grand_total');
	var user_qty_display = $('#user_qty_display_'+pID);

	var startVal = parseFloat(user_qty.val());
	startVal --;
	if(startVal < 0){ 
		//dont run any calculation
		startVal = 0; 
	} else {

		user_qty.val(startVal);

		var new_amount = (startVal*parseFloat(product_amount)).toFixed(2);
		console.log("new_amount",new_amount);

		user_qty_display.text(new_amount);

		var startTotal = parseFloat(grand_total.val());
		console.log("startTotal",startTotal);

		var new_total = (startTotal-parseFloat(product_amount)).toFixed(2);
		if(new_total < 0){ new_total = "0.00"; }

		console.log("new_total",new_total);

		grand_total.val(new_total);
		$('#grand_total_display').text(new_total);

	}

}

