<?php

/*
	Sweet File Manager
	Copyright (C) 2015  Daniel Biro

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


namespace QCFileManager;
$start = microtime(true);

$config = array();
$config['lang'] = 'en';
$config['thumbnails'] = true;
$config['date_format'] = 'Y-m-d H:i';

error_reporting(E_ALL);
ini_set('display_errors', 1);


spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'QCFileManager\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/inc/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
	<title>QC File Manager</title>

</head>
<body>
	<?=UI::renderFileList()?>
	<?=UI::renderBody()?>

	<p><?php echo ("Rendered in " . sprintf("%.3f", (microtime(true) - $start)) . "ms, RAM: ".(memory_get_peak_usage(TRUE)/1024)."kb"); ?></p>

</body>
</html>
