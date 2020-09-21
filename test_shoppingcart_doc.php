<?php

include_once 'shop_model.php';
include_once "shoppingcart_doc.php";
include_once 'crud.php';

$crud = new Crud();
$model = new ShopModel(NULL, $crud);
$model->pageType = 'shoppingcart';
$model->createMenu();

$model->initializeMetaData('quantity');
$product_data = ['product_id' => '', 'name' => 'Dummy', 'price' => 1,
                 'image_path' => 'images/products/dummy.jpg'];

$model->products[] = new WebshopProduct($product_data,5);
$model->products[] = new WebshopProduct($product_data,10);

$model->calculatePriceTotal();
$model->submitText = 'Bewerken';

$view = new ShoppingcartDoc($model);
$view->show();

?>
