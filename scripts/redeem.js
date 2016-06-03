'use strict';


$(document).ready(function () {


  $("#home").hide();
  $("#warning").show();
  $("#warning_text").show();

});


function redeem(id) {
  
  //console.log("redeeming id:",id);

  $.ajax({
    url: "/api/confirmwebdeal/"+id+"/",
  })
  .done(function( data ) {
    if ( console && console.log ) {
      var objResult = JSON.parse(data);

      if(objResult.result == 'success'){
        //console.log( "success:", objResult.code );
        $("#redeem_placeholder").html(objResult.details);
        $("#home").show();
        $("#warning").hide();
        $("#warning_text").hide();
      } else {
        //console.log( "fail:", objResult.code );
        //console.log( "details:", objResult.details );
        $("#error_message").text(objResult.details);

      }
      


    }
  });

}



