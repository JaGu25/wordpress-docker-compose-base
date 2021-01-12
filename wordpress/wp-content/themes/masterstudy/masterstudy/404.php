<?php get_header(); ?>

<div class="error_page">
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
		        <div class="heading_font">
		            <div class="error_404">404</div>
		            <div class="h2"><?php esc_html_e('The page you are looking for does not exist.', 'masterstudy'); ?></div>
		        </div>
		        <a href="/" class="btn btn-default"><?php esc_html_e('GO BACK TO HOMEPAGE', 'masterstudy') ?></a>
	        </div>
	    </div>
	</div>
</div>

<?php get_footer();?>