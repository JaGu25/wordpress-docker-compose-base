<?php
$post_id = get_the_ID();
if( $post_type === 'product' ) {
    $post_id = get_post_meta( $post_id, '_meeting_id', true );
}
if( !empty( $post_id ) ) {
    $host_id = get_post_meta( $post_id, 'stm_host', true );
    $timezone = get_post_meta( $post_id, 'stm_timezone', true );
    $user_email = '';
    $first_name = '';
    $last_name = '';
    if( empty( $timezone ) ) {
        $timezone = 'UTC';
    }

    $timezones = stm_zoom_get_timezone_options();
    if( !empty( $timezones[ $timezone ] ) ) {
        $timezone = $timezones[ $timezone ];
    }

    if( !empty( $host_id ) && !empty( $host_id ) ) {
        $zoom_users = array();
        if( !empty( $users ) ) {
            foreach( $users as $user ) {
                $zoom_users[ $user[ 'id' ] ] = array(
                    'email' => $user[ 'email' ],
                    'first_name' => $user[ 'first_name' ],
                    'last_name' => $user[ 'last_name' ],
                );
            }
        }
        if( !empty( $zoom_users[ $host_id ] ) ) {
            if( !empty( $zoom_users[ $host_id ][ 'email' ] ) ) {
                $user_email = $zoom_users[ $host_id ][ 'email' ];
            }
            if( !empty( $zoom_users[ $host_id ][ 'first_name' ] ) ) {
                $first_name = $zoom_users[ $host_id ][ 'first_name' ];
            }
            if( !empty( $zoom_users[ $host_id ][ 'last_name' ] ) ) {
                $last_name = $zoom_users[ $host_id ][ 'last_name' ];
            }
        }
    }

    ?>
    <div class="stm_zoom_grid__item">
        <div class="single_meeting">
            <?php if( has_post_thumbnail() ): ?>
                <div class="image">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </a>
                </div>
            <?php endif; ?>
            <div class="info">
                <div class="title">
                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                </div>
                <div class="zoom_date">
                    <?php
                    $start_date = get_post_meta( $post_id, 'stm_date', true );
                    $start_time = get_post_meta( $post_id, 'stm_time', true );
                    $meeting_start = strtotime( 'tomorrow', ( intval( $start_date ) / 1000 ) );
                    if( !empty( $start_time ) ) {
                        $time = explode( ':', $start_time );
                        if( is_array( $time ) and count( $time ) === 2 ) {
                            $meeting_start = strtotime( "+{$time[0]} hours +{$time[1]} minutes", $meeting_start );
                        }
                    }
                    $meeting_start = date( 'Y-m-d H:i:s', $meeting_start );
                    $date_format = 'F j';
                    $year_format = 'Y';
                    $date = strtotime( $meeting_start );
                    $month_date = date( $date_format, $date );
                    $year = date( $year_format, $date );
                    ?>
                    <div class="date">
                        <?php echo esc_html($month_date); ?>
                    </div>
                    <div class="year">
                        <?php echo esc_html($year); ?>
                    </div>
                    <?php
                    $price = '';
                    if($post_type === 'product' && class_exists('WooCommerce')){
                        global $product;
                        $price = $product->get_price_html();
                    }
                    if(!empty($price)):
                        ?>
                        <span class="price"><?php echo wp_kses_post($price); ?></span>
                    <?php endif; ?>
                </div>
                <div class="zoom_host">
                    <div class="host_info">
                        <div class="host_title">
                            <?php if( $post_type === 'product' ): ?>
                            <a href="<?php echo get_home_url( '/' ) . '/zoom-users/' . esc_attr( $host_id ); ?>">
                                <?php endif; ?>
                                <?php echo esc_html( $first_name . ' ' . $last_name ); ?>
                                <?php if( $post_type === 'product' ): ?>
                            </a>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>