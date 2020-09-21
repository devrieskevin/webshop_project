<?php

include_once 'page_model.php';
include_once "about_doc.php";

$model = new PageModel(NULL);
$model->pageType = 'about';
$model->createMenu();

$view = new AboutDoc($model);
$view->show();

?>
