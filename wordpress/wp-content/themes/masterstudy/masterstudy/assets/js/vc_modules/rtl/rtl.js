"use strict";

(function ($) {
  $(window).load(function () {
    setTimeout(function () {
      $(window).trigger('resize');
    }, 200);
  });
})(jQuery);