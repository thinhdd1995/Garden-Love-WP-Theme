<?php 

/**
@khai bao hang gia tri
	@ THEME_URL = lay duong dan thu muc theme 
	@ CORE = lay duong dan cua thu muc /core
**/
define('THEME_URL', get_stylesheet_directory() );
define('CORE', THEME_URL . "/core");


/**
 Nhung file /core/init.php
**/
require_once( CORE . "/init.php");
// Register custom navigation walker
require_once(CORE . "/wp-bootstrap-navwalker.php");

/**
 @ thiet lap chieu rong noi dung
**/
if ( !isset($content_width) ) {
	$content_width = 660 ;
}

/**
 @ khai bao chuc nang cua theme
 */
if (!function_exists('finazi_theme_setup')){
	function finazi_theme_setup(){

		/* thiet lap textdomain */
		$language_folder = THEME_URL . '/languages';
		load_theme_textdomain( 'finazi', $language_folder );

		/* tu dong them link rss len <head>*/
		add_theme_support('automatic-feed-links');

		/* them post thumbnail*/
		add_theme_support( 'post-thumbnails' );

		/* post format */
		add_theme_support( 'post-formats' , array(
				'image',
				'video',
				'gallery',
				'quote',
				'link'
			));

		/* them title tag */
		add_theme_support( 'title-tag');
		//
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		/* them custom background */
		$default_background = array(
			'default-color' => '#fff'
		);
		add_theme_support('custom-background', $default_background);
		add_theme_support( 'customize-selective-refresh-widgets' );
		/* them menu */
		register_nav_menus( array(
			'primary-menu' => __( 'Primary Menu', 'finazi' ),
		) );

		/* Creat sidebar */
		$sidebar = array(
			'name' => __('Main Sidebar' , 'finazi'),
			'id' => 'main-sidebar',
			'description' => 'Main sidebar for Finazi theme',
			'class' => 'main-sidebar' ,
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		);
		register_sidebar ($sidebar);
	}	
	add_action( 'init', 'finazi_theme_setup');
}
//register about sidebar 
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'about Sidebar',
		'id' => 'about-sidebar',
		'description' => 'Sidebar for About page',
		'class' => 'about-sidebar' ,
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
}

// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');

/*
TEMPLATE FUNCTION
 */



/*===========nhúng file ==========*/
function finazi_style(){
	wp_register_style( 'main-style', get_template_directory_uri() . "/layout/css/main.css", 'all' );
	wp_enqueue_style('main-style');
	wp_register_script('jquery-3.2.1-script', get_template_directory_uri() . "/layout/js/jquery-3.2.1.min.js");
	wp_enqueue_script('jquery-3.2.1-script');
	wp_register_script('setting-script', get_template_directory_uri() . "/layout/js/setting.js");
	wp_enqueue_script('setting-script');
	
	

	//ion-icon
	wp_register_style( 'font-awsome-style', get_template_directory_uri() . "/layout/css/ionicons.css", 'all' );
	wp_enqueue_style('font-awsome-style');
	wp_enqueue_script('font-awsome-script');

	// bootstrap
	wp_register_style( 'bootstrap-style', get_template_directory_uri() . "/layout/css/bootstrap.css", 'all' );
	wp_enqueue_style('bootstrap-style');
	wp_register_script('bootstrap-script', get_template_directory_uri() . "/layout/js/bootstrap.min.js" , array('jquery'));
	wp_enqueue_script('bootstrap-script');
	
}
add_action('wp_enqueue_scripts','finazi_style');


function wpb_add_google_fonts() {

	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Josefin+Sans|Montserrat|Open+Sans', false );
}
 
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );










