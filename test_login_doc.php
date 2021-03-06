<?php

include_once 'user_model.php';
include_once 'login_doc.php';
require_once 'session_manager.php';
require_once 'file_io_manager.php';
include_once 'crud.php';

$sessionManager = new SessionManager();
$fileIOManager = new FileIOManager();

$config = parse_ini_file('config/app.ini', true);
$crud = new Crud($config['database']);

$pageModel = new PageModel(NULL,$sessionManager,$fileIOManager,$crud);

$model = new UserModel($pageModel, $crud);
$model->pageType = 'login';
$model->createMenu();

$model->initializeMetaData('email','password');
$model->submitText = 'Inloggen';

$view = new LoginDoc($model);
$view->show();

?>