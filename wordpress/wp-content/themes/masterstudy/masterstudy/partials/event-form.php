<div class="modal fade" id="event_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="popup_title">
                <?php _e( 'Sign up for event', 'masterstudy' ); ?>
                <div class="close_popup" data-dismiss="modal"><i class="fa fa-times"></i></div>
            </div>
            <div class="popup_content">
                <form method="post" action="<?php echo esc_url( home_url() ); ?>" class="event_popup_form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="event_name"><?php _e( 'Name', 'masterstudy' ); ?> *</label>
                                <input type="text" name="event[name]" class="form-control" id="event_name" value="" />
                            </div>
                            <div class="form-group">
                                <label for="event_phone"><?php _e( 'Phone', 'masterstudy' ); ?> *</label>
                                <input type="text" name="event[phone]" class="form-control" id="event_phone" value="" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="event_email"><?php _e( 'E-mail', 'masterstudy' ); ?> *</label>
                                <input type="text" name="event[email]" class="form-control" id="event_email" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="event_message"><?php _e( 'Message', 'masterstudy' ); ?> *</label>
                        <textarea id="event_message" class="form-control" name="event[message]"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <div class="loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
                        <button type="submit" class="button"><?php _e( 'Sign Up', 'masterstudy' ); ?></button>
                        <input type="hidden" name="action" value="event_sign_up" />
                        <input type="hidden" name="event[event_id]" value="<?php the_ID(); ?>" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>