<?php
$output = $preview = $preview_hidden = '';
$link = (isset($link['url'])) ? $link['url'] : $link;

$image = (isset($image['id'])) ? intval($image['id']) : $image;

// Video Preview
if(!empty($image)) {
	$preview = wp_get_attachment_image_src($image, 'full');
	if(!empty($preview[0])) {
		$preview = $preview[0];
	}
	$preview_hidden = '';
} else {
	$preview_hidden = 'preview_hidden';
}


global $wp_embed;
$embed = '<iframe width="950" height="534" data-src="'.$link.'?feature=oembed" allow="autoplay" frameborder="0" allowfullscreen=""></iframe>';

if(!empty($preview)) {
    $output .= "\n\t" . '<div class="stm_video_wrapper">';
    $output .= "\n\t" . '<div class="' . $css_class . '">';
    $output .= "\n\t\t" . '<div class="wpb_wrapper">';
    if (!empty($title)):
		$output .= "\n\t" . '<div class="stm_video_wrapper_title">';
        $output .= "\n\t" . '<h2 class="wpb_heading wpb_video_heading">'.$title.'</h2>';
        $output .= "\n\t" . '</div> ';
    endif;
    $output .= '<div class="stm_theme_wpb_video_wrapper">';
    if (!empty($preview)):
        $output .= '<div class="stm_video_preview" style="background-image:url(' . $preview . ')"></div>';
    endif;
    $output .= '<div class="wpb_video_wrapper ' . $preview_hidden . '">' . $embed . '</div></div>';
    $output .= "\n\t\t" . '</div> ';
    $output .= "\n\t" . '</div> ';
    $output .= "\n\t" . '</div> ';
    echo masterstudy_filtered_output($output);
} else { ?>
    <iframe width="100%" height="400" src="<?php echo esc_url($link); ?>?feature=oembed" allow="autoplay" frameborder="0" allowfullscreen=""></iframe>
<?php }
?>

<style type="text/css">
	.stm_theme_wpb_video_wrapper .wpb_video_wrapper {
		padding-top: 56.25%;
	    position: relative;
	    width: 100%;
	}
	.stm_theme_wpb_video_wrapper .wpb_video_wrapper iframe {
		width: 100%;
	    height: 100%;
	    display: block;
	    position: absolute;
	    margin: 0;
	    top: 0;
	    left: 0;
	    box-sizing: border-box;	
	}
</style>

<?php if(!empty($link)): ?>
	<script>
		(function($) {
		    "use strict";

			$(document).ready(function ($) {
				stmPlayIframeVideo();
			});

			/* Custom func */
			function stmPlayIframeVideo() {
				$('.stm_video_preview').on('click', function(){
					$(this).addClass('video_preloader_hidden');
					var addPlay = $(this).closest('.stm_video_wrapper').find('iframe').attr('data-src');
					$(this).closest('.stm_video_wrapper').find('.wpb_video_wrapper').addClass('video_autoplay_true');
					$(this).closest('.stm_video_wrapper').find('iframe').attr('src', addPlay + '&autoplay=1');
				});
			};

		})(jQuery);
	</script>
<?php endif; ?>
