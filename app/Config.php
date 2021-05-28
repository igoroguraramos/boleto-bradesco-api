<?php

namespace BradescoBoleto;

class Config{

    private static $config = [];

    /**
     * Get the value of config
     */ 
    public static function getConfig()
    {
        return self::$config;
    }

    /**
     * Set the value of config
     *
     * @return  self
     */ 
    public static function setConfig($config)
    {
        self::$config = $config;

        return self::$config;
    }
}