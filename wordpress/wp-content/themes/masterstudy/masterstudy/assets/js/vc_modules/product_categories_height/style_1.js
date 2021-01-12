"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    coursesSingleMaxHeight();
  });
  $(window).load(function () {
    coursesSingleMaxHeight();
  });
  $(window).resize(function () {
    coursesSingleMaxHeight();
  });
  var singleCourseHeight = 0;

  function coursesSingleMaxHeight() {
    $('.product_categories_main_wrapper .single-course-col').each(function () {
      var elementHeight = $(this).find('.project_cat_single_item').height();

      if (elementHeight > singleCourseHeight) {
        singleCourseHeight = elementHeight;
      }
    });
    $('.project_cat_single_item').height(singleCourseHeight);
  }
})(jQuery);