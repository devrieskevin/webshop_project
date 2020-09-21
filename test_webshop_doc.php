<?php

include_once 'shop_model.php';
include_once "webshop_doc.php";
include_once 'crud.php';

$crud = new Crud();
$model = new ShopModel(NULL, $crud);
$model->pageType = 'webshop';
$model->createMenu();

$product_data = ['product_id' => '', 'name' => 'Dummy', 'price' => 1,
                 'image_path' => 'images/products/dummy.jpg'];

for ($i = 0; $i < 10; $i++) {
  $model->products[] = new WebshopProduct($product_data);
  $model->products[$i]->fromArray($product_data);
}
$model->loggedIn = $model->isAdmin = true;

$view = new WebshopDoc($model);
$view->show();

?>
