<?php // Shop before sidebar template ?>

<div class="heading_font product_main_data">
	<?php
		// Stm theme removes in inc/woocommerce-setups
		/**
		 * woocommerce_single_product_summary hook
		 *
		 * @hooked woocommerce_template_single_title - 5 Removed
		 * @hooked woocommerce_template_single_rating - 10 Removed
		 * @hooked woocommerce_template_single_price - 10 
		 * @hooked woocommerce_template_single_excerpt - 20 Removed
		 * @hooked woocommerce_template_single_add_to_cart - 30 
		 * @hooked woocommerce_template_single_meta - 40 Removed
		 * @hooked woocommerce_template_single_sharing - 50 Removed
		 */
		do_action( 'woocommerce_single_product_summary' );
		
		
		// Product meta
		$stock = get_post_meta(get_the_id(), '_stock', true);
		$duration = get_post_meta(get_the_id(), 'duration', true);
		$lectures = get_post_meta(get_the_id(), 'lectures', true);
		$video = get_post_meta(get_the_id(), 'video', true);
		$certificate = get_post_meta(get_the_id(), 'certificate', true);
	?>
</div>

<?php if(!empty($duration) or !empty($lectures) or !empty($video) or !empty($certificate)): ?>

	<div class="stm_product_sidebar_meta_units">
		<?php if(!empty($stock)): ?>
			<div class="stm_product_sidebar_meta_unit">
				<table>
					<tr>
						<td class="icon"><i class="fa-icon-stm_icon_users"></i></td>
						<td class="value h5"><?php echo esc_attr(floatval($stock)).' '.__('Students', 'masterstudy'); ?></td>
					</tr>
				</table>
			</div> <!-- unit -->
		<?php endif; ?>
		
		<?php if(!empty($duration)): ?>
			<div class="stm_product_sidebar_meta_unit">
				<table>
					<tr>
						<td class="icon"><i class="fa-icon-stm_icon_clock"></i></td>
						<td class="value h5"><?php echo esc_attr(__('Duration:', 'masterstudy').' '.$duration); ?></td>
					</tr>
				</table>
			</div> <!-- unit -->
		<?php endif; ?>
		
		<?php if(!empty($lectures)): ?>
			<div class="stm_product_sidebar_meta_unit">
				<table>
					<tr>
						<td class="icon"><i class="fa-icon-stm_icon_bullhorn"></i></td>
						<td class="value h5"><?php echo esc_attr(__('Lectures:', 'masterstudy').' '.$lectures); ?></td>
					</tr>
				</table>
			</div> <!-- unit -->
		<?php endif; ?>
		
		<?php if(!empty($video)): ?>
			<div class="stm_product_sidebar_meta_unit">
				<table>
					<tr>
						<td class="icon"><i class="fa-icon-stm_icon_film-play"></i></td>
						<td class="value h5"><?php echo esc_attr(__('Video:', 'masterstudy').' '.$video); ?></td>
					</tr>
				</table>
			</div> <!-- unit -->
		<?php endif; ?>
		
		<?php if(!empty($certificate)): ?>
			<div class="stm_product_sidebar_meta_unit">
				<table>
					<tr>
						<td class="icon"><i class="fa-icon-stm_icon_license"></i></td>
						<td class="value h5"><?php echo esc_attr($certificate); ?></td>
					</tr>
				</table>
			</div> <!-- unit -->
		<?php endif; ?>
		
	</div><!-- units -->
<?php endif; ?>