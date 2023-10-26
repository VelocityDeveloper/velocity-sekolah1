<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{

	// Load justg_child_enqueue_parent_style after theme setup
	add_action('wp_enqueue_scripts', 'justg_child_enqueue_parent_style', 20);

	if (class_exists('Kirki')) :

		$args = array(
			'orderby' => 'name',
			'hide_empty' => false,
		);
		$cats = array(
			'' => 'Show All'
		);
		$categories = get_categories($args);
		foreach ($categories as $category) {
			$kategori[$category->term_id] = $category->name;
		}

		Kirki::add_panel('panel_velocity', [
			'priority'    => 10,
			'title'       => esc_html__('Velocity Theme', 'justg'),
			'description' => esc_html__('', 'justg'),
		]);

		// section title_tagline
		Kirki::add_section('title_tagline', [
			'panel'    => 'panel_velocity',
			'title'    => __('Site Identity', 'justg'),
			'priority' => 10,
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'text',
			'settings'    => 'running_text',
			'label'       => __('Running Text', 'kirki'),
			'section'     => 'title_tagline',
		]);

		// Section Social Media
		Kirki::add_section('panel_social_media', [
			'panel'    => 'panel_velocity',
			'title'    => __('Social Media', 'justg'),
			'priority' => 11,
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'url',
			'settings'    => 'facebook_url',
			'label'       => __('Facebook', 'kirki'),
			'section'     => 'panel_social_media',
			'description' => esc_html__('Facebook URL', 'kirki'),
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'url',
			'settings'    => 'x_url',
			'label'       => __('X / Twitter', 'kirki'),
			'section'     => 'panel_social_media',
			'description' => esc_html__('X / Twitter URL', 'kirki'),
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'url',
			'settings'    => 'instagram_url',
			'label'       => __('Instagram', 'kirki'),
			'section'     => 'panel_social_media',
			'description' => esc_html__('Instagram URL', 'kirki'),
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'url',
			'settings'    => 'youtube_url',
			'label'       => __('Youtube', 'kirki'),
			'section'     => 'panel_social_media',
			'description' => esc_html__('Youtube URL', 'kirki'),
		]);


		///Section Color
		Kirki::add_section('section_colorvelocity', [
			'panel'    => 'panel_velocity',
			'title'    => __('Color & Background', 'justg'),
			'priority' => 10,
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'color',
			'settings'    => 'color_theme',
			'label'       => __('Theme Color', 'kirki'),
			'description' => esc_html__('', 'kirki'),
			'section'     => 'section_colorvelocity',
			'default'     => '#176cb7',
			'transport'   => 'auto',
			'output'      => [
				[
					'element'   => ':root',
					'property'  => '--color-theme',
				],
				[
					'element'   => ':root',
					'property'  => '--bs-primary',
				],
				[
					'element'   => '.border-color-theme',
					'property'  => '--bs-border-color',
				]
			],
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'background',
			'settings'    => 'background_themewebsite',
			'label'       => __('Website Background', 'kirki'),
			'description' => esc_html__('', 'kirki'),
			'section'     => 'section_colorvelocity',
			'default'     => [
				'background-color'      => '#F5F5F5',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'cover',
				'background-attachment' => 'scroll',
			],
			'transport'   => 'auto',
			'output'      => [
				[
					'element'   => ':root[data-bs-theme=light] body',
				],
				[
					'element'   => 'body',
				],
			],
		]);


		// section Home Banner
		Kirki::add_section('section_homebanner', [
			'panel'    => 'panel_velocity',
			'title'    => __('Home Banner', 'justg'),
			'priority' => 12,
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'image',
			'settings'    => 'home_banner',
			'label'       => __('Banner Image', 'kirki'),
			'section'     => 'section_homebanner',
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'text',
			'settings'    => 'home_banner_title',
			'label'       => __('Tittle', 'kirki'),
			'section'     => 'section_homebanner',
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'text',
			'settings'    => 'home_banner_subtitle',
			'label'       => __('Sub Tittle', 'kirki'),
			'section'     => 'section_homebanner',
		]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'headline_post',
            'label'     => esc_html__('Headline Post', 'kirki'),
            'section'   => 'section_homebanner',
            'default'   => '',
            'placeholder' => esc_html__('Select Category', 'kirki'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => $kategori,
        ]);


		
		// section Home Banner
		Kirki::add_section('section_homenews', [
			'panel'    => 'panel_velocity',
			'title'    => __('Home News', 'justg'),
			'priority' => 12,
		]);
		for ($x = 1; $x <= 6; $x++) {
			Kirki::add_field('justg_config', [
				'type'  => 'select',
				'settings'  => 'news'.$x,
				'label'     => esc_html__('News '.$x, 'kirki'),
				'section'   => 'section_homenews',
				'default'   => '',
				'placeholder' => esc_html__('Select Category', 'kirki'),
				'priority'  => 10,
				'multiple'  => 1,
				'choices'   => $kategori,
			]);
		}

		// remove panel in customizer 
		Kirki::remove_panel('global_panel');
		Kirki::remove_panel('panel_header');
		Kirki::remove_panel('panel_footer');
		Kirki::remove_panel('panel_antispam');
		Kirki::remove_control('display_header_text');
		Kirki::remove_section('header_image');

	endif;

	//remove action from Parent Theme
	remove_action('justg_header', 'justg_header_menu');
	remove_action('justg_do_footer', 'justg_the_footer_open');
	remove_action('justg_do_footer', 'justg_the_footer_content');
	remove_action('justg_do_footer', 'justg_the_footer_close');
	remove_theme_support('widgets-block-editor');
}


