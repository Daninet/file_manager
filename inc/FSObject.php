<?php

namespace QCFileManager;

abstract class FSObject 
{
    
    public $name;
    public $path;
    
    public $creationtime;
    public $modtime;
    public $accesstime;
    
    public $size;
    public $type;
    
    public $readable;
    public $writable;
    public $executable;
    
    function __construct($path) {

        $this->path = realpath($path);

        $this->name = basename($path);

        $this->size = $this->querySize();
        $this->type = $this->queryType();
        
        list($this->creationtime, $this->modtime, $this->accesstime) = $this->queryTimestamps();
        
        $this->readable = $this->isReadable();
        $this->writable = $this->isWriteable();
        $this->executable = $this->isExecutable();
    }
    
    abstract protected function querySize();
    abstract protected function queryType();
    
    private function queryTimestamps() {
        return array(filectime($this->path), filemtime($this->path), fileatime($this->path));
    }

    
    public function getPrettySize() {
        
        $decimals = 2;
        $sz = 'BKMGTP';
        $factor = floor((strlen($this->size) - 1) / 3);
        return sprintf("%.{$decimals}f", $this->size / pow(1024, $factor)) . @$sz[$factor];
    }
    
    public function splitpath() {
        return explode(PATH_SEPARATOR, $this->path);
    }
    
    public function isReadable() {
        return is_readable($this->path);
    }
    
    public function isWriteable() {
        return is_writable($this->path);
    }
    
    public function isExecutable() {
        return is_executable($this->path);
    }

    private function prettyTime($time) {

        $diff = time() - $time;
        $chunks = array(array(60 * 60, 'hour'), array(60, 'minute'), array(1, 'second'));
        
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($diff / $seconds)) != 0) {
                break;
            }
        }
        
        if ($name == 'second' && $count < 20) return 'a few seconds ago';
        else if ($name == 'minute' && $count > 3) return ($count == 1) ? '1 ' . $name . ' ago' : "$count {$name}s ago";
        
        return date($GLOBALS['config']['date_format'], $this->modtime);

    }
    
    public function getPrettyMTime() {
        
        return $this->prettyTime($this->modtime);

    }
}