<?php

class AmberAlert_Ajax
{
    /**
     * Save a boolean value of whether to index comments on the next rebuild
     */
    /**
     *
     */
    public static function saveAmberSettings()
    {
        $settings = json_decode(file_get_contents("php://input"));

        if($settings)
        {
            AmberAlert_Utility::setOption(AMBER_ALERT_SETTINGS, $settings);
            $success = true;
        }
        else
        {
            $success = false;
        }

        die(json_encode(array('success' => true)));
    }
}