<?php
/**
 * Theme functions.
 *
 * @package Postali Child
 * @author Postali LLC
 */
	require_once dirname( __FILE__ ) . '/includes/admin.php';
	require_once dirname( __FILE__ ) . '/includes/utility.php';
	require_once dirname( __FILE__ ) . '/includes/case-results-cpt.php'; // Custom Post Type Case Results
	require_once dirname( __FILE__ ) . '/includes/testimonials-cpt.php'; // Custom Post Type Testimonials
    //require_once dirname( __FILE__ ) . '/includes/media-mentions-cpt.php'; // Custom Post Type Media Mentions
	require_once dirname( __FILE__ ) . '/includes/attorneys-cpt.php'; // Custom Post Type Attorneys
	//require_once dirname( __FILE__ ) . '/includes/social-share.php'; // Social Media Sharing


	add_action('wp_enqueue_scripts', 'postali_parent');
	function postali_parent() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/css/styles.css' ); // Enqueue parent theme styles
	
	}  

	add_action('wp_enqueue_scripts', 'postali_child');
	function postali_child() {

		wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/style.css' ); // Enqueue Child theme style sheet (theme info)
		wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/styles.css'); // Enqueue child theme styles.css
		//wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css'); // Enqueue child theme styles.css
		
		wp_register_style( 'google-fonts', '', array() );
		wp_enqueue_style('google-fonts');

		// Compiled .js using Grunt.js
		wp_register_script('custom-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js',array('jquery'), null, true); 
		wp_enqueue_script('custom-scripts');

        //icomoon
		wp_enqueue_style( 'icomoon', 'https://cdn.icomoon.io/152819/KurzmanEisenberg/style.css?nzjl6r'); // Enqueue child theme styles.css

		if ( is_page_template( 'front-page.php' ) ) {

            // Home Page Javascript
            wp_register_script('home-js', get_stylesheet_directory_uri() . '/assets/js/home.min.js', array('jquery'));
            wp_enqueue_script('home-js');		
            wp_register_script('cookies', get_stylesheet_directory_uri() . '/assets/js/src/cookies.js', array('jquery'));
            wp_enqueue_script('cookies');	
            wp_register_script('rellax-js', get_stylesheet_directory_uri() . '/assets/js/rellax.min.js', array('jquery'));
            wp_enqueue_script('rellax-js');		
            wp_register_script('slick-slider', get_stylesheet_directory_uri() . '/assets/js/slick.min.js',array('jquery'), null, true); 
            wp_enqueue_script('slick-slider');
            wp_register_script('slick-custom', get_stylesheet_directory_uri() . '/assets/js/slick-custom.min.js',array('jquery'), null, true); 
            wp_enqueue_script('slick-custom');
            wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/assets/css/slick.css'); // Enqueue child theme styles.css
		}

        if ( is_page_template( 'page-practice-parent.php' ) || is_single()) {

            wp_register_script('rellax-js', get_stylesheet_directory_uri() . '/assets/js/rellax.min.js', array('jquery'));
            wp_enqueue_script('rellax-js');		

        }

        if ( is_post_type_archive( 'attorneys' ) || is_page_template( 'page-practice-parent.php' ) ) {

            wp_register_script('smooth-scroll-min', get_stylesheet_directory_uri() . '/assets/js/smooth-scroll.min.js', array('jquery'));
            wp_enqueue_script('smooth-scroll-min');
            wp_register_script('smooth-scroll-custom', get_stylesheet_directory_uri() . '/assets/js/smooth-scroll-custom.min.js', array('jquery'));
            wp_enqueue_script('smooth-scroll-custom');
        }

		// These scripts should be conditionally enqueued only on page templates where they are needed

		// Smooth Scroll
		// wp_register_script('smooth-scroll', get_stylesheet_directory_uri() . '/assets/js/smooth-scroll.min.js', array('jquery'));
		// wp_enqueue_script('smooth-scroll');
		// wp_register_script('smooth-scroll-settings', get_stylesheet_directory_uri() . '/assets/js/smooth-scroll-settings.min.js', array('jquery'));
		// wp_enqueue_script('smooth-scroll-settings');

        // Fitvids
        //wp_register_script('fitvids', get_stylesheet_directory_uri() . '/assets/js/fitvids.min.js',array('jquery'), null, true); 
		//wp_enqueue_script('fitvids');

		// Featherlight JS Call 
		// wp_register_script('featherlight-js', get_stylesheet_directory_uri() . '/assets/js/featherlight.min.js', array('jquery'));
		// wp_enqueue_script('featherlight-js');

	}

	// Register Site Navigations
	function postali_child_register_nav_menus() {
		register_nav_menus(
			array(
                'header-nav' => __( 'Header Navigation', 'postali' ),
				'footer-nav' => __( 'Footer Navigation', 'postali' ),
                'footer-practice' => __( 'Footer Practice Areas', 'postali' ),
			)
		);
	}
	add_action( 'init', 'postali_child_register_nav_menus' );

	// Add Custom Logo Support
	add_theme_support( 'custom-logo' );

	function postali_custom_logo_setup() {
		$defaults = array(
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		);
		add_theme_support( 'custom-logo', $defaults );
	}
	add_action( 'after_setup_theme', 'postali_custom_logo_setup' );

	// ACF Options Pages
	if( function_exists('acf_add_options_page') ) {
		
		acf_add_options_page(array(
			'page_title'    => 'Instructions',
			'menu_title'    => 'Instructions',
			'menu_slug'     => 'theme-instructions',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-smiley', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

		acf_add_options_page(array(
			'page_title'    => 'Customizations',
			'menu_title'    => 'Customizations',
			'menu_slug'     => 'customizations',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-admin-customizer', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

		acf_add_options_page(array(
			'page_title'    => 'Awards',
			'menu_title'    => 'Awards',
			'menu_slug'     => 'awards',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-awards', // Add this line and replace the second inverted commas with class of the icon you like
			'redirect'      => false
		));

        acf_add_options_page(array(
			'page_title'    => 'Global Schema',
			'menu_title'    => 'Global Schema',
			'menu_slug'     => 'global_schema',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-media-code',
			'redirect'      => false
		));

	}

	// Save newly created fields to child theme
	add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
	function my_acf_json_save_point( $path ) {
		
		// update path
		$path = get_stylesheet_directory() . '/acf-json';
		
		// return
		return $path;
	
	}

    function enable_vcard_upload( $mime_types ){
        $mime_types['vcf'] = 'text/vcard';
        return $mime_types;
        }
        add_filter('upload_mimes', 'enable_vcard_upload' );
	
	// Add ability to add SVG to Wordpress Media Library
	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
	
	//add SVG to allowed file uploads
	function add_file_types_to_uploads($file_types){

		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );

		return $file_types;
	}
	add_action('upload_mimes', 'add_file_types_to_uploads');


	// Widget Logic Conditionals
	function is_child($parent) {
		global $post;
			return $post->post_parent == $parent;
		}
		
		// Widget Logic Conditionals (ancestor) 
		function is_tree( $pid ) {
		global $post;
		
		if ( is_page($pid) )
		return true;
		
		$anc = get_post_ancestors( $post->ID );
		foreach ( $anc as $ancestor ) {
			if( is_page() && $ancestor == $pid ) {
				return true;
				}
		}
		return false;
	}

	// Display Current Year as shortcode - [year]
	function year_shortcode () {
		$year = date_i18n ('Y');
		return $year;
		}
	add_shortcode ('year', 'year_shortcode');
	
	// WP Backend Menu area taller
	add_action('admin_head', 'taller_menus');

	function taller_menus() {
	echo '<style>
		.posttypediv div.tabs-panel {
			max-height:500px !important;
		}
	</style>';
	}

	// Customize the logo on the wp-login.php page
	function my_login_logo() { ?>
		<style type="text/css">
			#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png);
			height:45px;
			width:204px;
			background-size: 204px 45px;
			background-repeat: no-repeat;
			padding-bottom: 30px;
			}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );
	// Contact Form 7 Submission Page Redirect
	add_action( 'wp_footer', 'mycustom_wp_footer' );
	
	function mycustom_wp_footer() {
	?>
	<script type="text/javascript">
	document.addEventListener( 'wpcf7mailsent', function( event ) {
		location = '/form-success/';
	}, false );
	</script>
	<?php
	}

    // Add live attorney search to Top Nav
    add_filter( 'wp_nav_menu_items', 'live_attorney_search', 10, 2 );
    function live_attorney_search ( $items, $args ) {
        if ( $args->theme_location == 'header-nav') { // Specify the theme location if needed
            $items = '
            <li id="menu-item-search" class="menu-item menu-item-type-post_type menu-item-object-page">
            <a href="/our-attorneys/">Our Attorneys</a>
                <ul class="sub-menu">
                    <p>Find An Attorney By Name</p>
                    <div class="searchandfilter">
                        <div class="SF_container">
                            <input class="search_box_nav" placeholder="Type here ...">
                            <ul id ="results_nav"></ul>
                        </div>
                    </div>
                </ul>
            </li>
            ' . $items; // Prepend the new item
        }
        return $items;
    }

	// Add template column to page list in wp-admin
	function page_column_views( $defaults ) {
		$defaults['page-layout'] = __('Template');
		return $defaults;
	}
	add_filter( 'manage_pages_columns', 'page_column_views' );

	function page_custom_column_views( $column_name, $id ) {
		if ( $column_name === 'page-layout' ) {
			$set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
			if ( $set_template == 'default' ) {
				echo 'Default';
			}
			$templates = get_page_templates();
			ksort( $templates );
			foreach ( array_keys( $templates ) as $template ) :
				if ( $set_template == $templates[$template] ) echo $template;
			endforeach;
		}
	}
	add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );

    // custom practice areas taxonomy for pages
    add_action( 'init', 'pages_tax' );
    function pages_tax() {
        register_taxonomy(
            'practice_areas',
            'page',
            array(
                'label' => __( 'Practice Areas' ),
                'rewrite' => array( 'slug' => 'practice_areas' ),
                'hierarchical' => true,
            )
        );
    }

    // code blocks to make ajax work on attorneys

    function attorneys_load_more_scripts() {
        if (is_post_type_archive('attorneys')) {
            wp_register_script( 'loadmore_script_attorneys', get_stylesheet_directory_uri() . '/assets/js/src/attorneys-ajax-script.js', array('jquery') );
            wp_localize_script( 'loadmore_script_attorneys', 'loadmore_params_attorneys', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
            ) );
        
            wp_enqueue_script( 'loadmore_script_attorneys' );
        }
    }
    
    add_action( 'wp_enqueue_scripts','attorneys_load_more_scripts' );

    function attorneys_loadmore_ajax_handler(){
        $cat = (isset($_POST["id"])) ? $_POST["id"] : 'all';
        $fixed_cat = str_replace('-', '_', $cat);    
        $chair = 'sub_categories_'. $fixed_cat .'_chair';

        $args_chair = [
            'post_type' => 'attorneys',
            'post_status' => 'publish',
            'tax_query' => array(
                array (
                    'taxonomy' => 'practice_areas',
                    'field' => 'slug',
                    'terms' => esc_html($cat),
                )
            ),
            'meta_key'		=> $chair,
            'meta_value'	=> '"yes"',
            'meta_compare'	=> 'LIKE',
            'posts_per_page' => -1,
        ];

        $get_chair = new WP_Query( $args_chair );
        if( $get_chair->have_posts() ) :
        while( $get_chair->have_posts() ): $get_chair->the_post();     
        ?>

            <div class="column-25">        
                <div class="attorney-headshot">
                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                <?php endif; ?>
                </div>
                <div class="attorney-details">
                    <h3><?php the_title(); ?></h2>
                    <p class="caps spaced serif"><?php the_field('title'); ?> <?php if (get_field($chair)) { ?> | Chair <?php } ?></p>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="arrowed-link"> <p>Read Bio</p> <span class="icon-right-arrow"></span></a>       
                </div>         
            </div>

        <?php endwhile;
        endif;

        $post_ids = wp_list_pluck( $get_chair->posts, 'ID' );

        $args_others = [
            'post_type' => 'attorneys',
            'post_status' => 'publish',
            'tax_query' => array(
                array (
                    'taxonomy' => 'practice_areas',
                    'field' => 'slug',
                    'terms' => esc_html($cat),
                )
            ),
            'post__not_in' => $post_ids,
            'posts_per_page' => -1,
        ];

        $get_others = new WP_Query( $args_others );
        if( $get_others->have_posts() ) :
        while( $get_others->have_posts() ): $get_others->the_post(); ?>

            <div class="column-25">        
                <div class="attorney-headshot">
                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                <?php endif; ?>
                </div>
                <div class="attorney-details">
                    <h3><?php the_title(); ?></h2>
                    <p class="caps spaced serif"><?php the_field('title'); ?></p>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="arrowed-link"> <p>Read Bio</p> <span class="icon-right-arrow"></span></a>       
                </div>   
            </div>

        <?php endwhile;
        endif;

        die;
        wp_reset_postdata();

    }

    add_action('wp_ajax_loadmore_attorneys','attorneys_loadmore_ajax_handler');
    add_action('wp_ajax_nopriv_loadmore_attorneys','attorneys_loadmore_ajax_handler');

    function include_custom_post_types_in_search($query) {
        if ($query->is_search() && $query->is_main_query()) {
            $custom_post_types = array('attorneys');

            $query->set('post_type', array_merge(array('post', 'page'), $custom_post_types));
        }
    }
    add_action('pre_get_posts', 'include_custom_post_types_in_search');
        
?>