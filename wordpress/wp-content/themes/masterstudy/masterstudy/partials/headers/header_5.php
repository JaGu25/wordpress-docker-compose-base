<div class="container">
    <div class="row">
	    <div class="col-md-3 col-sm-12 col-xs-12">
		    <div class="logo-unit">
                <?php get_template_part('partials/headers/parts/logo'); ?>
		    </div>
		    
	        <!-- Navbar toggle MOBILE -->
		    <button type="button" class="navbar-toggle collapsed hidden-lg hidden-md" data-toggle="collapse" data-target="#header_menu_toggler">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
	    </div> <!-- md-3 -->
	    

	    <!-- MObile menu -->
	    <div class="col-xs-12 col-sm-12 visible-xs visible-sm">
		    <div class="collapse navbar-collapse header-menu-mobile" id="header_menu_toggler">
			    <ul class="header-menu clearfix">
				    <?php
                        wp_nav_menu( array(
                                'theme_location'    => 'primary',
                                'depth'             => 3,
                                'container'         => false,
                                'menu_class'        => 'header-menu clearfix',
                                'items_wrap'        => '%3$s',
                                'fallback_cb' => false
                            )
                        );
                    ?>
                    <li>
                    	<form role="search" method="get" id="searchform-mobile" action="<?php echo( home_url( '/' ) ); ?>">
						    <div class="search-wrapper">
						        <input placeholder="<?php esc_attr_e('Search...', 'masterstudy'); ?>" type="text" class="form-control search-input" value="<?php echo get_search_query(); ?>" name="s" />
						        <button type="submit" class="search-submit" ><i class="fa fa-search"></i></button>
						    </div>
						</form>
                    </li>
			    </ul>
		    </div>
	    </div>
	    
	    <!-- Desktop menu -->
	    <div class="col-md-9 col-sm-9 col-sm-offset-0 hidden-xs hidden-sm">
			<?php get_template_part('partials/headers/parts/menu'); ?>
	    </div><!-- md-8 desk menu -->
	    
    </div> <!-- row -->
</div> <!-- container -->