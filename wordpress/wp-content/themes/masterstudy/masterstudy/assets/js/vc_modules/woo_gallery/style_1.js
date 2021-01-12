"use strict";

(function ($) {
  $(document).ready(function () {
    var owlRtl = false;

    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    if ($('.flex-control-nav li').length > 5) {
      $('.flex-control-nav').owlCarousel({
        rtl: owlRtl,
        dots: false,
        items: 5,
        autoplay: false,
        loop: false,
        margin: 15,
        slideBy: 1,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 3
          },
          1024: {
            items: 5
          }
        }
      });
    }
  });
})(jQuery);