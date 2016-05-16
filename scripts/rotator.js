function rotateBanners(elem) {
  var active = $(elem+" img.active");
  var next = active.next();
  if (next.length == 0){
    next = $(elem+" img:first");
  } 

  var ad = next.attr('data-id');
  //console.log('next:',ad);
  trackImpression(ad);

  active.removeClass("active").fadeOut(200);
  next.addClass("active").fadeIn(200);
}

function trackImpression(id){

    $.ajax({
      url: "/api/trackimpression/"+id+"/",
    })
    .done(function( data ) {
      if ( console && console.log ) {
        var objResult = JSON.parse(data);

        if(objResult.result == 'success'){
         // console.log( "success:", objResult.code );
        } else {
          console.log( "fail:", objResult.code );
          console.log( "details:", objResult.details );
        }
      }
    });

}

function clickaction(id,url){

  //var ad = $(this).attr('data-id');
  $.ajax({
      url: "/api/trackwebclick/"+id+"/",
    })
    .done(function( data ) {
      if ( console && console.log ) {
        var objResult = JSON.parse(data);

        if(objResult.result == 'success'){
          console.log('tracking:',objResult.code);
          console.log('going to url:',url);
          window.location.href=url;
        } else {
          console.log( "fail:", objResult.code );
          console.log( "details:", objResult.details );
        }
      }
    });
  

}

function prepareRotator(elem) {
  $(elem+" img").fadeOut(0);
  $(elem+" img:first").fadeIn(0).addClass("active");

  var ad = $(elem+" img:first").attr('data-id');
 // console.log('start:',ad);
  trackImpression(ad);
}

function startRotator(elem) {
  prepareRotator(elem);
  setInterval("rotateBanners('"+elem+"')", 5000);
}