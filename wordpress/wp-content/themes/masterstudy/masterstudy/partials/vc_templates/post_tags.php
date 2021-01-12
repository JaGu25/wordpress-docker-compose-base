<?php
/**
 * @var $css_class
 */
?>

<div class="stm_post_tags widget_tag_cloud">
	<?php if( $tags = wp_get_post_tags( get_the_ID() ) ){ ?>
		<div class="tagcloud">
			<?php foreach( $tags as $tag ){ ?>
				<a href="<?php echo get_tag_link( $tag ); ?>"><?php echo sanitize_text_field( $tag->name ); ?></a>
			<?php } ?>
		</div>
	<?php } ?>
</div>
