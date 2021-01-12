<ul id="groups-list" class="item-list">
    <?php while (bp_groups()) : bp_the_group();

    $group_status = bp_get_group_status();
    ?>

        <li>
            <div class="inner">
                <div class="item-avatar">
                    <a href="<?php bp_group_permalink() ?>"><?php bp_group_avatar('type=full&width=130&height=130') ?></a>
                </div>

                <div class="item">

                    <div class="item-title heading_font">
                        <a href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a>
                    </div>

                    <div class="type">
                        <?php bp_group_type() ?>
                    </div>

                    <div class="members">
                        <i class="lnricons-users2"></i>
                        <span><?php bp_group_member_count() ?></span>
                    </div>

                    <div class="item-meta">
                        <i class="lnricons-clock3"></i>
                        <span class="activity"><?php echo bp_get_group_last_active(); ?></span>
                    </div>

                    <?php do_action('bp_directory_groups_item') ?>

                    <?php if (is_user_logged_in() && $group_status !== 'hidden'): ?>
                        <?php bp_group_join_button(); ?>
                    <?php else : ?>
                        <div class="group-button public generic-button">
                            <a href="<?php echo esc_url(bp_get_group_permalink());  ?>"
                               class="group-button view-group">View Group</a></div>
                    <?php endif; ?>

                    <?php do_action('bp_directory_groups_actions') ?>

                </div>


            </div>

        </li>

    <?php endwhile; ?>
</ul>

<?php do_action('bp_after_groups_loop') ?>