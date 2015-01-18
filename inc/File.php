<?php

namespace QCFileManager;

class File extends FSObject
{
    
    var $extension;
    
    public function queryType() {
        
        $known_filetypes = array(
        'image' => array('jpg', 'jpeg', 'png', 'bmp', 'gif', 'tif', 'tiff', 'tga', 'webp', 'svg', 'ico'), 'pdf' => array('pdf'), 'document' => array('doc', 'docx', 'odt', 'rtf'), 'spreadsheet' => array('xls', 'xlsx', 'ods'), 'keynote' => array('ppt', 'pptx'), 'text' => array('txt', 'csv', 'css', 'js', 'html'), 'website' => array('html', 'htm'), 'source' => array('xml', 'rss', 'php', 'js', 'coffee', 'css', 'less', 'saas', 'scss', 'c', 'cpp', 'h', 'hpp', 'py', 'pl', 'rb', 'cs', 'java', 'lua'), 'audio' => array('mp3', 'aac', 'flac', 'wav', 'wma'), 'compressed' => array('zip', 'rar', '7z', 'tar', 'gz', 'tgz'), 'video' => array('wmv', 'avi', 'mov', 'mp4', 'flv', 'webm', 'mpg', 'mpeg', 'mkv'), 'executable' => array('exe', 'sh', 'bat', 'dll'));
        
        foreach ($known_filetypes as $filetype) {
            return array_search($this->extension, $filetype);
        }
    }
    
    protected function querySize() {
        return filesize($this->path);
    }
}