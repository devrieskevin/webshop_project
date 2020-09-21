<?php

include_once 'shop_model.php';
include_once "topfive_doc.php";
include_once 'crud.php';

$crud = new Crud();
$model = new ShopModel(NULL, $crud);
$model->pageType = 'topfive';
$model->createMenu();

$view = new TopFiveDoc($model);
$view->show();

?>
