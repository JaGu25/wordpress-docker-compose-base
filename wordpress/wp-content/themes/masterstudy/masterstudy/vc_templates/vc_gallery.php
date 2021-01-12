<?php
$output = $title = $type = $onclick = $custom_links = $img_size = $thumbnail_size = $custom_links_target = $images = $el_class = $interval = $css = '';
extract( shortcode_atts( array(
	'title' => '',
	'type' => 'image_grid',
	'onclick' => 'link_image',
	'custom_links' => '',
	'custom_links_target' => '',
	'img_size' => 'thumbnail',
	'thumbnail_size' => 'thumb-176x104',
	'images' => '',
	'el_class' => '',
	'interval' => '5',
	'css' => ''
), $atts ) );
$gal_images = '';
$gal_images_nav = '';
$link_start = '';
$link_end = '';
$el_start = '';
$el_end = '';
$slides_wrap_start = '';
$slides_wrap_end = '';
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$el_class = $this->getExtraClass( $el_class );
if ( $type == 'nivo' ) {
	$type = ' wpb_slider_nivo theme-default';
	wp_enqueue_script( 'nivo-slider' );
	wp_enqueue_style( 'nivo-slider-css' );
	wp_enqueue_style( 'nivo-slider-theme' );

	$slides_wrap_start = '<div class="nivoSlider">';
	$slides_wrap_end = '</div>';
} else if ( $type == 'flexslider' || $type == 'flexslider_fade' || $type == 'flexslider_slide' || $type == 'fading' ) {
	$el_start = '<li>';
	$el_end = '</li>';
	$slides_wrap_start = '<ul class="slides">';
	$slides_wrap_end = '</ul>';
	wp_enqueue_style( 'flexslider' );
	wp_enqueue_script( 'flexslider' );
} else if ( $type == 'image_grid' ) {
	wp_enqueue_script( 'isotope' );

	$el_start = '<li class="isotope-item">';
	$el_end = '</li>';
	$slides_wrap_start = '<ul class="wpb_image_grid_ul">';
	$slides_wrap_end = '</ul>';
} else if( $type == 'slick_slider' || $type == 'slick_slider_2' ){
	wp_enqueue_script( 'slick' );
	wp_enqueue_style( 'slick' );
}

if ( $onclick == 'link_image' ) {
	wp_enqueue_script( 'prettyphoto' );
	wp_enqueue_style( 'prettyphoto' );
}

$flex_fx = '';
if ( $type == 'flexslider' || $type == 'flexslider_fade' || $type == 'fading' ) {
	$type = ' wpb_flexslider flexslider_fade flexslider';
	$flex_fx = ' data-flex_fx="fade"';
} else if ( $type == 'flexslider_slide' ) {
	$type = ' wpb_flexslider flexslider_slide flexslider';
	$flex_fx = ' data-flex_fx="slide"';
} else if ( $type == 'image_grid' ) {
	$type = ' wpb_image_grid';
}

if ( $images == '' ) $images = '-1,-2,-3';

$pretty_rel_random = ' data-rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"';

if ( $onclick == 'custom_link' ) {
	$custom_links = explode( ',', $custom_links );
}
$images = explode( ',', $images );
$i = - 1;
$images_count = 0;
foreach ( $images as $attach_id ) {
	$i ++;
	$image_post = '';
	if ( $attach_id > 0 ) {
		$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ) );
		$post_thumbnail_nav = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $thumbnail_size ) );
		$image_post = get_post( $attach_id );
		$images_count++;
	} else {
		$post_thumbnail_nav = array();
		$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
		$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
	}

	$thumbnail = $post_thumbnail['thumbnail'];
	$p_img_large = $post_thumbnail['p_img_large'];

	$link_start = '<div class="item">';
	$link_end = '</div>';

	if ( $onclick == 'link_image' ) {
		$link_start = '<a class="prettyphoto" href="' . esc_url($p_img_large[0]) . '"' . $pretty_rel_random . '>';
		$link_end = '</a>';
	} else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
		$link_start = '<a href="' . $custom_links[$i] . '"' . ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) . '>';
		$link_end = '</a>';
	}

	if( $type == 'slick_slider_2' && $image_post ){
		$link_start .= '<span class="image_title">' . get_the_title( $image_post->ID ) . '</span>';
	}

	$gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
	$gal_images_nav .= $el_start . '<div><div class="slick-slide-wr">' . $post_thumbnail_nav['thumbnail'] . '</div></div>' . $el_end;
}

