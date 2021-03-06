function rotateBanners(elem) {
  var active = $(elem+" a.active");
  var next = active.next('a');

  var time = Math.floor(Date.now() / 1000);
  //console.log('start time1:',time);

  if (next.length == 0){
    next = $(elem+" a:first");
  } 

  var ad = next.attr('data-id');

  active.removeClass("active").hide();
  next.addClass("active").show();

  console.log('ad:',ad);

  if(ad != ''){
    trackImpression(ad);
  }

  //console.log('time3:',time);
  
}

function trackImpression(id){

  if(id != undefined){
    $.ajax({
      url: "/api/trackimpression/"+id+"/",
    })
    .done(function( data ) {
      if ( console && console.log ) {
        var objResult = JSON.parse(data);

        if(objResult.result == 'success'){
          //console.log( "success:", objResult.code );
        } else {
          console.log( "fail:", objResult.code );
          console.log( "details:", objResult.details );
          console.log( "id:", id );
        }
      }
    });
  }
}

$(document).ready(function () {

  $('.banner_image').click(function(event){
    
   // event.preventDefault();
    //event.stopPropagation();

    //var url = $(this).attr('data-url');
    var id = $(this).attr('data-id');

    $.ajax({
        url: "/api/trackwebclick/"+id+"/",
      })
      .done(function( data ) {
        if ( console && console.log ) {
          var objResult = JSON.parse(data);

          if(objResult.result == 'success'){
            console.log('tracking:',objResult.code);
            //console.log('going to url:',url);
       
            //var win = window.open(url, '_blank', '');
            //win.focus();

          } else {
            console.log( "fail:", objResult.code );
            console.log( "details:", objResult.details );
          }
        }
      });
    

  });

});


function prepareRotator(elem) {
  $(elem+" a").fadeOut(0);
  $(elem+" a:first").fadeIn(0).addClass("active");

  var ad = $(elem+" a:first").attr('data-id');

  if(ad != ''){
    trackImpression(ad);
  }
  
}

function startRotator(elem) {
  
  if($(elem).length > 0){
    prepareRotator(elem);
    setInterval("rotateBanners('"+elem+"')", 15000);
  }
  
}