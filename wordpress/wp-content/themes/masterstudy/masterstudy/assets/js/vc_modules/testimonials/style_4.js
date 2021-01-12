"use strict";

(function ($) {
  $(window).load(function () {
    t_carousel();
  });

  function t_carousel() {
    var owlRtl = false;

    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    $('.stm_testimonials_wrapper_style_4').each(function () {
      var slides = $(this).data('slides');
      var $this = $(this);
      var owl = $this.owlCarousel({
        rtl: owlRtl,
        nav: false,
        dots: true,
        items: slides,
        autoplay: true,
        autoplayHoverPause: true,
        loop: false,
        slideBy: 1,
        margin: 30,
        responsive: {
          0: {
            items: 1
          },
          700: {
            items: 2
          },
          992: {
            items: 3
          },
          1200: {
            items: slides
          }
        }
      });
    });
  }
})(jQuery);