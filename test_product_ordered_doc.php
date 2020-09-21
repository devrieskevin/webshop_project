<?php

include_once 'page_model.php';
include_once "product_ordered_doc.php";
include_once 'util.php';

$model = new PageModel(NULL);
$model->pageType = 'webshop';
$model->createMenu();

$view = new ProductOrderedDoc($model);
$view->show();

?>
