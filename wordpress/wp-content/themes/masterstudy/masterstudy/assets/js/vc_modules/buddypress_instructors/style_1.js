"use strict";

(function ($) {
  $(document).ready(function () {
    $('.stm_lms_instructors_carousel').each(function () {
      var $this = $(this);
      $this.owlCarousel({
        dots: true,
        autoplay: false,
        loop: false,
        slideBy: 4,
        smartSpeed: 400,
        items: 6,
        margin: 30,
        responsive: {
          0: {
            items: 1
          },
          767: {
            items: 2
          },
          992: {
            items: 3
          },
          1175: {
            items: 4
          },
          1424: {
            items: 5
          },
          1700: {
            items: 6
          }
        }
      });
    });
  });
})(jQuery);