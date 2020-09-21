<?php

include_once 'shop_model.php';
include_once "webshop_doc.php";
require_once 'session_manager.php';
require_once 'file_io_manager.php';
include_once 'crud.php';

$sessionManager = new SessionManager();
$fileIOManager = new FileIOManager();

$config = parse_ini_file('config/app.ini', true);
$crud = new Crud($config['database']);

$pageModel = new PageModel(NULL,$sessionManager,$fileIOManager,$crud);

$model = new ShopModel($pageModel, $crud);
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
