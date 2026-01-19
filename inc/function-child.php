<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);
add_action('customize_register', 'velocitychild_customize_register', 20);

function velocitychild_theme_setup()
{

	// Load justg_child_enqueue_parent_style after theme setup
	add_action('wp_enqueue_scripts', 'justg_child_enqueue_parent_style', 20);

	//remove action from Parent Theme
	remove_action('justg_header', 'justg_header_menu');
	remove_action('justg_do_footer', 'justg_the_footer_open');
	remove_action('justg_do_footer', 'justg_the_footer_content');
	remove_action('justg_do_footer', 'justg_the_footer_close');
	remove_theme_support('widgets-block-editor');
}

function velocitychild_get_category_choices()
{
	$choices = array(
		0 => esc_html__('Show All', 'justg'),
	);

	$categories = get_categories(
		array(
			'orderby'    => 'name',
			'hide_empty' => false,
		)
	);

	foreach ($categories as $category) {
		$choices[$category->term_id] = $category->name;
	}

	return $choices;
}

function velocitychild_customize_register($wp_customize)
{
	$wp_customize->add_panel(
		'panel_velocity',
		array(
			'priority'    => 10,
			'title'       => esc_html__('Velocity Theme', 'justg'),
			'description' => esc_html__('', 'justg'),
		)
	);

	$title_section = $wp_customize->get_section('title_tagline');
	if ($title_section) {
		$title_section->panel    = 'panel_velocity';
		$title_section->title    = esc_html__('Site Identity', 'justg');
		$title_section->priority = 10;
	} else {
		$wp_customize->add_section(
			'title_tagline',
			array(
				'panel'    => 'panel_velocity',
				'title'    => esc_html__('Site Identity', 'justg'),
				'priority' => 10,
			)
		);
	}

	$wp_customize->add_setting(
		'running_text',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'running_text',
		array(
			'type'    => 'text',
			'label'   => esc_html__('Running Text', 'justg'),
			'section' => 'title_tagline',
		)
	);

	$wp_customize->add_section(
		'panel_social_media',
		array(
			'panel'    => 'panel_velocity',
			'title'    => esc_html__('Social Media', 'justg'),
			'priority' => 11,
		)
	);

	$social_fields = array(
		'facebook_url'  => esc_html__('Facebook', 'justg'),
		'x_url'         => esc_html__('X / Twitter', 'justg'),
		'instagram_url' => esc_html__('Instagram', 'justg'),
		'youtube_url'   => esc_html__('Youtube', 'justg'),
	);
	foreach ($social_fields as $setting_id => $label) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'type'        => 'url',
				'label'       => $label,
				'section'     => 'panel_social_media',
				'description' => sprintf(esc_html__('%s URL', 'justg'), $label),
			)
		);
	}

	$wp_customize->add_section(
		'section_homebanner',
		array(
			'panel'    => 'panel_velocity',
			'title'    => esc_html__('Home Banner', 'justg'),
			'priority' => 12,
		)
	);
	$wp_customize->add_setting(
		'home_banner',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'home_banner',
			array(
				'label'   => esc_html__('Banner Image', 'justg'),
				'section' => 'section_homebanner',
			)
		)
	);
	$wp_customize->add_setting(
		'home_banner_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_banner_title',
		array(
			'type'    => 'text',
			'label'   => esc_html__('Title', 'justg'),
			'section' => 'section_homebanner',
		)
	);
	$wp_customize->add_setting(
		'home_banner_subtitle',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_banner_subtitle',
		array(
			'type'    => 'text',
			'label'   => esc_html__('Subtitle', 'justg'),
			'section' => 'section_homebanner',
		)
	);

	$category_choices = velocitychild_get_category_choices();

	$wp_customize->add_setting(
		'headline_post',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'headline_post',
		array(
			'type'    => 'select',
			'label'   => esc_html__('Headline Post', 'justg'),
			'section' => 'section_homebanner',
			'choices' => $category_choices,
		)
	);

	$wp_customize->add_section(
		'section_homenews',
		array(
			'panel'    => 'panel_velocity',
			'title'    => esc_html__('Home News', 'justg'),
			'priority' => 12,
		)
	);
	for ($x = 1; $x <= 6; $x++) {
		$setting_id = 'news' . $x;
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'type'    => 'select',
				'label'   => esc_html__('News ' . $x, 'justg'),
				'section' => 'section_homenews',
				'choices' => $category_choices,
			)
		);
	}

	$wp_customize->remove_panel('global_panel');
	$wp_customize->remove_panel('panel_header');
	$wp_customize->remove_panel('panel_footer');
	$wp_customize->remove_panel('panel_antispam');
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_section('header_image');
}


