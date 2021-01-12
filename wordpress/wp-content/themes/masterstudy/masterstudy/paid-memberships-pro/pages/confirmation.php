<?php
global $wpdb, $current_user, $pmpro_invoice, $pmpro_msg, $pmpro_msgt;

if ($pmpro_msg) {
    ?>
    <div class="pmpro_message <?php echo esc_attr($pmpro_msgt); ?>"><?php echo wp_kses_post($pmpro_msg); ?></div>
    <?php
}

if (empty($current_user->membership_level)) {
    $confirmation_message = "<p>" . __('Your payment has been submitted. Your membership will be activated shortly.', 'masterstudy') . "</p>";
} else {
    $confirmation_message = "<h3>" . sprintf(__('Thank you for your membership to %s. Your %s membership is now active.', 'masterstudy'), get_bloginfo("name"), $current_user->membership_level->name) . "</h3>";
}

//confirmation message for this level
$level_message = $wpdb->get_var("SELECT l.confirmation FROM $wpdb->pmpro_membership_levels l LEFT JOIN $wpdb->pmpro_memberships_users mu ON l.id = mu.membership_id WHERE mu.status = 'active' AND mu.user_id = '" . $current_user->ID . "' LIMIT 1");
if (!empty($level_message))
    $confirmation_message .= "\n" . stripslashes($level_message) . "\n";
?>

