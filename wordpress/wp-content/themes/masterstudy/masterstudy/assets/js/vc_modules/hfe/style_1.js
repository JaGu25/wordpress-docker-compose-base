"use strict";

(function ($) {
  var holder = 'hfe-holder';
  $(document).ready(function () {
    /**
    *
     * @var stm_hfe_settings
     */
    $("header [data-elementor-id!=''][data-elementor-id]").each(function () {
      var id = $(this).attr('data-elementor-id');
      sticky(window["stm_hfe_settings_".concat(id)]);
    });
  });

  function sticky(settings) {
    var $selector = $('header [data-elementor-id="' + settings['id'] + '"]');
    if (!$selector.length) return false;
    /*Now we have sticky header*/

    if (settings['absolute'] === 'on') $selector.addClass('stm-hfe-absolute');

    if (settings['sticky'] === 'on') {
      $selector.before("<div id='" + holder + "'></div>");
      var $holder = $("#".concat(holder));
      $holder.css({
        height: $selector.height() + 'px'
      });
      $selector.addClass('stm-hfe-sticky');

      window.onscroll = function () {
        stickyScroll($selector[0], settings);
      };
    }
  }

  function stickyScroll(header, settings) {
    var $header = $(header);
    var $holder = $("#".concat(holder));

    if (window.pageYOffset > settings['sticky_threshold']) {
      $header.addClass('stacked');
      $holder.addClass('holding_position');
      $header.css({
        'background-color': settings['sticky_threshold_color']
      });
    } else {
      setTimeout(function () {
        $header.removeClass('stacked');
        $holder.removeClass('holding_position');
        $header.removeAttr('style');
      }, 100);
    }
  }
})(jQuery);