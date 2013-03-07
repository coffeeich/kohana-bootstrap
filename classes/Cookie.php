<?php defined('SYSPATH') OR die('No direct script access.');

class Cookie extends Kohana_Cookie {

    /**
     * Fast and easy way to accept configuration settings of cookies:
     *
     *      Cookie::init(Kohana::$config->load('cookie'));
     *
     * @param Config_Group $config
     */
    public static function init(Config_Group $config) {
        foreach ($config as $key => $value) {
            Cookie::${$key} = $value;
        }
    }

}
