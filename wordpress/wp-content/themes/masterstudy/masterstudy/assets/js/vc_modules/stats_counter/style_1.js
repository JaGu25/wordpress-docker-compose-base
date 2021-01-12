"use strict";

(function ($) {
  $(document).ready(function () {
    var counters = [];
    $('.stats_counter').each(function () {
      var $this = $(this);
      var id = $this.attr('data-id');
      counters[id] = {
        started: false,
        counter: new countUp(id, 0, $this.attr('data-value'), 0, $this.attr('data-duration'), {
          useEasing: true,
          useGrouping: true,
          separator: ''
        })
      };
      $(window).scroll(function () {
        if ($('#' + id).is_on_screen() && !counters[id]['started']) {
          counters[id]['counter'].start();
          counters[id]['started'] = true;
        }
      });
    });
  });
})(jQuery);