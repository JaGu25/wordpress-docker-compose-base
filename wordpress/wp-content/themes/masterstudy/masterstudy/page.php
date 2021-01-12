<?php
$style = (defined('STM_POST_TYPE')) ? 'post_type_exist' : 'text_block';

get_header(); ?>

<?php get_template_part('partials/title_box'); ?>

    <div class="container">

        <?php if (have_posts()) : ?>
            <div class="<?php echo esc_attr($style); ?> clearfix">
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

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

        <div class="clearfix">
            <?php
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
        </div>

    </div>

<?php get_footer(); ?>