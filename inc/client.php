<?php

function building_url() {

	$categories = get_the_category( );

	$cats = array();

	foreach ( $categories as $c ) {

		$cats[] = $c->term_id;

	}

	$url = add_query_arg( array(
		'filter[cat]' 			  => implode(",", $cats),
		'filter[posts_per_page]'  => 5
		), rest_url( 'wp/v2/posts') );

	return $url;
}

// Base HTML to be added to the bottom of a post
function display_baseline_html() {
	// Set up container etc
	$baseline  = '<section id="related-posts" class="related-posts">';
	$baseline .= '<a href="#" class="get-related-posts">Get related posts</a>';
 	$baseline .= '<div class="ajax-loader"><img src="' . plugin_dir_url( __FILE__ ) . '../css/spinner.svg" width="32" height="32" /></div>';
	$baseline .= '</section><!-- .related-posts -->';

	return $baseline;
}


// Bootstrap this whole thing onto the bottom of single posts
function display_in_post($content){
	if( is_single() && is_main_query() ) {
	    $content .= display_baseline_html();
	}
	return $content;
}
add_filter('the_content','display_in_post');

?>