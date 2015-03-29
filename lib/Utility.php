<?php

class AmberAlert_Utility
{
    public static function getAmberAlertSettings() {
        $defaults = array (
            'state' => 'NJ',
            'show_ribbon' => true,
            'hold_for' => 1
        );

        $settings = self::getOption(AMBER_ALERT_SETTINGS, array());
        $settings = (array)$settings;

        return (object)array_merge($defaults, $settings);
    }

    /**
     * Sets a Wordpress option
     * @param string $name The name of the option to set
     * @param string $value The value of the option to set
     */
    public static function setOption($name, $value)
    {
        if (get_option($name) !== FALSE)
        {
            update_option($name, $value);
        }
        else
        {
            $deprecated = ' ';
            $autoload   = 'no';
            add_option($name, $value, $deprecated, $autoload);
        }
    }

    /**
     * Gets a Wordpress option
     * @param string    $name The name of the option
     * @param mixed     $default The default value to return if one doesn't exist
     * @return string   The value if the option does exist
     */
    public static function getOption($name, $default = FALSE)
    {
        $value = get_option($name);
        if( $value !== FALSE ) return $value;
        return $default;
    }

    /**
     * Get a value from an associative array. The specified key may or may
     *  not exist.
     * @param array $array Array to grab the value from
     * @param mixed $key The key to check the array
     * @param mixed $default A value to return if the key doesn't exist int he array (default is FALSE)
     * @return mixed The value if the key exists, and the default if it doesn't
     */
    public static function arrayGet($array, $key, $default = FALSE)
    {
        if(array_key_exists($key, $array))
            return $array[$key];
        else
            return $default;
    }

    /**
     * Get the site's base URL
     * @return string
     */
    public static function getSiteBaseURL()
    {
        return get_bloginfo('url');
    }

    /**
     * Get the base URL of the plugin installation
     * @return string the base URL
     */
    public static function getAmberBaseURL()
    {
        return (WP_PLUGIN_URL . '/amber-alert/');
    }

    /**
     * Get the base URL for plugin images
     * @return string
     */
    public static function getImageBaseURL()
    {
        return self::getAmberBaseURL() . 'public/img/';
    }

    /**
     * Get the base url for plugin CSS
     * @return string
     */
    public static function getCSSBaseURL()
    {
        return self::getAmberBaseURL() . 'public/css/';
    }

    /**
     * Get the base URL for plugin javascript
     * @return string
     */
    public static function getJSBaseURL()
    {
        return self::getAmberBaseURL() . 'public/js/';
    }

    /**
     * Get the base URL for plugin javascript
     * @return string
     */
    public static function getVendorBaseURL()
    {
        return self::getAmberBaseURL() . 'public/vendor/';
    }
}