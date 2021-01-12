<?php
global $wpdb, $current_user, $pmpro_msg, $pmpro_msgt, $show_paypal_link;
global $bfirstname, $blastname, $baddress1, $baddress2, $bcity, $bstate, $bzipcode, $bcountry, $bphone, $bemail, $bconfirmemail, $CardType, $AccountNumber, $ExpirationMonth, $ExpirationYear;

/**
 * Filter to set if PMPro uses email or text as the type for email field inputs.
 *
 * @since 1.8.4.5
 *
 * @param bool $use_email_type , true to use email type, false to use text type
 */
$pmpro_email_field_type = apply_filters('pmpro_email_field_type', true);

$gateway = pmpro_getOption("gateway");

$level = $current_user->membership_level;


//Make sure the $level object is a valid level definition
if (isset($level->id) && !empty($level->id)) {
	?>
    <p><?php printf(__("Logged in as <strong>%s</strong>.", 'masterstudy'), $current_user->user_login); ?>
        <small>
            <a href="<?php echo wp_logout_url(home_url('/') . "/membership-checkout/?level=" . $level->id); ?>"><?php _e("logout", 'masterstudy'); ?></a>
        </small>
    </p>
	<?php
	/**
	 * pmpro_billing_message_top hook to add in general content to the billing page without using custom page templates.
	 *
	 * @since 1.9.2
	 */
	do_action('pmpro_billing_message_top'); ?>

    <ul>
		<?php
		/**
		 * pmpro_billing_bullets_top hook allows you to add information to the billing list (at the top).
		 *
		 * @since 1.9.2
		 * @param {objects} {$level} {Passes the $level object}
		 */
		do_action('pmpro_billing_bullets_top', $level); ?>
        <li><strong><?php _e("Level", 'masterstudy'); ?>:</strong> <?php echo sanitize_text_field($level->name); ?></li>
		<?php if ($level->billing_amount > 0) { ?>
            <li><strong><?php _e("Membership Fee", 'masterstudy'); ?>:</strong>
				<?php
				$level = $current_user->membership_level;
				if ($current_user->membership_level->cycle_number > 1) {
					printf(__('%s every %d %s.', 'masterstudy'), pmpro_formatPrice($level->billing_amount), $level->cycle_number, pmpro_translate_billing_period($level->cycle_period, $level->cycle_number));
				} elseif ($current_user->membership_level->cycle_number == 1) {
					printf(__('%s per %s.', 'masterstudy'), pmpro_formatPrice($level->billing_amount), pmpro_translate_billing_period($level->cycle_period));
				} else {
					echo pmpro_formatPrice($current_user->membership_level->billing_amount);
				}
				?>

            </li>
		<?php } ?>

		<?php if ($level->billing_limit) { ?>
            <li><strong><?php _e("Duration", 'masterstudy'); ?>
                    :</strong> <?php echo sanitize_text_field($level->billing_limit) . ' ' . sornot($level->cycle_period, $level->billing_limit) ?>
            </li>
		<?php } ?>
		<?php
		/**
		 * pmpro_billing_bullets_top hook allows you to add information to the billing list (at the bottom).
		 *
		 * @since 1.9.2
		 * @param {objects} {$level} {Passes the $level object}
		 */
		do_action('pmpro_billing_bullets_bottom', $level); ?>
    </ul>
	<?php
}
?>

