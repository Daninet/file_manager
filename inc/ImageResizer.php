<?php

namespace QCFileManager;

class ImageResizer
{
    
    var $image;
    
    var $jpg_quality = 85;
    
    var $image_type;
    
    var $width;
    var $height;
    
    public function __construct($filename) {
        
        $info = getimagesize($filename);
        
        if (!$info) {
            throw new \Exception('Could not read ' . $filename);
        }
        
        list($this->width, $this->height, $this->source_type) = $info;
        
        switch ($this->image_type) {
            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($filename);
                break;

            case IMAGETYPE_JPEG:
                $this->image = imagecreatefromjpeg($filename);
                break;

            case IMAGETYPE_PNG:
                $this->image = imagecreatefrompng($filename);
                break;

            default:
                throw new \Exception('Unsupported image type');
                break;
        }
        
        return $this;
    }
    
    public function resizeToWidth($new_width, $allow_enlarge) {
        $ratio = $new_width / $this->width;
        $new_height = $this->height * $ratio;
        $this->resize($new_width, $new_height, $allow_enlarge);
        return $this;
    }
    
    public function outputToBrowser() {
        
        header('Content-Type: image/jpeg');
        
        imagejpeg($im, NULL, $this->jpg_quality);
        
        // Free up memory
        imagedestroy($im);
    }
}