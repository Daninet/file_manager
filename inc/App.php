<?php

namespace QCFileManager;

//singleton pattern
class App
{
    
    public $currentdir = '';
    public $filelist = array();
    
    public static function getInstance() {
        static $instance = null;
        if (null === $instance) {
            $instance = new static ();
            $instance->parse_path();


        }
        
        return $instance;
    }
    
    protected function __construct() {
    	
    }
    
    private function __clone() {
    }
    
    private function __wakeup() {
    }
    
    public function listFiles() {

        $files = scandir($this->currentdir);
        print_r($files);
        foreach ($files as $file) {

        	$file = $this->currentdir.'/'.$file;

            if (is_dir($file)) {
                $this->filelist[] = new Directory($file);
            } else $this->filelist[] = new File($file);
        }
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

}