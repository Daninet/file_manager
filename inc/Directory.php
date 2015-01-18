<?php

namespace QCFileManager;

class Directory extends FSObject
{
    
    public function queryType() {
        return 'directory';
    }
    
    protected function querySize() {

    	if($this->name == '.' || $this->name == '..')
    		return 0;

		$size = 0;
	    $files = scandir($this->path);

	    foreach($files as $p){
	    	$path = $this->path.'/'.$p;
	        is_file($path) && $size += filesize($path);
	        $p != '.' && $p != '..' && is_dir($path) && $size += (new Directory($path))->querySize();
	    }
	    return $size;

    }

    public function isVirtualDirectory() {
    	if($this->location=='.' || $this->location=='..')
    		return true;

    	return false;
    }

}