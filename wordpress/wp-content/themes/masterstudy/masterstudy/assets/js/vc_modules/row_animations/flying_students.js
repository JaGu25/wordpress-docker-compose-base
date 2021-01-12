"use strict";

(function ($) {
  var click_count = 0;
  $(document).ready(function () {
    $('.row-has-animation').on('click', function () {
      click_count++;

      if (click_count > 10) {
        $('.row-has-animation').addClass('hinted-row');
      }
    });
  });
})(jQuery);