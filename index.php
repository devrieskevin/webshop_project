<?php

//==============================================
// MAIN APP
//==============================================
require_once 'page_controller.php';
require_once 'session_manager.php';
require_once 'file_io_manager.php';
require_once 'crud.php';

$sessionManager = new SessionManager();
$fileIOManager = new FileIOManager();
$config = parse_ini_file('config/app.ini', true);

$crud = new Crud($config['database']);
$pageModel = new PageModel(NULL,$sessionManager,$fileIOManager,$crud);
$controller = new PageController($pageModel);
$controller->handleRequest();

?>