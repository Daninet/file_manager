<?php

namespace QCFileManager;

class UI
{
    
    private static $need_html = true;
    private static $body_text = '';

    private static function renderFileOperations($path) {

    	$html  = (new UILink('index.php/delete/'.$path, 'Delete'))   -> renderHTML();
    	$html .= (new UILink('index.php/rename/'.$path, 'Rename'))  -> renderHTML();
    	$html .= (new UILink('index.php/move/'.$path, 'Move'))       -> renderHTML();
    	$html .= (new UILink('index.php/details/'.$path, 'Details')) -> renderHTML();

    	return $html;
    }
    
    public static function renderFileList() {
        $app = App::getInstance();
        $app->listfiles();
        $filelist = $app->filelist;

        $table = new UITable(array('name', 'size', 'modified', 'permissions', 'actions'), '', 'main-table');

		foreach ($app->filelist as $item) {
			if($item->name == '.')
				continue;
			//print_r($item);
			$link = new UILink(App::site_url(App::getInstance()->currentdir.'/'.$item->name),$item->name);
			$table->addRow(

				array(
					(new UIIcon($item->queryType()))->renderHTML().$link->renderHTML(),
					($item->name != '.' && $item->name != '..')?$item->getPrettySize():'--',
					$item->getPrettyMTime(),
					($item->readable ? 'read ' : '') . ($item->writable ? 'write ' : '') . ($item->executable ? 'execute' : ''),
					UI::renderFileOperations($item->path)
					));
		}

		UI::$body_text .= $table->renderHTML();

    }

    public static function renderBody() {
    	return UI::$body_text;
    }


}