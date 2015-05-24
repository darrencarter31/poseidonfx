<?php
/*
Plugin Name: PoseidonFX Custom Functions - Private/Internal
Plugin URI: http://PoseidonFX.com
Description: A simple plugin that contains all the awesome PoseidonFX custom functions.
Author: Darren Carter
Author URI: http://PoseidonFX.com
Version: 0.1
*/
 
/** START ADDING CODE BELOW THIS LINE **/

	include( 'poseidon-shortcodes.php' );
	include( 'signals.php' );
//	wp_enqueue_style( 'poseidon-css', plugins_url . '/poseidonfx/poseidon.css' );

add_action('set_current_user', 'csstricks_hide_admin_bar');
function csstricks_hide_admin_bar() {
  if (!current_user_can('edit_posts')) {
    show_admin_bar(false);
  }
}

function poseidon_pre_actions()
{

	function my_function_admin_bar(){ return false; }
	add_filter( 'show_admin_bar' , 'my_function_admin_bar');
}

function poseidon_post_actions()
{
	add_action( 'save_post','poseidon_signal_check');

}

add_action('after_setup_theme', 'poseidon_post_actions');

/** STOP ADDING CODE NOW**/
 
?>