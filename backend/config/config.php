<?php

if (!include_once('config.inc.php')) {
    die('Configuration missing');
}

class Config {
    public static function get($key = null) {
        $key = explode('.', $key);
        $config = $GLOBALS['config'];

        foreach($key as $k) {
            if (isset($config[$k])) {
                $config = $config[$k];
            }
        }
        return $config;
    }

}