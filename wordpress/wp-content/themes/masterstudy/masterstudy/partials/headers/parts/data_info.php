<?php
$top_bar_address = stm_option('top_bar_address');
$top_bar_address_mobile = stm_option('top_bar_address_mobile');

$top_bar_working_hours = stm_option('top_bar_working_hours');
$top_bar_working_hours_mobile = stm_option('top_bar_working_hours_mobile');

$top_bar_phone = stm_option('top_bar_phone');
$top_bar_phone_mobile = stm_option('top_bar_phone_mobile');

if ($top_bar_address || $top_bar_working_hours || $top_bar_phone): ?>
	<div class="pull-right xs-pull-left">
		<ul class="top_bar_info clearfix">
			<?php if ($top_bar_working_hours) { ?>
				<li <?php if (!$top_bar_working_hours_mobile){ ?>class="hidden-info"<?php } ?>>
                    <i class="far fa-clock"></i> <?php printf(_x('%s', 'Top bar Working hours', 'masterstudy'), $top_bar_working_hours); ?>
				</li>
			<?php } ?>
			<?php if ($top_bar_address) { ?>
				<li <?php if (!$top_bar_address_mobile){ ?>class="hidden-info"<?php } ?>>
                    <i class="fa fa-map-marker-alt"></i> <?php printf(_x('%s', 'Top bar address', 'masterstudy'), $top_bar_address); ?>
				</li>
			<?php } ?>
			<?php if ($top_bar_phone) { ?>
				<li <?php if (!$top_bar_phone_mobile){ ?>class="hidden-info"<?php } ?>>
                    <i class="fa fa-phone"></i> <?php printf(_x('%s', 'Top bar phone', 'masterstudy'), $top_bar_phone); ?>
                </li>
			<?php } ?>
		</ul>
	</div>
<?php endif; ?>