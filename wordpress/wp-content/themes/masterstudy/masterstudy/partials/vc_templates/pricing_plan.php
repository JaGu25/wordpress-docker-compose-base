<?php
/**
 * @var $color
 * @var $title
 * @var $price
 * @var $period
 * @var $button
 * @var $css
 * @var $css_class
 */

// $plan = 'stm_pricing_plan_' . stm_create_unique_id($atts);
$plan_css = '.stm_pricing_plan.'.$plan;

stm_module_styles('pricing_plan');
?>

<div class="stm_pricing_plan <?php echo esc_attr($plan.$css_class); ?> text-center">
	<div class="border-top"></div>
	<div class="inner">
		<?php if(!empty($title)): ?>
			<h3 class="title"><?php echo esc_attr($title); ?></h3>
		<?php endif; ?>
		<?php if(!empty($price)): ?>
			<div class="text-center">
				<div class="price_unit_round heading_font">
					<div class="vertical_align">
						<div class="plan_price"><?php echo esc_attr($price); ?></div>
						<?php if(!empty($period)): ?>
							<div class="price_period"><?php echo esc_attr($period); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if(!empty($content)): ?>
			<div class="content">
				<?php echo stm_echo_safe_output($content); ?>
			</div>
		<?php endif; ?>

		<?php if(!empty($button['url']) and !empty($button['title'])): ?>
			<?php
				if(!empty($button['target'])):
					$target='target="'.esc_attr($button['target']).'"';
				else:
					$target='target="_self"';
				endif;
			?>
			<a class="btn btn-default btn-plan" href="<?php echo esc_url($button['url']); ?>" <?php echo esc_attr($target); ?>><?php echo esc_attr($button['title']); ?></a>
		<?php endif; ?>

	</div>
</div>

<?php if(!empty($color)): ?>
	<style type="text/css">
		<?php echo esc_attr($plan_css); ?> .inner .btn-plan:after,
		<?php echo esc_attr($plan_css); ?> .price_unit_round,
		<?php echo esc_attr($plan_css); ?> .border-top {
			background-color: <?php echo esc_attr($color); ?>;
		}
		<?php echo esc_attr($plan_css); ?> .inner .btn-plan {
			border-color: <?php echo esc_attr($color); ?>;
		}
	</style>
<?php endif; ?>