///remove breadcrumbs
add_action('wp_head', function () {
	if (!is_single()) {
		remove_action('justg_before_title', 'justg_breadcrumb');
	}
});

if (!function_exists('justg_header_open')) {
	function justg_header_open()
	{
		echo '<header id="wrapper-header">';
		echo '<div id="wrapper-navbar" class="px-2 px-md-0" itemscope itemtype="http://schema.org/WebSite">';
	}
}
if (!function_exists('justg_header_close')) {
	function justg_header_close()
	{
		echo '</div>';
		echo '</header>';
	}
}


///add action builder part
add_action('justg_header', 'justg_header_berita');
function justg_header_berita()
{
	require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
	require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}
add_action('justg_before_wrapper_content', 'justg_before_wrapper_content');
function justg_before_wrapper_content()
{
	echo '<div class="px-2">';
	echo '<div class="card rounded-0 border-light border-0 shadow px-2 container">';
}
add_action('justg_after_wrapper_content', 'justg_after_wrapper_content');
function justg_after_wrapper_content()
{
	echo '</div>';
	echo '</div>';
}

add_action('wp_footer', 'velocity_tour1_footer');
function velocity_tour1_footer()
{ ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<?php
}


// excerpt more
if ( ! function_exists( 'velocity_custom_excerpt_more' ) ) {
	function velocity_custom_excerpt_more( $more ) {
		return '...';
	}
}
add_filter( 'excerpt_more', 'velocity_custom_excerpt_more' );

// excerpt length
function velocity_excerpt_length($length){
	return 40;
}
add_filter('excerpt_length','velocity_excerpt_length');


//register widget
add_action('widgets_init', 'justg_widgets_init', 20);
if (!function_exists('justg_widgets_init')) {
	function justg_widgets_init()
	{
		register_sidebar(
			array(
				'name'          => __('Main Sidebar', 'justg'),
				'id'            => 'main-sidebar',
				'description'   => __('Main sidebar widget area', 'justg'),
				'before_widget' => '<aside id="%1$s" class="p-3 widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title fs-6 fw-bold text-uppercase text-end"><span>',
				'after_title'   => '</span></h3>',
				'show_in_rest'   => false,
			)
		);
		$before_widget = '<aside id="%1$s" class="widget %2$s">';
		$after_widget = '</aside>';
		$before_title = '<h3 class="widget-title text-white border-bottom text-uppercase pb-3 mb-3"><span>';
		$after_title = '</span></h3>';
		for($x = 1; $x <= 3; $x++){
			register_sidebar(
				array(
					'name'          => __('Footer '.$x, 'justg'),
					'id'            => 'footer-'.$x,
					'description'   => __('Footer sidebar widget area', 'justg'),
					'before_widget' => $before_widget,
					'after_widget'  => $after_widget,
					'before_title'  => $before_title,
					'after_title'   => $after_title,
					'show_in_rest'   => false,
				)
			);
		}
	}
}


