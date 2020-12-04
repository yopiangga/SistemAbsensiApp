(function($) {
  'use strict';

  // initializing inputmask
  // $(":input").inputmask();

  $('.time-work').inputmask("HH:MM:ss", {
    placeholder: "JJ:MM:DD", 
    insertMode: false, 
    showMaskOnHover: false,
    hourFormat: "24"
  });

    // $(".time-work").inputmask("h:s",{ "placeholder": "hh/mm" });

})(jQuery);