"use strict";

(function ($) {
  "use strict";

  $(window).load(function () {
    simple_carousel_cfs();
  });

  function simple_carousel_cfs() {
    var owlRtl = false;

    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    $('.product_categories_main_wrapper .simple_carousel_init').each(function () {
      var $this = $(this);
      var per_row = $this.attr('data-items');
      $this.owlCarousel({
        rtl: owlRtl,
        dots: true,
        items: per_row,
        autoplay: true,
        loop: false,
        slideBy: 1,
        responsive: {
          0: {
            items: 2
          },
          550: {
            items: 3
          },
          768: {
            items: 4
          },
          960: {
            items: per_row
          }
        }
      });
      $this.closest('.simple_carousel_wrapper').find('.simple_carousel_prev').on('click', function (e) {
        e.preventDefault();
        $this.trigger('prev.owl.carousel');
      });
      $this.closest('.simple_carousel_wrapper').find('.simple_carousel_next').on('click', function (e) {
        e.preventDefault();
        $this.trigger('next.owl.carousel');
      });
    });
  }
})(jQuery);