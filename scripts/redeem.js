'use strict';

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
      } else {
        //console.log( "fail:", objResult.code );
        //console.log( "details:", objResult.details );
        $("#error_message").text(objResult.details);
      }
      


    }
  });

}



