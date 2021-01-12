<?php global $stm_option; ?>
<div class="pull-right">
    <div class="header_top_bar_socs">
        <ul class="clearfix">
            <?php
            if( !empty( $stm_option[ 'top_bar_use_social' ] ) ) {
                foreach( $stm_option[ 'top_bar_use_social' ] as $key => $val ) {
                    if( !empty( $stm_option[ $key ] ) && $val == 1 ) {
                        $icon = ($key === 'youtube-play') ? 'youtube-square' : $key;
                        echo "<li><a href='{$stm_option[$key]}'><i class='fab fa-{$icon}'></i></a></li>";
                    }
                }
            }
            ?>
        </ul>
    </div>
</div>