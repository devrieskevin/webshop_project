<?php

include_once 'user_model.php';
include_once 'login_doc.php';
include_once 'crud.php';

$crud = new Crud();
$model = new UserModel(null, $crud);
$model->pageType = 'login';
$model->createMenu();

$model->initializeMetaData('email','password');
$model->submitText = 'Inloggen';

$view = new LoginDoc($model);
$view->show();

?>