<?php if (pmpro_isLevelRecurring($level)) { ?>
	<?php if ($show_paypal_link) { ?>

        <p><?php _e('Your payment subscription is managed by PayPal. Please login to PayPal to update your billing information.', 'masterstudy'); ?></p>
        <p><?php _e('Your payment subscription is managed by PayPal. Please login to PayPal to update your billing information.', 'masterstudy'); ?></p>

	<?php } else { ?>

        <form id="pmpro_form" class="pmpro_form" action="<?php echo pmpro_url("billing", "", "https") ?>" method="post">

            <input type="hidden" name="level" value="<?php echo esc_attr($level->id); ?>"/>
			<?php if ($pmpro_msg) {
				?>
                <div class="pmpro_message <?php echo esc_attr($pmpro_msgt); ?>"><?php echo wp_kses_post($pmpro_msg); ?></div>
				<?php
			}
			?>

			<?php
			$pmpro_include_billing_address_fields = apply_filters('pmpro_include_billing_address_fields', true);
			if ($pmpro_include_billing_address_fields) {
				?>
                <div id="pmpro_billing_address_fields" class="pmpro_checkout">
                    <hr/>
                    <h3>
                        <span class="pmpro_checkout-h3-name"><?php _e('Billing Address', 'masterstudy'); ?></span>
                    </h3>
                    <div class="pmpro_checkout-fields">
                        <div class="pmpro_checkout-field pmpro_checkout-field-bfirstname">
                            <label for="bfirstname"><?php _e('First Name', 'masterstudy'); ?></label>
                            <input id="bfirstname" name="bfirstname" type="text"
                                   class="input <?php echo pmpro_getClassForField("bfirstname"); ?>" size="30"
                                   value="<?php echo esc_attr($bfirstname); ?>"/>
                        </div> <!-- end pmpro_checkout-field-bfirstname -->
                        <div class="pmpro_checkout-field pmpro_checkout-field-blastname">
                            <label for="blastname"><?php _e('Last Name', 'masterstudy'); ?></label>
                            <input id="blastname" name="blastname" type="text"
                                   class="input <?php echo pmpro_getClassForField("blastname"); ?>" size="30"
                                   value="<?php echo esc_attr($blastname); ?>"/>
                        </div> <!-- end pmpro_checkout-field-blastname -->
                        <div class="pmpro_checkout-field pmpro_checkout-field-baddress1">
                            <label for="baddress1"><?php _e('Address 1', 'masterstudy'); ?></label>
                            <input id="baddress1" name="baddress1" type="text"
                                   class="input <?php echo pmpro_getClassForField("baddress1"); ?>" size="30"
                                   value="<?php echo esc_attr($baddress1); ?>"/>
                        </div> <!-- end pmpro_checkout-field-baddress1 -->
                        <div class="pmpro_checkout-field pmpro_checkout-field-baddress2">
                            <label for="baddress2"><?php _e('Address 2', 'masterstudy'); ?></label>
                            <input id="baddress2" name="baddress2" type="text"
                                   class="input <?php echo pmpro_getClassForField("baddress2"); ?>" size="30"
                                   value="<?php echo esc_attr($baddress2); ?>"/>
                            <small class="lite">(<?php _e('optional', 'masterstudy'); ?>)</small>
                        </div> <!-- end pmpro_checkout-field-baddress2 -->

						<?php
						$longform_address = apply_filters("pmpro_longform_address", false);
						if ($longform_address) {
							?>
                            <div class="pmpro_checkout-field pmpro_checkout-field-bcity">
                                <label for="bcity"><?php _e('City', 'masterstudy'); ?></label>
                                <input id="bcity" name="bcity" type="text"
                                       class="input <?php echo pmpro_getClassForField("bcity"); ?>" size="30"
                                       value="<?php echo esc_attr($bcity) ?>"/>
                            </div> <!-- end pmpro_checkout-field-bcity -->
                            <div class="pmpro_checkout-field pmpro_checkout-field-bstate">
                                <label for="bstate"><?php _e('State', 'masterstudy'); ?></label>
                                <input id="bstate" name="bstate" type="text"
                                       class="input <?php echo pmpro_getClassForField("bstate"); ?>" size="30"
                                       value="<?php echo esc_attr($bstate) ?>"/>
                            </div> <!-- end pmpro_checkout-field-bstate -->
                            <div class="pmpro_checkout-field pmpro_checkout-field-bzipcode">
                                <label for="bzipcode"><?php _e('Postal Code', 'masterstudy'); ?></label>
                                <input id="bzipcode" name="bzipcode" type="text"
                                       class="input <?php echo pmpro_getClassForField("bzipcode"); ?>" size="30"
                                       value="<?php echo esc_attr($bzipcode) ?>"/>
                            </div> <!-- end pmpro_checkout-field-bzipcode -->
							<?php
						} else {
							?>
                            <div class="pmpro_checkout-field pmpro_checkout-field-bcity_state_zip">
                                <label for="bcity_state_zip"><?php _e('City, State Zip', 'masterstudy'); ?></label>
                                <input id="bcity" name="bcity" type="text"
                                       class="input <?php echo pmpro_getClassForField("bcity"); ?>" size="14"
                                       value="<?php echo esc_attr($bcity) ?>"/>
								<?php
								$state_dropdowns = apply_filters("pmpro_state_dropdowns", false);
								if ($state_dropdowns === true || $state_dropdowns == "names") {
									global $pmpro_states;
									?>
                                    <select name="bstate" class="<?php echo pmpro_getClassForField("bstate"); ?>">
                                        <option value="">--</option>
										<?php
										foreach ($pmpro_states as $ab => $st) {
											?>
                                            <option value="<?php echo esc_attr($ab); ?>"
													<?php if ($ab == $bstate) { ?>selected="selected"<?php } ?>><?php echo sanitize_text_field($st); ?></option>
										<?php } ?>
                                    </select>
									<?php
								} elseif ($state_dropdowns == "abbreviations") {
									global $pmpro_states_abbreviations;
									?>
                                    <select name="bstate" class="<?php echo pmpro_getClassForField("bstate"); ?>">
                                        <option value="">--</option>
										<?php
										foreach ($pmpro_states_abbreviations as $ab) {
											?>
                                            <option value="<?php echo esc_attr($ab); ?>"
													<?php if ($ab == $bstate) { ?>selected="selected"<?php } ?>><?php echo sanitize_text_field($ab); ?></option>
										<?php } ?>
                                    </select>
									<?php
								} else {
									?>
                                    <input id="bstate" name="bstate" type="text"
                                           class="input <?php echo pmpro_getClassForField("bstate"); ?>" size="2"
                                           value="<?php echo esc_attr($bstate) ?>"/>
									<?php
								}
								?>
                                <input id="bzipcode" name="bzipcode" type="text"
                                       class="input <?php echo pmpro_getClassForField("bzipcode"); ?>" size="5"
                                       value="<?php echo esc_attr($bzipcode) ?>"/>
                            </div> <!-- end pmpro_checkout-field-bcity_state_zip -->
							<?php
						}
						?>

						<?php
						$show_country = apply_filters("pmpro_international_addresses", false);
						if ($show_country) {
							?>
                            <div class="pmpro_checkout-field pmpro_checkout-field-bcountry">
                                <label for="bcountry"><?php _e('Country', 'masterstudy'); ?></label>
                                <select name="bcountry" class="<?php echo pmpro_getClassForField("bcountry"); ?>">
									<?php
									global $pmpro_countries, $pmpro_default_country;
									foreach ($pmpro_countries as $abbr => $country) {
										if (!$bcountry)
											$bcountry = $pmpro_default_country;
										?>
                                        <option value="<?php echo esc_attr($abbr); ?>"
												<?php if ($abbr == $bcountry) { ?>selected="selected"<?php } ?>>
											<?php echo sanitize_text_field($country); ?>
                                        </option>
										<?php
									}
									?>
                                </select>
                            </div> <!-- end pmpro_checkout-field-bcountry -->
							<?php
						} else {
							?>
                            <input type="hidden" id="bcountry" name="bcountry" value="US"/>
							<?php
						}
						?>
                        <div class="pmpro_checkout-field pmpro_checkout-field-bphone">
                            <label for="bphone"><?php _e('Phone', 'masterstudy'); ?></label>
                            <input id="bphone" name="bphone" type="text"
                                   class="input <?php echo pmpro_getClassForField("bphone"); ?>" size="30"
                                   value="<?php echo esc_attr($bphone) ?>"/>
                        </div> <!-- end pmpro_checkout-field-bphone -->
						<?php if ($current_user->ID) { ?>
							<?php
							if (!$bemail && $current_user->user_email)
								$bemail = $current_user->user_email;
							if (!$bconfirmemail && $current_user->user_email)
								$bconfirmemail = $current_user->user_email;
							?>
                            <div class="pmpro_checkout-field pmpro_checkout-field-bemail">
                                <label for="bemail"><?php _e('E-mail Address', 'masterstudy'); ?></label>
                                <input id="bemail" name="bemail"
                                       type="<?php echo(esc_attr($pmpro_email_field_type) ? 'email' : 'text'); ?>"
                                       class="input <?php echo pmpro_getClassForField("bemail"); ?>" size="30"
                                       value="<?php echo esc_attr($bemail) ?>"/>
                            </div> <!-- end pmpro_checkout-field-bemail -->
                            <div class="pmpro_checkout-field pmpro_checkout-field-bconfirmemail">
                                <label for="bconfirmemail"><?php _e('Confirm E-mail', 'masterstudy'); ?></label>
                                <input id="bconfirmemail" name="bconfirmemail"
                                       type="<?php echo(esc_attr($pmpro_email_field_type) ? 'email' : 'text'); ?>"
                                       class="input <?php echo pmpro_getClassForField("bconfirmemail"); ?>" size="30"
                                       value="<?php echo esc_attr($bconfirmemail) ?>"/>
                            </div> <!-- end pmpro_checkout-field-bconfirmemail -->
						<?php } ?>
                    </div> <!-- end pmpro_checkout-fields -->
                </div> <!-- end pmpro_billing -->
			<?php } ?>

			<?php
			//make sure gateways will show up credit card fields
			global $pmpro_requirebilling;
			$pmpro_requirebilling = true;

			//do we need to show the payment information (credit card) fields? gateways will override this
			$pmpro_include_payment_information_fields = apply_filters('pmpro_include_payment_information_fields', true);
			if ($pmpro_include_payment_information_fields)
			{
			$pmpro_accepted_credit_cards = pmpro_getOption("accepted_credit_cards");
			$pmpro_accepted_credit_cards = explode(",", $pmpro_accepted_credit_cards);
			$pmpro_accepted_credit_cards_string = pmpro_implodeToEnglish($pmpro_accepted_credit_cards);
			?>
            <div id="pmpro_payment_information_fields" class="pmpro_checkout">
                <h3>
                    <span class="pmpro_checkout-h3-name"><?php _e('Credit Card Information', 'masterstudy'); ?></span>
                    <span class="pmpro_checkout-h3-msg"><?php printf(__('We accept %s', 'masterstudy'), $pmpro_accepted_credit_cards_string); ?></span>
                </h3>
				<?php $sslseal = pmpro_getOption("sslseal"); ?>
				<?php if (!empty($sslseal)) { ?>
                <div class="pmpro_checkout-fields-display-seal">
					<?php } ?>
                    <div class="pmpro_checkout-fields">
						<?php
						$pmpro_include_cardtype_field = apply_filters('pmpro_include_cardtype_field', false);
						if ($pmpro_include_cardtype_field) { ?>
                            <div class="pmpro_checkout-field pmpro_payment-card-type">
                                <label for="CardType"><?php _e('Card Type', 'masterstudy'); ?></label>
                                <select id="CardType" name="CardType"
                                        class="<?php echo pmpro_getClassForField("CardType"); ?>">
									<?php foreach ($pmpro_accepted_credit_cards as $cc) { ?>
                                        <option value="<?php echo esc_attr($cc); ?>"
												<?php if ($CardType == $cc) { ?>selected="selected"<?php } ?>><?php echo sanitize_text_field($cc); ?></option>
									<?php } ?>
                                </select>
                            </div> <!-- end pmpro_payment-card-type -->
						<?php } else { ?>
                        <input type="hidden" id="CardType" name="CardType" value="<?php echo esc_attr($CardType); ?>"/>
                            <script>
                                <!--
                                jQuery(document).ready(function () {
                                    jQuery('#AccountNumber').validateCreditCard(function (result) {
                                        var cardtypenames = {
                                            "amex": "American Express",
                                            "diners_club_carte_blanche": "Diners Club Carte Blanche",
                                            "diners_club_international": "Diners Club International",
                                            "discover": "Discover",
                                            "jcb": "JCB",
                                            "laser": "Laser",
                                            "maestro": "Maestro",
                                            "mastercard": "Mastercard",
                                            "visa": "Visa",
                                            "visa_electron": "Visa Electron"
                                        };

                                        if (result.card_type)
                                            jQuery('#CardType').val(cardtypenames[result.card_type.name]);
                                        else
                                            jQuery('#CardType').val('Unknown Card Type');
                                    });
                                });
                                -->
                            </script>
							<?php
						}
						?>
                        <div class="pmpro_checkout-field pmpro_payment-account-number">
                            <label for="AccountNumber"><?php _e('Card Number', 'masterstudy'); ?></label>
                            <input id="AccountNumber" name="AccountNumber"
                                   class="input <?php echo pmpro_getClassForField("AccountNumber"); ?>" type="text"
                                   size="25" value="<?php echo esc_attr($AccountNumber) ?>" autocomplete="off"/>
                        </div>
                        <div class="pmpro_checkout-field pmpro_payment-expiration">
                            <label for="ExpirationMonth"><?php _e('Expiration Date', 'masterstudy'); ?></label>
                            <select id="ExpirationMonth" name="ExpirationMonth">
                                <option value="01"
										<?php if ($ExpirationMonth == "01") { ?>selected="selected"<?php } ?>>01
                                </option>
                                <option value="02"
										<?php if ($ExpirationMonth == "02") { ?>selected="selected"<?php } ?>>02
                                </option>
                                <option value="03"
										<?php if ($ExpirationMonth == "03") { ?>selected="selected"<?php } ?>>03
                                </option>
                                <option value="04"
										<?php if ($ExpirationMonth == "04") { ?>selected="selected"<?php } ?>>04
                                </option>
                                <option value="05"
										<?php if ($ExpirationMonth == "05") { ?>selected="selected"<?php } ?>>05
                                </option>
                                <option value="06"
										<?php if ($ExpirationMonth == "06") { ?>selected="selected"<?php } ?>>06
                                </option>
                                <option value="07"
										<?php if ($ExpirationMonth == "07") { ?>selected="selected"<?php } ?>>07
                                </option>
                                <option value="08"
										<?php if ($ExpirationMonth == "08") { ?>selected="selected"<?php } ?>>08
                                </option>
                                <option value="09"
										<?php if ($ExpirationMonth == "09") { ?>selected="selected"<?php } ?>>09
                                </option>
                                <option value="10"
										<?php if ($ExpirationMonth == "10") { ?>selected="selected"<?php } ?>>10
                                </option>
                                <option value="11"
										<?php if ($ExpirationMonth == "11") { ?>selected="selected"<?php } ?>>11
                                </option>
                                <option value="12"
										<?php if ($ExpirationMonth == "12") { ?>selected="selected"<?php } ?>>12
                                </option>
                            </select>/<select id="ExpirationYear" name="ExpirationYear">
								<?php
								for ($i = date_i18n("Y"); $i < date_i18n("Y") + 10; $i++) {
									?>
                                    <option value="<?php echo esc_attr($i); ?>"
											<?php if ($ExpirationYear == $i) { ?>selected="selected"<?php } ?>><?php echo sanitize_text_field($i); ?></option>
									<?php
								}
								?>
                            </select>
                        </div>
						<?php
						$pmpro_show_cvv = apply_filters("pmpro_show_cvv", true);
						if ($pmpro_show_cvv) {
							if (true == ini_get('allow_url_include')) {
								$cvv_template = pmpro_loadTemplate('popup-cvv', 'url', 'pages', 'html');
							} else {
								$cvv_template = plugins_url('paid-memberships-pro/pages/popup-cvv.html', PMPRO_DIR);
							}
							?>
                            <div class="pmpro_checkout-field pmpro_payment-cvv">
                                <label for="CVV"><?php _e('CVV', 'masterstudy'); ?></label>
                                <input id="CVV" name="CVV" type="text" size="4"
                                       value="<?php if (!empty($_REQUEST['CVV'])) {
										   echo esc_attr($_REQUEST['CVV']);
									   } ?>" class="input <?php echo pmpro_getClassForField("CVV"); ?>"/>
                                <small>(<a href="javascript:void(0);"
                                           onclick="javascript:window.open('<?php echo pmpro_https_filter($cvv_template); ?>','cvv','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=475');"><?php _e("what's this?", 'masterstudy'); ?></a>)
                                </small>
                            </div>
						<?php } ?>
                    </div> <!-- end pmpro_checkout-fields -->
                </div> <!-- end pmpro_payment_information_fields -->
				<?php
				}
				?>

				<?php do_action("pmpro_billing_before_submit_button"); ?>

                <div class="stm_lms_billing_buttons">
                    <input type="hidden" name="update-billing" value="1"/>
                    <input type="submit" class="btn btn-default" value="<?php _e('Update', 'masterstudy'); ?>"/>
                    <input type="button" name="cancel" class="btn btn-default"
                           value="<?php _e('Cancel', 'masterstudy'); ?>"
                           onclick="location.href='<?php echo pmpro_url("account") ?>';"/>
                </div>
        </form>
        <script>
            <!--
            // Find ALL <form> tags on your page
            jQuery('form').submit(function () {
                // On submit disable its submit button
                jQuery('input[type=submit]', this).attr('disabled', 'disabled');
                jQuery('input[type=image]', this).attr('disabled', 'disabled');
            });
            -->
        </script>
	<?php } ?>
<?php } else { ?>
    <p><?php _e("This subscription is not recurring. So you don't need to update your billing information.", 'masterstudy'); ?></p>
<?php } ?>
