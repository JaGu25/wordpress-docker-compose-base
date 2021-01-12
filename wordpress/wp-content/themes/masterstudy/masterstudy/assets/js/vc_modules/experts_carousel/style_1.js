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

    $('.expert-carousel-init').each(function () {
      var $this = $(this);
      var per_row = $this.attr('data-items');
      $this.owlCarousel({
        rtl: owlRtl,
        dots: true,
        items: per_row,
        autoplay: true,
        loop: true,
        slideBy: 1,
        responsive: {
          0: {
            items: 1
          },
          768: {
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