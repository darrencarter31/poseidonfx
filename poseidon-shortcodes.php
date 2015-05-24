<?php
/* ---------------------------------------------------------------------- */
/*	Custom Shortcodes
/* ---------------------------------------------------------------------- */
function pos_performance(){
	$id = 5739; // you need to know the post ID
	$post_object = get_post($id); // retrieves post object
	return "zzz"; // echoes post_content

}
add_shortcode( 'performance', 'pos_performance' );
function pos_recenttrades(){
	$id = 6544; // you need to know the post ID
	$post_object = get_post($id); // retrieves post object
	return $post_object->post_content; // echoes post_content
}
add_shortcode( 'recenttrades', 'pos_recenttrades' );
?>