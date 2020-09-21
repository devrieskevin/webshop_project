<?php

include_once 'shop_model.php';
include_once "shoppingcart_doc.php";
require_once 'session_manager.php';
require_once 'file_io_manager.php';
include_once 'crud.php';

$sessionManager = new SessionManager();
$fileIOManager = new FileIOManager();

$config = parse_ini_file('config/app.ini', true);
$crud = new Crud($config['database']);

$pageModel = new PageModel(NULL,$sessionManager,$fileIOManager,$crud);

$model = new ShopModel($pageModel, $crud);
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
