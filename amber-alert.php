<?php
/**
 * Plugin Name: Amber Alerts for Wordpress
 * Plugin URI: http://www.streetfightmag.com/
 * Description: If an Amber Alert is issued for your state, let readers know on that particular day with an unobtrusive notice at the top of your site
 * Version: 0.0.1
 * Author: Kenny Katzgrau
 * Author URI: http://github.com/katzgrau
 * License: MIT
 */

require_once 'lib/Ajax.php';
require_once 'lib/AmberAlert.php';
require_once 'lib/Cache.php';
require_once 'lib/Utility.php';
require_once 'lib/View.php';
require_once 'lib/Widgets.php';

# Constants
define('AMBER_ALERT_SETTINGS', 'AmberAlert_Settings');

# Ajax hooks
add_action('wp_ajax_save_amber_settings', array('AmberAlert_Ajax', 'saveAmberSettings'));

function amberalert_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('amber-alert', AmberAlert_Utility::getJSBaseURL() . 'amber.js');
    wp_enqueue_style('amber-alert', AmberAlert_Utility::getCSSBaseURL() . 'amber.css');
}

add_action('wp_enqueue_scripts', 'amberalert_scripts');

/**
 * A callback executed whenever the user tried to access the Broadstreet admin.css page
 */
function amberalert_menu()
{
    if(strstr($_SERVER['QUERY_STRING'], 'amber')) {
        wp_enqueue_script('angular-js', '//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.js');
        wp_enqueue_script('isteven-multi-js', AmberAlert_Utility::getJSBaseURL() . 'isteven-multi-select.js');
        wp_enqueue_style('isteven-multi-css', AmberAlert_Utility::getCSSBaseURL() . 'isteven-multi-select.css');
        wp_enqueue_style('amber-admin-css', AmberAlert_Utility::getCSSBaseURL() . 'admin.css');
    }

    add_options_page('Amber Alerts', 'Amber Alerts', 'edit_pages', 'amber-alert.php', 'amberalert_admin');
}

add_action('admin_menu', 'amberalert_menu');

function amberalert_admin()
{
    $data = array(
        'settings' => AmberAlert_Utility::getAmberAlertSettings()
    );

    AmberAlert_View::load('admin', $data);
}
