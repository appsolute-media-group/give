'use strict';


$(document).ready(function () {
 

  $('#directory_search').keypress(function (e) {
   var key = e.which;
   if(key == 13)  // the enter key code
    {
      var term = $('#directory_search').val();
      var newStr = term.replace(/[^a-zA-Z0-9]/g, '_');
      console.log('searching for '+newStr);
      window.location.href='/directory/search/'+newStr;
      return false;  
    }
  });   


});





