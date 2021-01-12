        <?php do_action('masterstudy_before_footer'); ?>

		<footer id="footer">
			<div class="footer_wrapper">
				<?php get_template_part('partials/footers/footer', 'top'); ?>
				<?php get_template_part('partials/footers/footer', 'bottom'); ?>
				<?php get_template_part('partials/footers/copyright'); ?>
			</div>
		</footer>

        <?php do_action('masterstudy_after_footer'); ?>

	<?php wp_footer(); ?>
	</body>
</html>