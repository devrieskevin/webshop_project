<?php

include_once 'shop_model.php';
include_once 'product_edit_doc.php';
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

$model->isAdmin = true;

$model->initializeMetaData('name','price','description','image');
$model->submitText = 'Bewerken';

$view = new ProductEditDoc($model);
$view->show();

?>