<?php if (!empty($pmpro_invoice) && !empty($pmpro_invoice->id)) { ?>

    <?php
    $pmpro_invoice->getUser();
    $pmpro_invoice->getMembershipLevel();

    $confirmation_message .= "<p>" . sprintf(__('Below are details about your membership account and a receipt for your initial membership invoice. A welcome email with a copy of your initial membership invoice has been sent to %s.', 'masterstudy'), $pmpro_invoice->user->user_email) . "</p>";

    //check instructions
    if ($pmpro_invoice->gateway == "check" && !pmpro_isLevelFree($pmpro_invoice->membership_level))
        $confirmation_message .= wpautop(wp_unslash(pmpro_getOption("instructions")));

    /**
     * All devs to filter the confirmation message.
     * We also have a function in includes/filters.php that applies the the_content filters to this message.
     * @param string $confirmation_message The confirmation message.
     * @param object $pmpro_invoice The PMPro Invoice/Order object.
     */
    $confirmation_message = apply_filters("pmpro_confirmation_message", $confirmation_message, $pmpro_invoice);

    echo stm_lms_filtered_output($confirmation_message);
    ?>


    <h3>
        <?php printf(__('Invoice #%s on %s', 'masterstudy'), $pmpro_invoice->code, date_i18n(get_option('date_format'), $pmpro_invoice->timestamp)); ?>
    </h3>
    <a class="pmpro_a-print" href="javascript:window.print()"><?php _e('Print', 'masterstudy'); ?></a>
    <ul>
        <?php do_action("pmpro_invoice_bullets_top", $pmpro_invoice); ?>
        <li><strong><?php _e('Account', 'masterstudy'); ?>
                :</strong> <?php echo sanitize_text_field($current_user->display_name); ?>
            (<?php echo sanitize_text_field($current_user->user_email); ?>)
        </li>
        <li><strong><?php _e('Membership Level', 'masterstudy'); ?>
                :</strong> <?php echo sanitize_text_field($current_user->membership_level->name); ?></li>
        <?php if ($current_user->membership_level->enddate) { ?>
            <li><strong><?php _e('Membership Expires', 'masterstudy'); ?>
                    :</strong> <?php echo date_i18n(get_option('date_format'), $current_user->membership_level->enddate) ?>
            </li>
        <?php } ?>
        <?php if ($pmpro_invoice->getDiscountCode()) { ?>
            <li><strong><?php _e('Discount Code', 'masterstudy'); ?>
                    :</strong> <?php echo sanitize_text_field($pmpro_invoice->discount_code->code); ?></li>
        <?php } ?>
        <?php do_action("pmpro_invoice_bullets_bottom", $pmpro_invoice); ?>
    </ul>
    <hr/>
    <div class="pmpro_invoice_details">
        <?php if (!empty($pmpro_invoice->billing->name)) { ?>
            <div class="pmpro_invoice-billing-address">
                <strong><?php _e('Billing Address', 'masterstudy'); ?></strong>
                <p><?php echo sanitize_text_field($pmpro_invoice->billing->name); ?><br/>
                    <?php echo sanitize_text_field($pmpro_invoice->billing->street); ?><br/>
                    <?php if ($pmpro_invoice->billing->city && $pmpro_invoice->billing->state) { ?>
                        <?php echo sanitize_text_field($pmpro_invoice->billing->city); ?>, <?php echo sanitize_text_field($pmpro_invoice->billing->state); ?><?php echo sanitize_text_field($pmpro_invoice->billing->zip); ?><?php echo sanitize_text_field($pmpro_invoice->billing->country); ?>
                        <br/>
                    <?php } ?>
                    <?php echo formatPhone($pmpro_invoice->billing->phone) ?>
                </p>
            </div> <!-- end pmpro_invoice-billing-address -->
        <?php } ?>

        <?php if ($pmpro_invoice->accountnumber) { ?>
            <div class="pmpro_invoice-payment-method">
                <strong><?php _e('Payment Method', 'masterstudy'); ?></strong>
                <p><?php echo sanitize_text_field($pmpro_invoice->cardtype); ?><?php _e('ending in', 'masterstudy'); ?><?php echo last4($pmpro_invoice->accountnumber) ?></p>
                <p><?php _e('Expiration', 'masterstudy'); ?>
                    : <?php echo sanitize_text_field($pmpro_invoice->expirationmonth); ?>
                    /<?php echo sanitize_text_field($pmpro_invoice->expirationyear); ?></p>
            </div> <!-- end pmpro_invoice-payment-method -->
        <?php } elseif ($pmpro_invoice->payment_type) { ?>
            <?php echo sanitize_text_field($pmpro_invoice->payment_type); ?>
        <?php } ?>

        <div class="pmpro_invoice-total">
            <strong><?php _e('Total Billed', 'masterstudy'); ?></strong>
            <p><?php if ($pmpro_invoice->total != '0.00') { ?>
                    <?php if (!empty($pmpro_invoice->tax)) { ?>
                        <?php _e('Subtotal', 'masterstudy'); ?>: <?php echo pmpro_formatPrice($pmpro_invoice->subtotal); ?>
                        <br/>
                        <?php _e('Tax', 'masterstudy'); ?>: <?php echo pmpro_formatPrice($pmpro_invoice->tax); ?><br/>
                        <?php if (!empty($pmpro_invoice->couponamount)) { ?>
                            <?php _e('Coupon', 'masterstudy'); ?>: (<?php echo pmpro_formatPrice($pmpro_invoice->couponamount); ?>)
                            <br/>
                        <?php } ?>
                        <strong><?php _e('Total', 'masterstudy'); ?>
                            : <?php echo pmpro_formatPrice($pmpro_invoice->total); ?></strong>
                    <?php } else { ?>
                        <?php echo pmpro_formatPrice($pmpro_invoice->total); ?>
                    <?php } ?>
                <?php } else { ?>
                    <small class="pmpro_grey"><?php echo pmpro_formatPrice(0); ?></small>
                <?php } ?></p>
        </div> <!-- end pmpro_invoice-total -->

    </div> <!-- end pmpro_invoice -->
    <hr/>
    <?php
} else {
    $confirmation_message .= "<p>" . sprintf(__('Below are details about your membership account. A welcome email has been sent to %s.', 'masterstudy'), $current_user->user_email) . "</p>";

    /**
     * All devs to filter the confirmation message.
     * Documented above.
     * We also have a function in includes/filters.php that applies the the_content filters to this message.
     */
    $confirmation_message = apply_filters("pmpro_confirmation_message", $confirmation_message, false);

    echo stm_lms_filtered_output($confirmation_message);
    ?>
    <ul>
        <li>
            <strong><?php _e('Account', 'masterstudy'); ?>:</strong>
            <?php echo sanitize_text_field($current_user->display_name); ?>
            (<?php echo sanitize_text_field($current_user->user_email); ?>)
        </li>
        <li><strong><?php _e('Membership Level', 'masterstudy'); ?>:</strong>
            <?php if (!empty($current_user->membership_level)) echo sanitize_text_field($current_user->membership_level->name); else _e("Pending", 'masterstudy'); ?>
        </li>
    </ul>
    <?php
}
?>

<?php if (!empty($current_user->membership_level) and isset($_COOKIE['stm_lms_course_buy'])) {
    /*MS Redirect to course*/
    $course_id = intval($_COOKIE['stm_lms_course_buy']);
    if (get_post_type($course_id) === 'stm-courses') {
        stm_lms_register_script('buy/redirect_to_cookie', array('jquery.cookie'), true);
        ?>
        <br/>
        <h3><?php esc_html_e('Redirecting to course...', 'masterstudy'); ?></h3>
    <?php }

} else { ?>
    <nav id="nav-below" class="navigation" role="navigation">
        <div class="nav-next">
            <?php if (!empty($current_user->membership_level)) { ?>
                <a href="<?php echo esc_url(STM_LMS_User::user_page_url()); ?>"
                   class="btn btn-default"><?php _e('View Your Account', 'masterstudy'); ?></a>
            <?php } else { ?>
                <?php _e('If your account is not activated within a few minutes, please contact the site owner.', 'masterstudy'); ?>
            <?php } ?>
        </div>
    </nav>
<?php }