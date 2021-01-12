<?php

$css_class .= ' legend_position_' . $legend_position;

if( empty( $legend_position ) ) {
    $legend_position = 'bottom';
}

wp_enqueue_script('Chart', get_template_directory_uri() . '/assets/js/Chart.min.js', array('jquery'), '2.9.3', true);

$chart_id = uniqid( 'chart_' );

$x_values = explode( ';', trim( $x_values, ';' ) );

$canvas_style = array(
    'height' => '300',
    'width' => '500'
);

if($design != 'bar' && $design != 'line') {
    $canvas_style['height'] = 500;
}

if( $height ) {
    $canvas_style[ 'height' ] = $height;
    if($legend_position == 'top' || $legend_position == 'bottom') {
        $canvas_style[ 'height' ] = intval($height) + 100;
    }
}

if( $width ) {
    $canvas_style[ 'width' ] = $width;
    if($legend_position == 'left' || $legend_position == 'right') {
        $canvas_style[ 'width' ] = intval($width) + 100;
    }
}

$data = array(
    'datasets' => array()
);

if($design == 'circle') {
    $design = 'pie';
}

if( $design == 'line' || $design == 'bar' || $design == 'radar' ) {
    $data[ 'labels' ] = $x_values;
    foreach( $values as $k => $v ) {

        $color = $v[ 'color' ];
        $rgb = masterstudy_hex2rgb( $color );

        if( $design == 'line' || $design == 'radar' ) {
            $data[ 'datasets' ][] = array(
                'label' => isset( $v[ 'title' ] ) ? $v[ 'title' ] : '',
                'fillColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 0.2)',
                'fill' => true,
                'pointBackgroundColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'pointBorderColor' => '#fff',
                'pointHoverBackgroundColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'pointHoverBorderColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'strokeColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'pointColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'pointStrokeColor' => '#fff',
                'borderColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'backgroundColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 0.2)',
                'pointHighlightFill' => '#fff',
                'pointHighlightStroke' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'data' => array_map( 'intval', explode( ';', isset( $v[ 'y_values' ] ) ? trim( $v[ 'y_values' ], ';' ) : '' ) ),
            );
        }
        else {
            $data[ 'datasets' ][] = array(
                'label' => isset( $v[ 'title' ] ) ? $v[ 'title' ] : '',
                'fillColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 0.8)',
                'strokeColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 0)',
                'backgroundColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'highlightStroke' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 1)',
                'pointColor' => $color,
                'data' => explode( ';', isset( $v[ 'y_values' ] ) ? trim( $v[ 'y_values' ], ';' ) : '' ),
            );
        }
    }
}
else {
    $labels = array();
    $colors = array();
    $datas = array();
    foreach( $values_circle as $k => $v ) {

        $color = $v[ 'color' ];
        $rgb = masterstudy_hex2rgb( $color );
        $datas[] = $v[ 'value' ];
        $labels[] = isset( $v[ 'title' ] ) ? $v[ 'title' ] : '';
        $colors[] = 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 0.75)';
        $data[ 'labels' ][] = isset( $v[ 'title' ] ) ? $v[ 'title' ] : '';

        $data[ 'datasets' ][] = array(
            'label' => isset( $v[ 'title' ] ) ? $v[ 'title' ] : '',
            'highlight' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 0.75)',
            'color' => $color,
            'pointColor' => $color,
            'value' => $v[ 'value' ],
            'data' => $v[ 'value' ],
            'backgroundColor' => 'rgba(' . $rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ] . ', 0.2)',
        );
    }
    $data[ 'labels' ] = $labels;
    $data[ 'datasets' ] = array(
        array(
            'label' => 'My First Dataset',
            'data' => $datas,
            'backgroundColor' => $colors
        )
    );
}

?>
<?php if( $data ): ?>
    <div class="stm_chart<?php echo esc_attr( $css_class ); ?>">
        <canvas id="<?php echo esc_attr( $chart_id ); ?>"
                width="<?php echo esc_attr($canvas_style['width']); ?>"
                height="<?php echo esc_attr($canvas_style['height']); ?>"></canvas>
        <script type="text/javascript">

            jQuery(window).on('load', function ($) {
                var showLegend = false;
                <?php if($legend): ?>
                showLegend = true;
                <?php endif; ?>
                var ChartData_<?php echo esc_js( $chart_id ); ?> = <?php echo json_encode( $data ); ?>;
                var <?php echo esc_js( $chart_id ); ?> = jQuery("#<?php echo esc_js( $chart_id ); ?>").get(0).getContext("2d");
                <?php echo esc_js( $chart_id ); ?>.
                canvas.width = <?php echo esc_js( $canvas_style[ 'width' ] ); ?>;
                <?php echo esc_js( $chart_id ); ?>.
                canvas.height = <?php echo esc_js( $canvas_style[ 'height' ] ); ?>;

                var stackedLine = new Chart(<?php echo esc_js( $chart_id ); ?>, {
                    type: '<?php echo esc_js( $design ); ?>',
                    data: ChartData_<?php echo esc_js( $chart_id ); ?>,
                    options: {
                        'legend': {
                            'position': '<?php echo esc_js( $legend_position ); ?>',
                            'display': showLegend
                        },
                        'responsive': true,
                        maintainAspectRatio: false
                    }
                });
            });


        </script>
    </div>
<?php endif; ?>
