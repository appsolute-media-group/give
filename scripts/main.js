'use strict';

function goToView(view) {
  window.scrollTo(0, 0);
  $('.view:visible').hide();
  $('.view[data-view=' + '"' + view + '"' + ']').show();
}

function debugView() {
  var on = true;
  var view = 1;

  if (on) {
    goToView(view);
  }
}

function nextView() {
  var current = parseInt($('.view:visible').attr('data-view'));
  var next = current + 1;
  goToView(next);
}

function prevView() {
  var current = parseInt($('.view:visible').attr('data-view'));
  var prev = current - 1;
  goToView(prev);
}

$(document).ready(function () {
  debugView();
  startRotator("#rotator");
});
//# sourceMappingURL=main.js.map
function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}