$id = rand();

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gallery wpb_content_element' . $el_class . ' ' . $css_class . ' vc_clearfix', $this->settings['base'], $atts );
$output .= "\n\t" . '<div class="' . $css_class . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
if( $title ){
	$output .= '<h5>' . $title . '</h5>';
}
if( $type == 'slick_slider' || $type == 'slick_slider_2' ) {
	$output .= '<div id="image_carousel-' . $id . '" class="wpb_gallery_slides' . $type . ' slider_main">' . $slides_wrap_start . $gal_images . $slides_wrap_end . '</div>';
}else{
	$output .= '<div class="wpb_gallery_slides' . $type . '" data-interval="' . $interval . '"' . $flex_fx . '>' . $slides_wrap_start . $gal_images . $slides_wrap_end . '</div>';
}
if( $type == 'slick_slider_2' ){
	$output .= '<div id="image_carousel-nav-' . $id . '" class="wpb_gallery_slides_nav' . $type . ' slider_nav">' . $slides_wrap_start . $gal_images_nav . $slides_wrap_end . '</div>';
}
if( $type == 'slick_slider' ){
	$output .= '
	<script type="text/javascript">
	    jQuery(document).ready(function($) {
	        "use strict";
	        var slick_' . $id . ' = $("#image_carousel-' . $id . '");
	        slick_' . $id . '.slick({
	            infinite: true,
	            adaptiveHeight: true,
	            prevArrow: "<div class=\"slick_prev\"><i class=\"fa fa-chevron-left\"></i></div>",
	            nextArrow: "<div class=\"slick_next\"><i class=\"fa fa-chevron-right\"></i></div>",
	            cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)"
	        });

	    });
	    </script>
	';
}

if( $type == 'slick_slider_2' ){
	$output .= '
	<script type="text/javascript">
	    jQuery(document).ready(function($) {
	        "use strict";
	        var slick_' . $id . ' = $("#image_carousel-' . $id . '");
	        var slick_nav' . $id . ' = $("#image_carousel-nav-' . $id . '");
	        var slick_current_slide' . $id . ' = 1;

	        slick_' . $id . '.on("init", function(){
				slick_' . $id . '.append("<div class=\'slider_info\'><span>"+ slick_current_slide' . $id . ' +"</span> / <em>' . $images_count . '</em></div>");
			});

			slick_' . $id . '.on("afterChange", function(slick, currentSlide){
				slick_current_slide' . $id . ' = $(this).slick("slickCurrentSlide") + 1;
				slick_' . $id . '.find(".slider_info span").text(slick_current_slide' . $id . ');
				slick_nav' . $id . '.find(".slick-slide.slick-active:first").addClass("stm-slick-active");
			});

			slick_' . $id . '.on("beforeChange", function(slick, currentSlide){
				slick_nav' . $id . '.find(".slick-slide.stm-slick-active").removeClass("stm-slick-active");
			});

	        slick_' . $id . '.slick({
	            slidesToShow: 1,
                slidesToScroll: 1,
	            adaptiveHeight: true,
	            prevArrow: "<div class=\"slick_prev\"><i class=\"fa fa-chevron-left\"></i></div>",
	            nextArrow: "<div class=\"slick_next\"><i class=\"fa fa-chevron-right\"></i></div>",
	            asNavFor: "#image_carousel-nav-' . $id . '",
	            fade: true
	        });

	        slick_nav' . $id . '.slick({
				slidesToShow: 6,
				asNavFor: "#image_carousel-' . $id . '",
                focusOnSelect: true,
                dots: false,
                arrows: false
	        });

	    });
	    </script>
	';
}

$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_gallery' );

echo masterstudy_filtered_output( $output );