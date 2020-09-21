<?php

include_once 'page_model.php';
include_once 'basic_doc.php';

$model = new PageModel(NULL);
$model->createMenu();

$view = new BasicDoc($model);
$view->show();

?>