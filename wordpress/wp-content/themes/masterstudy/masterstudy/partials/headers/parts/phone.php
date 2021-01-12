<?php
$phone = stm_option( 'header_4_phone', '');
if(!empty($phone)): ?>
	<div class="stm_header_4_phone_inner heading_font">
		<i class="lnricons-telephone"></i> <?php echo sanitize_text_field($phone); ?>
	</div>
<?php endif;