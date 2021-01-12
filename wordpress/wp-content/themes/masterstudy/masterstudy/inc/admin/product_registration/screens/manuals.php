<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} ?>
<div class="wrap about-wrap stm-admin-wrap  stm-admin-plugins-screen">
	<?php stm_get_admin_tabs('manuals'); ?>

	<?php
    $manuals = array(
        'https://www.youtube.com/embed/wGtDvLkVvaQ?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/a8zb5KTAw48?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/xen5oWdO9CE?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/MUIE0gbs8QY?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/p3_zQbWTlEE?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/8WQf7LnS4Sk?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/enASM22U3JY?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/HCQHA9IrVWw?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/XCAXxaBnz54?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/KgIUHEGOMOI?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/FgAVhdBuT90?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/WH7ghByG2vw?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/kxp_gjwHH-k?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/frw7rdgBe2w?wmode=opaque&theme=dark&showinfo=0',
        'https://www.youtube.com/embed/1CvuxLAjFW0?wmode=opaque&theme=dark&showinfo=0'
    );
    echo '<div style="display: flex; flex-wrap: wrap; margin: 0 -15px;">';
    foreach($manuals as $manual){
        echo '<iframe src="' . esc_url($manual) . '" height="300" frameborder="0" allowfullscreen style="padding: 0 15px; width: 50%; flex: 0 0 50%; box-sizing: border-box; margin-bottom: 30px;"></iframe>';
    }
    echo '</div>';
	?>
</div>
