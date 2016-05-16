'use strict';


$(document).ready(function () {
 

  $('#shop_search').keypress(function (e) {
   var key = e.which;
   if(key == 13)  // the enter key code
    {
      var term = $('#shop_search').val();
      var newStr = term.replace(/[^a-zA-Z0-9]/g, '_');
      console.log('searching for '+newStr);
      window.location.href='/shop/search/'+newStr;
      return false;  
    }
  });   


});





