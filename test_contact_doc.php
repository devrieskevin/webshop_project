<?php

include_once 'user_model.php';
include_once 'contact_doc.php';
include_once 'crud.php';

$crud = new Crud();
$model = new UserModel(null, $crud);
$model->pageType = 'contact';
$model->createMenu();

$model->initializeMetaData('name','email','message');
$model->submitText = 'Verstuur';

$view = new ContactDoc($model);
$view->show();

?>