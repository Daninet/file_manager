<?php

class URLHandler {

	private $parameters;
	
	public function __construct() {

	}

	public function parse_path() { //TODO

        $path = array();
        //phpinfo();
        if(isset($_SERVER["PATH_INFO"])) {
        	$this->currentdir = $_SERVER["PATH_INFO"];
        	$this->currentdir = substr($this->currentdir, 1);
        }

        if($this->currentdir == '') 
        	$this->currentdir = '.';

        print_r($this->currentdir);

        return $path;
    }

    public static function site_url($path) {
    	$url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"].'/'.$path;
    	return $url;
    }

    public static function redirect($path) {
    	$url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"].'/'.$path;
    	header('Location: '.$newURL);
    	die();
    }



    public static function setOrder($orderColumn) {

    }

    public static function setPath($newPath) { //relative to the current directory

    }

    public static function setDelete($path) {

    }

    
    public static function unsetActions() {

    }



}