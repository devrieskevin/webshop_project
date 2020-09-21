<?php

/**
 * Description of ShopCrud
 *
 * @author Kevin de Vries
 */
class ShopCrud {
  private $crud;

  public function __construct(ICrud $crud) {
    $this->crud = $crud;
  }

  // CRUD FUNCTIONS

  public function createProduct(WebshopProduct $product) {
    $sql = 'INSERT INTO products (name,price,description,image_path) '
         . 'VALUES (:name,:price,:description,:image_path)';

    $params = $product->get_properties(['name','price','description','image_path']);

    return $this->crud->createRow($sql, $params);
  }

  public function createProductChange($user_id, $product_id) {
    $sql = 'INSERT INTO product_changes (user_id,product_id) '
         . 'VALUES (:user_id,:product_id)';

    $params = ['user_id' => $user_id, 'product_id' => $product_id];

    return $this->crud->createRow($sql, $params);
  }

  public function createOrder($user_id) {
    $sql = 'INSERT INTO orders (user_id) VALUES (:user_id)';
    $params = ['user_id' => $user_id];
    return $this->crud->createRow($sql, $params);
  }

  public function createOrderProduct($order_id, WebshopProduct $product) {
    $sql = 'INSERT INTO order_products (order_id,product_id,price,quantity) '
         . 'VALUES (:order_id,:product_id,:price,:quantity)';

    $params = $product->get_properties(['product_id','price','quantity']);
    $params['order_id'] = $order_id;

    return $this->crud->createRow($sql, $params);
  }

  public function readAllProducts() {
    $sql = 'SELECT * FROM products';
    return $this->crud->readMultipleRows($sql, [], 'WebshopProduct');
  }

  public function readTopFiveProducts() {
    $sql = 'SELECT products.product_id, products.name, '
         . '       SUM(order_products.quantity) AS full_quantity '
         . 'FROM orders '
         . 'LEFT JOIN order_products '
         . 'ON order_products.order_id = orders.order_id '
         . 'LEFT JOIN products '
         . 'ON order_products.product_id = products.product_id '
         . 'WHERE orders.order_date >= ADDDATE(CURRENT_TIMESTAMP, INTERVAL -1 WEEK) '
         . 'GROUP BY products.product_id '
         . 'ORDER BY full_quantity  DESC '
         . 'LIMIT 5';

    return $this->crud->readMultipleRows($sql, []);
  }

  public function readProductById($product_id) {
    $sql = 'SELECT * FROM products WHERE product_id = :product_id';
    $params = ['product_id' => $product_id];
    return $this->crud->readOneRow($sql, $params, 'WebshopProduct');
  }

  public function updateProduct($product_id, WebshopProduct $product) {
    $sql = 'UPDATE products '
         . 'SET '
         . 'name = :name, price = :price, '
         . 'description = :description, image_path = :image_path, '
         . 'row_index = :row_index '
         . 'WHERE product_id = :product_id';

    $params = $product->get_properties(['name','price','description',
                                        'image_path','row_index']);
    $params['product_id'] = $product_id;

    return $this->crud->updateRow($sql, $params);
  }

  public function deleteProduct($product_id) {
    $sql = 'DELETE FROM products WHERE product_id = :product_id';
    $params = ['product_id' => $product_id];
    return $this->crud->deleteRows($sql, $params);
  }

  // BUSINESS LOGIC FUNCTIONS

  public function getAllProducts() {
    return $this->readAllProducts();
  }

  public function getTopFiveProducts() {
    return $this->readTopFiveProducts();
  }

  public function getProduct($product_id) {
    return $this->readProductById($product_id);
  }

  public function getMultipleProducts(...$product_ids) {
    $products = [];
    foreach ($product_ids as $product_id) {
      $products[] = $this->getProduct($product_id);
    }
    return $products;
  }

  public function storeOrder($user_id, $products) {
    $order_id = $this->createOrder($user_id);
    foreach ($products as $product) {
      $this->createOrderProduct($order_id, $product);
    }
  }

  public function editProduct($user_id,$product) {
    if (empty($product->product_id)) {
      return $this->createProduct($product);
    }
    else {
      $numRows = $this->updateProduct($product->product_id, $product);
      if ($numRows) {
        $this->createProductChange($user_id, $product->product_id);
      }
      return $numRows;
    }
  }

}

?>
