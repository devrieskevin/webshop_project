<?php

include_once 'shop_model.php';
include_once 'product_edit_doc.php';
include_once 'crud.php';

$crud = new Crud();
$model = new ShopModel(NULL, $crud);
$model->pageType = 'webshop';
$model->createMenu();

$model->isAdmin = true;

$model->initializeMetaData('name','price','description','image');
$model->submitText = 'Bewerken';

$view = new ProductEditDoc($model);
$view->show();

?>