<?php

$testimonials = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => $testimonials_max_num ) );

wp_enqueue_script('owl.carousel');
wp_enqueue_style('owl.carousel');
stm_module_scripts('testimonials', $style);
stm_module_styles('testimonials', $style);

if($testimonials->have_posts()): ?>
    <div class="stm_testimonials_wrapper_style_2">
	    <?php while($testimonials->have_posts()): $testimonials->the_post();
	        $image = stm_get_VC_attachment_img_safe(get_post_thumbnail_id(), '1920x700', 'full', true, false);
			$img_style = (!empty($image)) ? "style='background-image : url({$image});'" : "";
			$testimonial_profession = get_post_meta(get_the_ID(), 'testimonial_profession', true);
			$testimonial_user = get_post_meta(get_the_ID(), 'testimonial_user', true);
	        ?>
            <div class="stm_lms_testimonials_single stm_carousel_glitch" <?php echo html_entity_decode($img_style); ?>>
                <div class="container">
                    <div class="stm_lms_testimonials_single__content">
                        <div class="stm_lms_testimonials_single__title">
                            <h3><?php the_title(); ?></h3>
                        </div>
                        <div class="stm_lms_testimonials_single__excerpt heading_font"><?php the_excerpt(); ?></div>

						<?php if(!empty($testimonial_user)): ?>
                            <div class="stm_lms_testimonials_single__testimonial_user heading_font">
								<?php echo sanitize_text_field($testimonial_user); ?>
                            </div>
						<?php endif; ?>

                        <?php if(!empty($testimonial_profession)): ?>
                            <div class="stm_lms_testimonials_single__testimonial_profession">
                                <?php echo sanitize_text_field($testimonial_profession); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    
    <?php wp_reset_postdata(); ?>

<?php endif; ?>
