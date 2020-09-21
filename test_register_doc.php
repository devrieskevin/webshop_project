<?php

include_once 'user_model.php';
include_once 'register_doc.php';
include_once 'crud.php';

$crud = new Crud();
$model = new UserModel(null, $crud);
$model->pageType = 'register';
$model->createMenu();

$model->initializeMetaData('name','email','password','confirmPassword');
$model->submitText = 'Register';

$view = new RegisterDoc($model);
$view->show();

?>