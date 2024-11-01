<?php

/**
 * The plugin bootstrap file
 *
 * @package           whitelabel-wp
 * @author            Expertwolf
 * @license           GPL-2.0
 *
 * Plugin Name:       Whitelabel for Wordpress
 * Plugin URI:        https://github.com/sakthiwebdev/whitelabel-wp
 * Description:       Remove wordpress footprints from admin panel & login page.
 * Version:           1.0
 * Author:            Expertwolf
 * Author URI:        https://expertwolf.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       whitelabel-wp
**/
/*
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class whitelabel_wordpress
{	
	function __construct()
	{ 
    	add_action('admin_enqueue_scripts',array( $this,'enqueue_back_scripts_and_styles'));
    	add_action('login_enqueue_scripts',array( $this,'enqueue_login_scripts_and_styles'));
        add_filter('get_user_option_admin_color',array( $this,'set_default_admin_color'));
        add_action('admin_menu',array( $this,'disable_eventdashboard_widgets'));
    }
	
	//Adding JS/CSS in WP Admin Area
	function enqueue_back_scripts_and_styles()
	{
        wp_enqueue_style('ww_styles', plugins_url('/admin/custom.css', __FILE__));
        wp_enqueue_script('ww_script', plugins_url( '/admin/custom.js' , __FILE__ ), array('jquery','jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable'));
    }
	//Adding JS/CSS in Login Admin Area
	function enqueue_login_scripts_and_styles()
	{
        wp_enqueue_style('ww_styles', plugins_url('/login/custom.css', __FILE__));
        wp_enqueue_script('ww_script', plugins_url( '/login/custom.js' , __FILE__ ), array('jquery','jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable'));
    }
    //Setting Default Color Scheme
	function set_default_admin_color($scheme)
	{
	// set new default admin color scheme
	$scheme = 'midnight';
	// return the new default color
	return $scheme;
	}

	// Remove WP admin dashboard widgets
	function disable_eventdashboard_widgets() 
	{
    	remove_meta_box('dashboard_primary', 'dashboard', 'core');// Remove WordPress Events and News
	}
}

new whitelabel_wordpress();

//Remove Color Scheme Picker
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );