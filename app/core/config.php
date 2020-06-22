<?php
namespace app\core;

final class config {
	
	private static $db_config = array(
		"dbhost" => "",
		"dbuser" => "",
		"dbpass" => "",
		"db" => ""
	);
	
	private static $recaptchav2_config = array(
		"recaptcha_secret_key" => "",
		"recaptcha_public_key" => ""
	);
	
	private static $singltone = null;
	
	public static function getInstance($config_name) { 
		if (static::$singltone === null) {
			$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/' . $config_name);
			
			static::$db_config = array(
				"dbhost" => $config["dbhost"],
				"dbuser" => $config["dbuser"],
				"dbpass" => $config["dbpass"],
				"db" => $config["db"]
			);
			
			static::$recaptchav2_config = array(
				"recaptcha_secret_key" => $config["recaptcha_secret_key"],
				"recaptcha_public_key" => $config["recaptcha_public_key"]
			);
			
            static::$singltone = new static();
        }

        return static::$singltone;
    }
	
	public static function get_db_data() {
		return self::$db_config;
	}
	
	public static function get_recaptcha_data() {
		return self::$recaptchav2_config;
	}
	
	//prevent creating another instance
	private function __construct() {
    }

    private function __clone() {
    }

    
    private function __wakeup() {
    }
}