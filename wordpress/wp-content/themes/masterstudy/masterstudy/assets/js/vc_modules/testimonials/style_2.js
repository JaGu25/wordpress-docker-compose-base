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

    $('.stm_testimonials_wrapper_style_2').each(function () {
      var $this = $(this);
      $this.owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        rtl: owlRtl,
        dots: false,
        items: 1,
        autoplay: true,
        autoplayHoverPause: true,
        loop: true,
        mouseDrag: false,
        slideBy: 1
      }); // $this.on('change.owl.carousel', function(event) {
      //     var index = event.item.index;
      //     var $slide = $this.find('.stm_lms_testimonials_single').eq(index).closest('.owl-item');
      //
      //     $slide.addClass('animated owl-animated-out fadeOut');
      //
      //     var $triggered_slide = $this.find('.stm_lms_testimonials_single').eq(event.isTrigger).closest('.owl-item');
      //     //$triggered_slide.addClass('');
      // });
      //
      // $this.on('changed.owl.carousel', function(event) {
      //     $slides = $(this).find('.owl-item');
      //     $slides.removeClass('animated owl-animated-out fadeOut');
      //
      //     var index = event.item.index;
      //     var $slide = $this.find('.stm_lms_testimonials_single').eq(index).closest('.owl-item');
      // });
    });
  }
})(jQuery);