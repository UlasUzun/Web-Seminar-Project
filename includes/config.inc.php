<?php
$pagetitle = array(
    'title' => 'Simple Website Ltd.',
);

$header = array(
    'imagesource' => 'logo.png',
    'imagealt' => 'logo',
	'title' => 'Simple Website',
	'motto' => ''
);

$footer = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'firm' => 'Simple Website Ltd.'
);

$pages = array(
	'/' => array('file' => 'main', 'text' => 'Mainpage', 'menun' => array(1,1)),
	'images' => array('file' => 'images', 'text' => 'Images', 'menun' => array(1,1)),
	'contact' => array('file' => 'contact', 'text' => 'Contact', 'menun' => array(1,1)),
    'messages' => array('file' => 'messages', 'text' => 'Messages', 'menun' => array(0,1)),
    'crud' => array('file' => 'crud', 'text' => 'CRUD', 'menun' => array(1,1)),
    'login' => array('file' => 'login', 'text' => 'Login', 'menun' => array(1,0)),
    'login2' => array('file' => 'login2', 'text' => '', 'menun' => array(0,0)),
    'logout' => array('file' => 'logout', 'text' => 'Logout', 'menun' => array(0,1)),
    'register' => array('file' => 'register', 'text' => '', 'menun' => array(0,0))
);

$error_page = array ('file' => '404', 'text' => 'Page not found!');
?>
