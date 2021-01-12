<?php
wp_enqueue_style( 'masterstudy_left_bar', get_template_directory_uri() . '/assets/css/vc_modules/headers/left_bar.css', '', STM_THEME_VERSION, 'all' );
$terms = array();
$terms_all = stm_lms_get_terms_with_meta( 'course_icon', null, array('parent' => 0) );
if( !empty( $terms_all ) ) {
    foreach( $terms_all as $term ) {
        $meta_value = get_term_meta( $term->term_id, 'course_icon', true );
        if( !empty( $meta_value ) ) $terms[] = $term->term_id;
    }
}
?>
<div class="left_bar heading_font">
    <div class="bar_item">
        <div class="icon toggler">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/menu.svg'; ?>" alt="toggle menu"/>
        </div>
    </div>
    <?php if(class_exists('STM_LMS_User')): ?>
    <div  class="bar_item">
        <div class="icon">
            <a href="<?php echo STM_LMS_User::login_page_url(); ?>">
                <i class="lnricons-user"></i>
            </a>
        </div>
        <div class="content <?php if(is_user_logged_in()): ?>content-log-out <?php endif; ?>">
            <?php if(is_user_logged_in()): ?>

                <?php $user = STM_LMS_User::get_current_user(); ?>
                <a href="<?php echo esc_url(STM_LMS_User::user_page_url()); ?>">
                    <?php echo wp_kses_post($user['avatar']); ?>
                    <span class="login_name"><?php echo stm_lms_minimize_word(sprintf(esc_html__('Hey, %s', 'masterstudy'), $user['login']), 15); ?></span>
                </a>

                <i class="fa fa-power-off stm_lms_logout"></i>
            <?php else: ?>
                <a href="<?php echo STM_LMS_User::login_page_url(); ?>">
                    <?php esc_html_e('Login/Sign UP', 'masterstudy'); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if(class_exists('STM_LMS_Course')): ?>
    <form action="<?php echo esc_url( STM_LMS_Course::courses_page_url() ); ?>">
        <div class="bar_item">
            <div class="icon">
                <button type="submit" href="<?php echo esc_url( STM_LMS_Course::courses_page_url() ); ?>">
                    <i class="lnricons-magnifier"></i>
                </button>
            </div>
            <div class="content">
                <input name="search" class="form-control"
                       placeholder="<?php esc_attr_e( 'Search Courses...', 'masterstudy' ); ?>"/>
            </div>
        </div>
    </form>
    <?php endif; ?>
    <?php if( !empty( $terms_all ) ): ?>
        <?php foreach( $terms_all as $term ): ?>
            <?php
            $term_icon = get_term_meta( $term->term_id, 'course_icon', true );
            $term_icon = ( !empty( $term_icon ) ) ? $term_icon : 'no-icon';
            ?>
            <div class="bar_item">
                <div class="icon">
                    <a href="<?php echo esc_url( get_term_link( $term, 'stm_lms_course_taxonomy' ) ); ?>"
                       title="<?php echo esc_attr( $term->name ); ?>"
                       class="no_deco">
                        <i class="<?php echo esc_attr( $term_icon ); ?>"></i>
                    </a>
                </div>
                <div class="content">
                    <a href="<?php echo esc_url( get_term_link( $term, 'stm_lms_course_taxonomy' ) ); ?>"
                       title="<?php echo esc_attr( $term->name ); ?>"
                       class="no_deco">
                        <?php echo esc_attr( $term->name ); ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>