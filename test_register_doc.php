<?php

include_once 'user_model.php';
include_once 'register_doc.php';
require_once 'session_manager.php';
require_once 'file_io_manager.php';
include_once 'crud.php';

$sessionManager = new SessionManager();
$fileIOManager = new FileIOManager();

$config = parse_ini_file('config/app.ini', true);
$crud = new Crud($config['database']);

$pageModel = new PageModel(NULL,$sessionManager,$fileIOManager,$crud);

$model = new UserModel($pageModel, $crud);
$model->pageType = 'register';
$model->createMenu();

$model->initializeMetaData('name','email','password','confirmPassword');
$model->submitText = 'Register';

$view = new RegisterDoc($model);
$view->show();

?>