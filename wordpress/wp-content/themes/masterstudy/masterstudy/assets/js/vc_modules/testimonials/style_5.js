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

    $('.stm_testimonials_wrapper_style_5').each(function () {
      var slides = $(this).data('slides');
      var $this = $(this);
      var owl = $this.owlCarousel({
        rtl: owlRtl,
        nav: false,
        dots: false,
        items: slides,
        autoplay: true,
        autoplayHoverPause: true,
        loop: true,
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
            items: 2
          },
          1200: {
            items: slides
          }
        }
      });
      $this.closest('.testimonials_main_wrapper').find('.nav-buttons .prev').on('click', function (e) {
        e.preventDefault();
        $this.trigger('prev.owl.carousel');
      });
      $this.closest('.testimonials_main_wrapper').find('.nav-buttons .next').on('click', function (e) {
        e.preventDefault();
        $this.trigger('next.owl.carousel');
      });
    });
  }
})(jQuery);