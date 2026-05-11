<?php
require_once('./includes/db.php');
include('./includes/config.inc.php');
$page = '';
if (count($_GET) > 0) {
    $keys = array_keys($_GET);
    $page = $keys[0]; // get the first parameter as the page name
}
if ($page!="") {
	if (isset($pages[$page]) && file_exists("./templates/pages/{$pages[$page]['file']}.tpl.php")) {
		$find = $pages[$page];
	}
	else { 
		$find = $error_page;
		header("HTTP/1.0 404 Not Found");
	}
}
else $find = $pages['/'];
include('./templates/index.tpl.php'); 
?>