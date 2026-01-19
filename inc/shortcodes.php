<?php

/**
 * Kumpulan shortcode yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


add_shortcode('velocity-posts', function($atts) {
    $atribut = shortcode_atts( array(
        'category_slug' 	=> '',
        'jumlah' 	=> 5,
    ), $atts );
	$args['category_name'] = $atribut['category_slug'];
	$args['showposts'] = $atribut['jumlah'];
	$posts = get_posts($args);
	$html = '';
	foreach($posts as $post) {
		$html .= '<div class="row mx-0 mb-2 pb-2 border-bottom">';
			$html .= '<div class="col-3 px-0">';
				if (function_exists('velocitychild_render_ratio_image')) {
					$html .= velocitychild_render_ratio_image($post->ID, 'ratio-1x1', true);
				} else {
					$html .= get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => 'w-100 h-auto'));
				}
			$html .= '</div>';
			$html .= '<div class="col-9 pe-0">';
				$html .= '<div class="mb-1">';
					$html .= '<a href="'.get_the_permalink($post->ID).'">'.$post->post_title.'</a>';
				$html .= '</div>';
				$html .= '<small>'.get_the_date('',$post->ID).'</small>';
			$html .= '</div>';
		$html .= '</div>';
	}
    return $html;
});