if (!function_exists('justg_right_sidebar_check')) {
	function justg_right_sidebar_check()
	{
		if (is_singular('fl-builder-template')) {
			return;
		}
		if (!is_active_sidebar('main-sidebar')) {
			return;
		}
		echo '<div class="widget-area right-sidebar pt-3 pt-md-0 ps-md-3 ps-0 pe-0 col-md-4 order-3" id="right-sidebar" role="complementary">';
		do_action('justg_before_main_sidebar');
		dynamic_sidebar('main-sidebar');
		do_action('justg_after_main_sidebar');
		echo '</div>';
	}
}


// Tanggal Umum
function velocity_date() {
	$day = date('N');
	$tgl = date('j');
	$month = date('n');
	$year = date('Y');
	$hari = array(1 => 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
	$html = $hari[$day].', '.$tgl.'/'.$month.'/'.$year;
	return $html;
}

// get category name
function velocity_category_name($option_name){
	if($option_name){
		$cat_id = velocitytheme_option($option_name,'');
		$html = get_cat_name($cat_id);
	} else {
		$html = 'News';
	}
	return $html;
}


// get first post
function velocity_first_post($option_name){
	$cat = velocitytheme_option($option_name,'');
	$args['cat'] = $cat;
	$args['showposts'] = 1;
	$posts = get_posts($args);
	$html = '';
	//$html .= '<pre>'.print_r($args,1).'</pre>';
	foreach($posts as $post) {
		$html .= '<div class="mb-2">';
			$html .= do_shortcode('[resize-thumbnail width="400" height="250" linked="true" post_id="'.$post->ID.'"]');
		$html .= '</div>';
		$html .= '<a class="text-dark fw-bold d-block fs-6 mb-1" href="'.get_the_permalink($post->ID).'">'.$post->post_title.'</a>';
		$html .= '<small class="text-muted d-block mb-1">'.get_the_date('',$post->ID).'</small>';
		$html .= '<div class="text-muted">'.wp_trim_words($post->post_content,20).'</div>';
	}
	return $html;
}


// get posts
function velocity_recent_posts($option_name, array $args = null){
	$cat = velocitytheme_option($option_name,'');
	if($cat){
		$args['cat'] = $cat;
	} if(empty($args['showposts'])){
		$args['showposts'] = 4;
	}
	$posts = get_posts($args);
	$html = '';
	//$html .= '<pre>'.print_r($args,1).'</pre>';
	foreach($posts as $post) {
		$html .= '<div class="row mx-0 mb-2 pb-2 border-bottom">';
			$html .= '<div class="col-3 px-0">';
				$html .= do_shortcode('[resize-thumbnail width="150" height="150" linked="true" post_id="'.$post->ID.'"]');
			$html .= '</div>';
			$html .= '<div class="col-9 pe-0">';
				$html .= '<div class="mb-1">';
					$html .= '<a class="text-dark" href="'.get_the_permalink($post->ID).'">'.$post->post_title.'</a>';
				$html .= '</div>';
				$html .= '<small class="text-muted">'.get_the_date('',$post->ID).'</small>';
			$html .= '</div>';
		$html .= '</div>';
	}
	return $html;
}



// get posts gallery style
function velocity_gallery_posts($option_name, array $args = null){
	$cat = velocitytheme_option($option_name,'');
	if($cat){
		$args['cat'] = $cat;
	} if(empty($args['showposts'])){
		$args['showposts'] = 8;
	}
	$posts = get_posts($args);
	$html = '';
	$html .= '<div class="row m-0">';
		foreach($posts as $post) {
			$html .= '<div class="col-md-3 col-6 p-0">';
				$html .= do_shortcode('[resize-thumbnail width="250" height="250" linked="true" post_id="'.$post->ID.'"]');
			$html .= '</div>';
		}
	$html .= '</div>';
	return $html;
}