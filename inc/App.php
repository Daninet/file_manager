<?php

namespace QCFileManager;

//singleton pattern
class App
{
    
    public $currentpath = '';

    public $filelist = array();
    public $currentfile = null;
    
    public static function getInstance() {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();

            if(is_dir($instance->currentpath))
                $instance->listFiles();
            else
                $instance->currentfile = new File($instance->currentpath);
        }
        
        return $instance;
    }
    
    protected function __construct() {
    	
    }
    
    private function __clone() {
    }
    
    private function __wakeup() {
    }

    private function handleAction() {

        if($this->currentfile !== null && isset($_POST['delete']) ) {

            $this->currentfile->delete();
            URLHandler::redirect('..');

        }

        if($this->currentfile !== null && isset($_POST['rename'])) {

            $this->currentfile->rename($_POST['rename']);
            URLHandler::redirect('.');
            
        }

        



    }

    
    private function listFiles() {



        $files = scandir($this->currentpath);
        print_r($files);
        foreach ($files as $file) {

        	$file = $this->currentpath.'/'.$file;

            if (is_dir($file)) {
                $this->filelist[] = new Directory($file);
            } else $this->filelist[] = new File($file);
        }
    }
    
    

}