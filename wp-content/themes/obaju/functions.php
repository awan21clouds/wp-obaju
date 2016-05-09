<?php
	add_theme_support('post-thumbnails');

	function b2w_theme_styles(){
		wp_enqueue_style('bootstrap_css', get_template_directory_uri().'/css/bootstrap.min.css');
		wp_enqueue_style('animate_css', get_template_directory_uri().'/css/animate.min.css');		
		wp_enqueue_style('owl_carousel_css', get_template_directory_uri().'/css/owl.carousel.css');
		wp_enqueue_style('owl_theme_css', get_template_directory_uri().'/css/owl.theme.css');		
		wp_enqueue_style('style_css', get_template_directory_uri().'/style.css');		
	}

	add_action('wp_enqueue_scripts', 'b2w_theme_styles');

	function b2w_theme_js(){
		wp_enqueue_script('bootstrap_js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '', true);
		wp_enqueue_script('jquery_cookie_js', get_template_directory_uri().'/js/jquery.cookie.js', array('jquery'), '', true);				
		wp_enqueue_script('waypoints_js', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), '', true);	
		wp_enqueue_script('modernizr_js', get_template_directory_uri().'/js/modernizr.js', array('jquery'), '', true);								
		wp_enqueue_script('bootstrap_hover_dropdown_js', get_template_directory_uri().'/js/bootstrap-hover-dropdown.js', array('jquery'), '', true);
		wp_enqueue_script('owl_carousel_js', get_template_directory_uri().'/js/owl.carousel.min.js', array('jquery'), '', true);
		wp_enqueue_script('front_js', get_template_directory_uri().'/js/front.js', array('jquery'), '', true);						
		wp_enqueue_script('respond_js', get_template_directory_uri().'/js/respond.min.js', array('jquery'), '', true);				
		wp_enqueue_script('gmap_js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false');							
		wp_enqueue_script('gmap_init_js', get_template_directory_uri().'/js/gmap.init.js', array('jquery'), '', true);				
	}

	add_action('wp_enqueue_scripts', 'b2w_theme_js');

	function get_top_parent_page_id() { 
		global $post; 

		if ($post->ancestors) { 
			return end($post->ancestors); 
		} else { 
			return $post->ID; 
		} 
	}
?>