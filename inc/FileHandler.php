<?php

namespace QCFileManager;

class FileHandler
{
    
    public static function rename($path, $newname) {
        
        $directory = FileManager::getDirectory($path);
        return rename($path, $directory . '/' . $newname);
    }
    
    public static function deleteFile($path) {
        
        if (is_file($path)) {
            return unlink($path);
        }
    }
    
    public static function deleteDir($dir) {
        
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                
                if ($file == "." && $file == "..") continue;
                
                if (filetype($dir . "/" . $file) == "dir")
                 //subdirectory
                FileManager::deleteDir($dir . "/" . $file);
                else unlink($dir . "/" . $file);
            }
            rmdir($dir);
        }
    }
    
    public static function getDirectory($path) {
        
        $path_parts = pathinfo($path);
        return $path_parts['dirname'];
    }
    
    public static function getFilename($path, $withextension = FALSE) {
        
        $path_parts = pathinfo($path);
        $filename = $path_parts['filename'];
        
        if ($withextension && isset($path_parts['extension'])) $filename.= '.' . $path_parts['extension'];
        
        return $path_parts['filename'];
    }
}