<?php

include_once 'shop_model.php';
include_once 'product_doc.php';
include_once 'crud.php';

$crud = new Crud();
$model = new ShopModel(NULL, $crud);
$model->pageType = 'webshop';
$model->createMenu();

$product_data = ['product_id' => '', 'name' => 'Dummy', 'price' => '0.01',
                 'description' => 'Dummy text',
                 'image_path' => 'images/products/dummy.jpg'];

$model->product = new WebshopProduct();
$model->product->fromArray($product_data);

$model->loggedIn = $model->isAdmin = true;

$view = new ProductDoc($model);
$view->show();

?>
