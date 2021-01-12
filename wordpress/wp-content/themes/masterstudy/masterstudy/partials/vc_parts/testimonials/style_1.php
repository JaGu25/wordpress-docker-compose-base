<?php
$testimonials = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => $testimonials_max_num ) );

$slide_col = 12/$testimonials_slides_per_row;

wp_enqueue_script('owl.carousel');
wp_enqueue_style('owl.carousel');
stm_module_scripts('testimonials', $style);
stm_module_styles('testimonials', $style);

?>

<?php if($testimonials->have_posts()): ?>
	<div class="testimonials_main_wrapper simple_carousel_wrapper">
		<div class="clearfix testimonials_control_bar_top">

			<?php if(!empty($testimonials_title)): ?>
				<div class="pull-left">
					<h2 class="testimonials_main_title"><?php echo esc_attr($testimonials_title); ?></h2>
				</div>
			<?php endif; ?>

			<div class="pull-right testimonials_control_bar">
				<div class="clearfix">
					<div class="pull-right">
						<a href="#" class="btn-carousel-control simple_carousel_prev" title="<?php esc_attr_e('Scroll Carousel left', 'masterstudy'); ?>">
							<i class="fa-icon-stm_icon_chevron_left"></i>
						</a>
						<a href="#" class="btn-carousel-control simple_carousel_next" title="<?php esc_attr_e('Scroll Carousel right', 'masterstudy'); ?>">
							<i class="fa-icon-stm_icon_chevron_right"></i>
						</a>
					</div>
				</div>
			</div>

		</div>
		<div class="testimonials-carousel-unit">
			<div class="testimonials-carousel-init simple_carousel_init clearfix" data-items="<?php echo esc_attr($testimonials_slides_per_row); ?>">
				<?php while($testimonials->have_posts()): $testimonials->the_post(); ?>
					<?php $sphere = get_post_meta(get_the_id(), 'testimonial_profession', true); ?>
					<div class="col-md-<?php echo esc_attr($slide_col) ?> col-sm-12 col-xs-12">
						<div class="testimonial_inner_wrapper">
							<?php if(!has_post_thumbnail()): ?>
								<h4 class="testimonials-inner-title"><?php the_title(); ?></h4>
								<?php if(!empty($sphere)): ?>
									<div class="testimonial_sphere"><?php echo sanitize_text_field($sphere); ?></div>
								<?php endif; ?>
								<div class="short_separator"></div>
							<?php else: ?>
								<div class="media">
									<div class="media-left media-top">
										<div class="testimonial-media-unit">
											<?php the_post_thumbnail('img-69-69', array('class'=>'testimonial-media-unit-rounded')); ?>
										</div>
									</div>
									<div class="media-body">
										<h4 class="testimonials-inner-title"><?php the_title(); ?></h4>
										<?php if(!empty($sphere)): ?>
											<div class="testimonial_sphere"><?php echo sanitize_text_field($sphere); ?></div>
										<?php endif; ?>
										<div class="short_separator"></div>
									</div>
								</div>
							<?php endif; ?>
							<div class="testimonial_inner_content" style="color:<?php echo esc_attr($testimonials_text_color); ?>"><?php the_excerpt(); ?></div>
						</div> <!-- inner wrapper -->
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div> <!-- testimonials main wrapper -->
	
	<?php wp_reset_postdata(); ?>

<?php endif; ?>
