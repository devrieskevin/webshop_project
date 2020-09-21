<?php

include_once 'shop_model.php';
include_once 'product_doc.php';
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

$product_data = ['product_id' => '', 'name' => 'Dummy', 'price' => '0.01',
                 'description' => 'Dummy text',
                 'image_path' => 'images/products/dummy.jpg'];

$model->product = new WebshopProduct();
$model->product->fromArray($product_data);

$model->loggedIn = $model->isAdmin = true;

$view = new ProductDoc($model);
$view->show();

?>
