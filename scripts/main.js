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
  var user_qty = $('.user_qty');
  var grand_total = $('#grand_total');
  
  user_qty.val(0);
  grand_total.val(0);

});
//# sourceMappingURL=main.js.map