///remove breadcrumbs
add_action('wp_head', function () {
	remove_action('justg_before_title', 'justg_breadcrumb');
});

if (!function_exists('justg_header_open')) {
	function justg_header_open()
	{
		echo '<header id="wrapper-header">';
		echo '<div id="wrapper-navbar" class="px-2" itemscope itemtype="http://schema.org/WebSite">';
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

function velocitychild_get_post_image_url($post_id)
{
	if (!$post_id) {
		return '';
	}

	$url = get_the_post_thumbnail_url($post_id, 'full');
	if (!$url) {
		$attachments = get_posts(
			array(
				'post_type'      => 'attachment',
				'posts_per_page' => 1,
				'post_parent'    => $post_id,
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);
		if (!empty($attachments[0]->ID)) {
			$url = wp_get_attachment_url($attachments[0]->ID, 'full');
		}
	}

	return $url ? esc_url($url) : '';
}

function velocitychild_render_ratio_image($post_id, $ratio_class, $linked = true)
{
	$ratio_class = $ratio_class ? $ratio_class : 'ratio-16x9';
	$image_url = velocitychild_get_post_image_url($post_id);
	if (!$image_url) {
		$image_url = esc_url(get_stylesheet_directory_uri() . '/img/no-image.webp');
	}

	$media = '<div class="ratio ' . esc_attr($ratio_class) . '">';
	if ($image_url) {
		$media .= '<img src="' . $image_url . '" class="w-100 h-100 object-fit-cover" alt="">';
	} else {
		$media .= '<div class="w-100 h-100 bg-light"></div>';
	}
	$media .= '</div>';

	if ($linked && $post_id) {
		$media = '<a class="d-block" href="' . get_the_permalink($post_id) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . $media . '</a>';
	}

	return $media;
}

function velocitychild_render_ratio_image_with_title($post_id, $ratio_class)
{
	$ratio_class = $ratio_class ? $ratio_class : 'ratio-1x1';
	$image_url = velocitychild_get_post_image_url($post_id);
	if (!$image_url) {
		$image_url = esc_url(get_stylesheet_directory_uri() . '/img/no-image.webp');
	}
	$title = $post_id ? get_the_title($post_id) : '';

	$html  = '<a class="vd-gallery-item d-block position-relative" href="' . esc_url(get_the_permalink($post_id)) . '" title="' . esc_attr($title) . '">';
	$html .= '<div class="ratio ' . esc_attr($ratio_class) . '">';
	$html .= '<img src="' . $image_url . '" class="w-100 h-100 object-fit-cover" alt="' . esc_attr($title) . '">';
	$html .= '</div>';
	$html .= '<span class="vd-gallery-title">' . esc_html($title) . '</span>';
	$html .= '</a>';

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
			$html .= velocitychild_render_ratio_image($post->ID, 'ratio-16x9', true);
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
				$html .= velocitychild_render_ratio_image($post->ID, 'ratio-1x1', true);
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
				$html .= velocitychild_render_ratio_image_with_title($post->ID, 'ratio-1x1');
			$html .= '</div>';
		}
	$html .= '</div>';
	return $html;
}
