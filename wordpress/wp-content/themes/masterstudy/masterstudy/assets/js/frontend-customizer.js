"use strict";

jQuery(document).ready(function ($) {
  "use strict"; // Customizer main func

  $(window).load(function () {
    $("#frontend_customizer").animate({
      left: -233
    }, 300);
  });
  $("#frontend_customizer_button").on('click', function () {
    if ($("#frontend_customizer").hasClass('open')) {
      $("#frontend_customizer").animate({
        left: -233
      }, 300);
      $("#frontend_customizer").removeClass('open');
    } else {
      $("#frontend_customizer").animate({
        left: 0
      }, 300);
      $("#frontend_customizer").addClass('open');
    }
  });
  $('#wrapper').on('click', function (kik) {
    if (!$(kik.target).is('#frontend_customizer, #frontend_customizer *') && $('#frontend_customizer').is(':visible')) {
      $("#frontend_customizer").animate({
        left: -233
      }, 300);
      $("#frontend_customizer").removeClass('open');
    }
  }); // Color scheme

  $("#skin_color span").on('click', function () {
    $("#skin_color .active").removeClass("active");
    $(this).addClass("active");
    $("body").removeClass("skin_red_green skin_blue_green skin_red_brown skin_default");
    $("body").addClass($(this).attr("id"));
    var logo_color = $(this).attr('data-secondary');
    console.log(logo_color);

    if ($('#header').hasClass('transparent_header')) {
      if (logo_color === 'default') {
        $('.logo_colored_fixed').attr('src', logos_url + '/logo-colored.png');
      } else {
        $('.logo_colored_fixed').attr('src', logos_url + '/logo-colored-' + logo_color + '.png');
      }
    }
  });

  if ($("#header").hasClass("sticky_header")) {
    $("#navigation_type").addClass("active");
  } // Header func


  $("#navigation_type").on("click", function () {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('#header').removeClass('sticky_header scrolling').css('padding-bottom', 0);
      $('.header_default').removeClass('fixed_invisible_top fixed'); // If transparency off change static header logo

      if (!$('#navigation_transparency').hasClass('active')) {
        $('.logo_colored_fixed').removeClass('visible').addClass('hidden');
        $('.logo_transparent_static').removeClass('hidden').addClass('visible');
      }
    } else {
      $(this).addClass('active');
      $('#header').addClass('sticky_header');
    }
  });
  $("#navigation_transparency").on("click", function () {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('#header').addClass('transparent_header').removeClass('transparent_header_off');
      $('.logo_colored_fixed').removeClass('visible').addClass('hidden');
      $('.logo_transparent_static').removeClass('hidden').addClass('visible');
    } else {
      $(this).addClass('active');
      $('#header').removeClass('transparent_header').addClass('transparent_header_off');
      $('.logo_transparent_static').removeClass('visible').addClass('hidden');
      $('.logo_colored_fixed').removeClass('hidden').addClass('visible');
    }
  });
});