"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    $('.stm_lms_courses_carousel__term').on('click', function (e) {
      e.preventDefault();
      var $wrapper = $(this).closest('.stm_lms_courses_carousel');
      var $courses = $wrapper.find('.stm_lms_courses__grid');
      if ($courses.hasClass('loading')) return false;
      $(this).closest('.stm_lms_courses_carousel__terms').find('.stm_lms_courses_carousel__term').removeClass('active');
      $(this).addClass('active');
      var term = $(this).attr('data-term');

      if (typeof term !== 'undefined') {
        var args = $wrapper.attr('data-args').replace('}', ', "term":' + term + '}');
      } else {
        var args = $wrapper.attr('data-args');
      }

      $.ajax({
        url: stm_lms_ajaxurl,
        dataType: 'json',
        context: this,
        data: {
          action: 'stm_lms_load_content',
          args: args,
          offset: 0,
          template: $wrapper.attr('data-template')
        },
        beforeSend: function beforeSend() {
          $courses.addClass('loading');
        },
        complete: function complete(data) {
          var data = data['responseJSON'];
          /*Remove OWL Carousel*/

          $courses.trigger('destroy.owl.carousel').removeClass('owl-carousel stm_owl-theme owl-loaded');
          $courses.find('.owl-stage-outer').children().unwrap();
          /*Insert new items*/

          $courses.html(data.content.replace(/stm_lms_courses__single stm_lms_courses__single_animation/g, 'stm_lms_courses__single stm_lms_courses__single_animation stm_carousel_glitch'));
          /*RE INIT CAROUSEL*/

          courses_carousel();
          setTimeout(function () {
            $courses.removeClass('loading');
          }, 300);
        }
      });
    });
    courses_carousel();
  });

  function courses_carousel() {
    var owlRtl = false;

    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    $(document).on({
      mouseenter: function mouseenter() {
        $(this).closest('.stm_lms_courses_carousel').addClass('active');
      },
      mouseleave: function mouseleave() {
        $(this).closest('.stm_lms_courses_carousel').removeClass('active');
      }
    }, '.stm_lms_courses__single');
    $('.stm_lms_courses_carousel').each(function () {
      var $this = $(this).find('.stm_lms_courses__grid');
      var per_row = $(this).attr('data-items');
      var dots = $(this).attr('data-pagination') === 'enable';
      $(this).on('initialized.owl.carousel', function (event) {
        var totalItems = event.item.count;
        var visibleItems = event.page.size;
        var $buttons = $(this).closest('.stm_lms_courses_carousel').find('.stm_lms_courses_carousel__buttons');

        if (totalItems > visibleItems) {
          $buttons.removeClass('hidden');
        } else {
          $buttons.addClass('hidden');
        }
      });
      $this.imagesLoaded(function () {
        $this.owlCarousel({
          rtl: owlRtl,
          dots: dots,
          items: per_row,
          autoplay: false,
          loop: false,
          slideBy: 1,
          smartSpeed: 400,
          responsive: {
            0: {
              items: 1
            },
            500: {
              items: 2
            },
            1024: {
              items: 4
            },
            1500: {
              items: per_row
            }
          }
        });
      });
      $this.closest('.stm_lms_courses_carousel_wrapper').find('.stm_lms_courses_carousel__button_prev').on('click', function (e) {
        e.preventDefault();
        $this.trigger('prev.owl.carousel');
      });
      $this.closest('.stm_lms_courses_carousel_wrapper').find('.stm_lms_courses_carousel__button_next').on('click', function (e) {
        e.preventDefault();
        $this.trigger('next.owl.carousel');
      });
    });
  }
})(jQuery);