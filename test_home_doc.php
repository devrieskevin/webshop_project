<?php

include_once 'page_model.php';
include_once "home_doc.php";

$model = new PageModel(NULL);
$model->pageType = 'home';
$model->createMenu();

$view = new HomeDoc($model);
$view  -> show();

?>