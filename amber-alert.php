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

function amberalert_footer() {
    $settings = AmberAlert_Utility::getAmberAlertSettings();
    $alert = AmberAlert_Utility::getTodaysAlert();

    if($alert && $settings->show_ribbon):
?>
    <script>window.amber_alert = <?php echo json_encode($alert) ?></script>
    <script type="text/template" id="amber-alert-template">
        <div class="amber-alert">
            <div class="amber-title">Amber Alert</div>
            <div class="amber-info">
                <table width="100%">
                    <tr>
                        <td style="width:150px;"><img src="{{photo}}" style="width: 150px;" alt="Amber Alert: {{firstName}} {{lastName}}" /></td>
                        <td style="width: calc(100% - 150px);">
                            <table style="width:100%;" class="table-data">
                                <tr>
                                    <td>
                                        Missing Since: {{missingDate}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Name: Katie Anderson
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        From: Red Bank, Monmouth Country, NJ
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Height: 5' 5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Skin: Caucasian
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Skin: Caucasian
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Description: Katie was last seen leaving Trader Joe's
                                        in Shrewsbury NJ.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Contact if Found: Paterson Police Department (New Jersey) 1-973-321-1111
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=#<?php echo urlencode('http://www.missingkids.com/poster/NCMC/1244151/1') ?>">Please share on Facebook</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </script>
<?php
    endif;
}

add_action('wp_footer', 'amberalert_footer');
