
(function ($) {
  'use strict';
  $(function () {
    var FLATPICKER_CONFIG = {
      SINGLE : {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
      }
    };
    var test = $('.flatpickr-single').flatpickr(FLATPICKER_CONFIG.SINGLE);
  });


})(jQuery);