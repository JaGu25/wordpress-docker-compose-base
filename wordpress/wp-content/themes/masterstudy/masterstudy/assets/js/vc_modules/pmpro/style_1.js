"use strict";

(function ($) {
  var groups = [];
  $(document).ready(function () {
    var $groups = $('.stm_lms_pmpro_groups');
    if (!$groups.length) return true;
    $('.stm_lms_plan').each(function () {
      var group = $(this).data('group');

      if (!groups.includes(group)) {
        $groups.append("<span data-group=\"".concat(group, "\">").concat(group, "</span>"));
        groups.push(group);
      }
    });

    if (groups.length > 1) {
      $('.stm_lms_pmpro_groups').addClass('has-groups');
      $('.stm_lms_plans').addClass('has-groups');
      changeGroup(groups[0]);
    }

    $groups.on('click', 'span', function () {
      $('.stm_lms_pmpro_groups span, .stm_lms_plan').removeClass('active');
      changeGroup($(this).data('group'));
    });
  });

  function changeGroup(group) {
    $("[data-group=\"".concat(group, "\"]")).addClass('active');
  }
})(jQuery);