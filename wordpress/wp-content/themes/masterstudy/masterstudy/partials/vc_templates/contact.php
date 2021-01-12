<?php
/**
 * @var $style
 * @var $name
 * @var $image
 * @var $job
 * @var $phone
 * @var $email
 * @var $skype
 * @var $css_class
 */

stm_module_styles('contact', 'style_1', array());

$image_size = (!empty($image_size)) ? $image_size : 'thumbnail';
?>

 <div class="stm_contact<?php echo esc_attr( $css_class ); ?> clearfix">
 	<?php if( ! empty( $image['thumbnail'] ) ){ ?>
 		<div class="stm_contact_image">
 			<?php echo stm_get_VC_img($image_id, $image_size); ?>
 		</div>
 	<?php } ?>
 	<div class="stm_contact_info">
 		<h4 class="name"><?php echo sanitize_text_field( $name ); ?></h4>
 		<?php if( $job ){ ?>
 			<div class="stm_contact_job heading_font"><?php echo sanitize_text_field( $job ); ?></div>
 		<?php } ?>
 		<?php if( $phone ){ ?>
 			<div class="stm_contact_row"><?php _e( 'Phone: ', 'masterstudy' ); ?><?php echo sanitize_text_field( $phone ); ?></div>
 		<?php } ?>
 		<?php if( $email ){ ?>
 			<div class="stm_contact_row">
                 <?php _e( 'Email: ', 'masterstudy' ); ?>
                 <a href="mailto:<?php echo stm_echo_safe_output( $email ); ?>"><?php echo stm_echo_safe_output( $email ); ?></a>
             </div>
 		<?php } ?>
 		<?php if( $skype ){ ?>
 			<div class="stm_contact_row">
                 <?php _e( 'Skype: ', 'masterstudy' ); ?>
                 <a href="skype:<?php echo sanitize_text_field( $skype ); ?>?chat">
                     <?php echo sanitize_text_field( $skype ); ?>
                 </a>
             </div>
 		<?php } ?>
 	</div>
 </div>
