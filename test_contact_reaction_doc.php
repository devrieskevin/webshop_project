<?php

include_once 'user_model.php';
include_once 'contact_reaction_doc.php';
require_once 'session_manager.php';
require_once 'file_io_manager.php';
include_once 'crud.php';

$sessionManager = new SessionManager();
$fileIOManager = new FileIOManager();

$config = parse_ini_file('config/app.ini', true);
$crud = new Crud($config['database']);

$pageModel = new PageModel(NULL,$sessionManager,$fileIOManager,$crud);

$model = new UserModel($pageModel, $crud);
$model->pageType = 'contact';
$model->createMenu();

$view = new ContactReactionDoc($model);
$view->show();

?>