<?php $vc_status = get_post_meta(get_the_ID(), '_wpb_vc_js_status', true); ?>
<?php $elementor_data = get_post_meta(get_the_ID(), '_elementor_data', true); ?>
<?php $elementor_status = (get_post_type() == 'teachers') ? true : false; ?>

<?php if (($vc_status != 'false' && $vc_status == true) || !empty($elementor_data) || $elementor_status): ?>

    <?php get_template_part('partials/title_box'); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="container">
            <?php the_content(); ?>
            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'masterstudy') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                'pagelink' => '<span class="screen-reader-text">' . __('Page', 'masterstudy') . ' </span>%',
                'separator' => '<span class="screen-reader-text">, </span>',
            ));
            ?>
        </div>
    </article>

<?php else: ?>


    <?php
    // Blog setup
    $blog_layout = stm_option('blog_layout');

    // Sidebar
    $blog_sidebar_position = stm_option('blog_sidebar_position', 'none');


    $content_before = $content_after = $sidebar_before = $sidebar_after = '';

    if (!empty($_GET['sidebar_id'])) {
        $blog_sidebar_id = intval($_GET['sidebar_id']);
    } else {
        $blog_sidebar_id = stm_option('blog_sidebar');
    }

    if ($blog_sidebar_id) {
        $blog_sidebar = get_post($blog_sidebar_id);
    }

    if (empty($blog_sidebar)) {
        $blog_sidebar_position = 'none';
    }

    if ($blog_sidebar_position == 'right' && isset($blog_sidebar)) {
        $content_before .= '<div class="row">';
        $content_before .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';

        $content_after .= '</div>'; // col
        $sidebar_before .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
        // .sidebar-area
        $sidebar_after .= '</div>'; // col
        $sidebar_after .= '</div>'; // row
    }

    if ($blog_sidebar_position == 'left' && isset($blog_sidebar)) {
        $content_before .= '<div class="row">';
        $content_before .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';

        $content_after .= '</div>'; // col
        $sidebar_before .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
        // .sidebar-area
        $sidebar_after .= '</div>'; // col
        $sidebar_after .= '</div>'; // row
    }

    ?>
    <!-- Title -->
    <?php get_template_part('partials/title_box'); ?>
    <div class="container blog_main_layout_<?php echo esc_attr($blog_layout); ?>">

        <?php echo wp_kses_post($content_before); ?>
        <div class="blog_layout_list sidebar_position_<?php echo esc_attr($blog_sidebar_position); ?>">
            <div class="stm_post_unit">
                <div class="stm_post_info">
                    <h1 class="h2 post_title"><?php the_title(); ?></h1>
                    <div class="stm_post_details clearfix">
                        <ul class="clearfix post_meta">
                            <li class="post_date h6"><i
                                        class="far fa-clock"></i><span><?php echo get_the_date(); ?></span></li>
                            <li class="post_by h6"><i class="fa fa-user"></i><?php _e('Posted by:', 'masterstudy'); ?>
                                <span><?php the_author(); ?></span></li>
                            <?php $cats = get_the_category(get_the_id()); //print_r($cats); ?>
                            <?php if (!empty($cats)): ?>
                                <li class="post_cat h6"><i class="fa fa-flag"></i>
                                    <?php _e('Category:', 'masterstudy'); ?>
                                    <?php foreach ($cats as $cat): ?>
                                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span><?php echo sanitize_text_field($cat->name); ?></span></a>
                                    <?php endforeach; ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="comments_num">
                            <a href="<?php comments_link(); ?>" class="post_comments h6"><i
                                        class="fa fa-comments-o"></i> <?php comments_number(); ?> </a>
                        </div>
                    </div>
                    <?php if (has_post_thumbnail()) { ?>
                        <?php if (!isset($blog_sidebar) && $blog_sidebar_position == 'none') {
                            $image_size = 'img-1170-500';
                        } else {
                            $image_size = 'img-840-430';
                        }; ?>
                        <div class="post_thumbnail">
                            <?php the_post_thumbnail($image_size, array('class' => 'img-responsive')); ?>
                        </div>
                    <?php } ?>
                </div>

				<div class="text_block clearfix">
					<?php the_content(); ?>
				</div>

            </div> <!-- stm_post_unit -->

            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links"><label>' . __('Pages:', 'masterstudy') . '</label>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                'pagelink' => '%',
                'separator' => '',
            ));
            ?>

            <div class="row mg-bt-10">
                <div class="col-md-8 col-sm-8">
                    <div class="stm_post_tags widget_tag_cloud">
                        <?php if ($tags = wp_get_post_tags(get_the_ID())) { ?>
                            <div class="tagcloud">
                                <?php foreach ($tags as $tag) { ?>
                                    <a href="<?php echo get_tag_link($tag); ?>"><?php echo sanitize_text_field($tag->name); ?></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="pull-right xs-pull-left">
                        <?php if (function_exists('stm_configurations_share')) stm_configurations_share(); ?>
                    </div>
                </div>
            </div> <!-- row -->

            <?php if (get_the_author_meta('description')) : ?>
                <div class="stm_author_box clearfix">
                    <div class="author_name">
                        <h4><?php _e('Author:', 'masterstudy'); ?><?php the_author_meta('nickname'); ?></h4>
                    </div>
                    <div class="author_avatar">
                        <?php echo get_avatar(get_the_author_meta('email'), 174); ?>
                        <div class="author_info">
                            <div class="author_content"><?php echo get_the_author_meta('description'); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="multiseparator"></div>
            <?php if (comments_open() || get_comments_number()) { ?>
                <div class="stm_post_comments">
                    <?php comments_template(); ?>
                </div>
            <?php } ?>
        </div>
        <?php echo wp_kses_post($content_after); ?>
        <?php echo wp_kses_post($sidebar_before); ?>
        <div class="sidebar-area sidebar-area-<?php echo esc_attr($blog_sidebar_position); ?>">
            <?php
            if (isset($blog_sidebar) && $blog_sidebar_position != 'none') {
                echo apply_filters('the_content', $blog_sidebar->post_content);
            }
            ?>
        </div>
        <?php echo wp_kses_post($sidebar_after); ?>

    </div>

<?php endif; ?>
