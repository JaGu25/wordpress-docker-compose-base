<?php
/**
 * @var $title
 * @var $code
 * @var $css_class
 */

if( ! $code ){
	return;
}
?>

<div class="pull-right xs-pull-left">
	<div class="stm_share">
		<?php if( !empty($title) ){ ?>
			<label><?php echo sanitize_text_field( $title ); ?></label>
		<?php } ?>
		<?php echo rawurldecode( stm_base64( strip_tags( $code ) ) ); ?>
		<script>var switchTo5x=true;</script>
		<script src="https://ws.sharethis.com/button/buttons.js"></script>
		<script>stLight.options({doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
	</div>
</div>
