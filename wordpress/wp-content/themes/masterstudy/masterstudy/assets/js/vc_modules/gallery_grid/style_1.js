"use strict";

(function ($) {
  $(document).ready(function () {
    if ($('.wait-for-images').length) {
      if (typeof imagesLoaded == 'function') {
        $('.wait-for-images').imagesLoaded(function () {
          $('#stm_isotope').isotope({
            itemSelector: '.stm-isotope-item'
          });
        });
      }
    } // bind sort button click


    $('.gallery_terms_list a').on('click', function () {
      $(this).closest('li').addClass('active').siblings().removeClass('active');
      $('.stm-isotope-item').removeClass('stm-isotope-item-filtered');
      var selector = $(this).attr('data-filter'); // This code hides filtered items, instead of changing opacity, to enable it, selector needs '.'

      $('#stm_isotope').isotope({
        filter: selector
      });
      return false;
    });
  });
})(jQuery);