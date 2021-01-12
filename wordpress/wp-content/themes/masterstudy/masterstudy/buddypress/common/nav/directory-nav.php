<?php
/**
 * BP Nouveau Component's directory nav template.
 *
 * @since 3.0.0
 * @version 3.0.0
 */
?>

<nav class="<?php bp_nouveau_directory_type_navs_class(); ?>" role="navigation" aria-label="<?php esc_attr_e( 'Directory menu', 'masterstudy' ); ?>">

	<?php if ( bp_nouveau_has_nav( array( 'object' => 'directory' ) ) ) : ?>

		<ul class="component-navigation <?php bp_nouveau_directory_list_class(); ?>">

			<?php
			while ( bp_nouveau_nav_items() ) :
				bp_nouveau_nav_item();
			?>

				<li id="<?php bp_nouveau_nav_id(); ?>" class="<?php bp_nouveau_nav_classes(); ?>" <?php bp_nouveau_nav_scope(); ?> data-bp-object="<?php bp_nouveau_directory_nav_object(); ?>">
					<a href="<?php bp_nouveau_nav_link(); ?>">
						<?php bp_nouveau_nav_link_text(); ?>

						<?php if ( bp_nouveau_nav_has_count() ) : ?>
							<span class="count"><?php bp_nouveau_nav_count(); ?></span>
						<?php endif; ?>
					</a>
				</li>

                <?php if(bp_current_component() === 'members'):
                $result = count_users();
                $instructors = (!empty($result['avail_roles']) and !empty($result['avail_roles']['stm_lms_instructor'])) ? $result['avail_roles']['stm_lms_instructor'] : 0;

                ?>
                    <li id="instructors-all" class="unselected" data-bp-scope="instructors" data-bp-object="members">
                        <a href="/instructors/#instructors-all">
                            <?php esc_html_e('Instructors', 'masterstudy'); ?>
                            <span class="count"><?php echo esc_attr($instructors) ?></span>
                        </a>
                    </li>
                <?php endif; ?>

			<?php endwhile; ?>

		</ul><!-- .component-navigation -->

	<?php endif; ?>

</nav><!-- .bp-navs -->
