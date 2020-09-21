<?php

include_once 'user_model.php';
include_once 'contact_reaction_doc.php';
include_once 'crud.php';

$crud = new Crud();
$model = new UserModel(null, $crud);
$model->pageType = 'contact';
$model->createMenu();

$view = new ContactReactionDoc($model);
$view->show();

?>