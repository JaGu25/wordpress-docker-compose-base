<?php
/**
 * @var $widget_width;
 * @var $label_value;
 * @var $value;
 */

$uniq_class = uniqid('radial-progress-');

if(empty($widget_width)) $widget_width = 150;

$widget_width_half = $widget_width / 2;
$inset_size = $widget_width - 10;
$mg_b = ($widget_width - $inset_size) / 2;

$styles = "
.{$uniq_class}.radial-progress, .{$uniq_class}.radial-progress .circle .fill, .{$uniq_class}.radial-progress .circle .mask {
    width : {$widget_width}px;
    height : {$widget_width}px;
}

.{$uniq_class}.radial-progress .inset {
    width : {$inset_size}px;
    height : {$inset_size}px;
    margin-left: {$mg_b}px;
    margin-top: {$mg_b}px;
}

.{$uniq_class}.radial-progress .circle .mask {
    clip: rect(0,{$widget_width}px,{$widget_width}px,{$widget_width_half}px);
}

.{$uniq_class}.radial-progress .circle .mask .fill {
    clip: rect(0,{$widget_width_half}px,{$widget_width}px,0);
}

";

echo '<style type="text/css">'.$styles.'</style>';

if(!empty($value)) : ?>


<div class="radial-progress <?php echo esc_attr($uniq_class); ?>" data-progress="<?php echo esc_attr($value); ?>">
    <div class="circle">
        <div class="mask full">
            <div class="fill"></div>
        </div>
        <div class="mask half">
            <div class="fill"></div>
            <div class="fill fix"></div>
        </div>
    </div>
    <div class="inset">
        <?php if(!empty($label_value)):
            if(!empty($units)) $label_value .= $units;
            ?>
            <h3><?php echo sanitize_text_field($label_value); ?></h3>
        <?php endif; ?>
        <?php if(!empty($title)):?>
            <h6><?php echo sanitize_text_field($title); ?></h6>
        <?php endif; ?>
    </div>
</div>

<?php endif; ?>
