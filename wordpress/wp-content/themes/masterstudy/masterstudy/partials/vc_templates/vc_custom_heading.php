<?php

if( !empty( $stm_title_font_weight ) ) {
    $styles[] = 'font-weight:' . $stm_title_font_weight;
}

if ( ! empty( $styles ) ) {
    $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
} else {
    $style = '';
}

if ( 'post_title' === $source ) {
    $text = get_the_title( get_the_ID() );
}

if( ! empty( $font_container_data['values']['text_align'] ) ){
    $css_class .= ' text_align_' . $font_container_data['values']['text_align'];
}

if ( ! empty( $link ) and !empty($link['url']) ) {
    $text = '<a href="' . esc_attr( $link['url'] ) . '"'
        . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
        . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
        . '>' . $text . '</a>';
}

if( $icon ){
    $css_class .= ' has_icon';

    if( !empty( $icon_pos ) ) {
        $css_class .= ' icon_pos_' . $icon_pos;
    }
    if( !empty( $icon_pos_right ) ) {
        $css_class .= ' icon_' . $icon_pos_right;
    }
    if( !empty( $icon_pos_top ) ) {
        $css_class .= ' icon_' . $icon_pos_top;
    }
    if( !empty( $icon_pos_bottom ) ) {
        $css_class .= ' icon_' . $icon_pos_bottom;
    }
}

if( $subtitle ){
    $css_class .= ' has_subtitle';
}

if( $stripe_pos == 'hide' ) {
    $css_class .= ' title_no_stripe';
}

if( $stripe_pos == 'between' ) {
    $css_class .= ' stripe_' . esc_attr( $stripe_pos );
}

if( $stripe_pos == 'bottom' ) {
    $css_class .= ' stripe_' . esc_attr( $stripe_pos );
}

if( $stripe_pos == 'top_bottom' ) {
    $css_class .= ' stripe_' . esc_attr( $stripe_pos );
}


$subtitle_styles = array();
$subtitle_style = '';

if( !empty( $subtitle_color ) ) {
    $subtitle_styles[] = 'color:' . esc_attr( $subtitle_color );
}

if( !empty( $subtitle_styles ) && is_array( $subtitle_styles ) ) {
    $subtitle_style = ' style="'. implode( ';', $subtitle_styles ) .'"';
}

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$output = '';
if ( apply_filters( 'vc_custom_heading_template_use_wrapper', true ) ) {
    $output .= '<div class="' . esc_attr( $css_class ) . '" ' . implode( ' ', $wrapper_attributes ) . '>';
    if( $icon ){
        $output .= '<div class="icon" style="font-size: ' . esc_attr( $icon_size ) . 'px; line-height: ' . esc_attr( $icon_size ) . 'px;"><i class="' . $icon . '"></i></div>';
    }
    $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="masterstudy-custom-title">';
    $output .= $text;
    if( !empty( $subtitle ) && $stripe_pos != 'between' ){
        $output .= '<span class="subtitle"'. $subtitle_style .'>' . $subtitle . '</span>';
    }
    $output .= '</' . $font_container_data['values']['tag'] . '>';
    if( !empty( $subtitle ) && $stripe_pos == 'between' ){
        $output .= '<div class="subtitle"'. $subtitle_style .'>' . $subtitle . '</div>';
    }
    $output .= '</div>';
} else {
    $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="' . esc_attr( $css_class ) . '">';
    $output .= $text;
    $output .= '</' . $font_container_data['values']['tag'] . '>';
}

echo masterstudy_filtered_output($output);
