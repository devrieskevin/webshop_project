<?php

require_once 'icrud.php';

/**
 * Description of Crud
 *
 * @author Kevin de Vries
 */
class Crud implements ICrud {

  private $pdo;
  private $config;

  public  function __Construct(array $config) {
    $this->config = $config;
  }

  private function connectToDb() {
    $dsn = 'mysql:host='.$this->config['hostname'].';dbname='.$this->config['dbname'];
    $options = [PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

    $this->pdo = new PDO($dsn, $this->config['dbusername'], $this->config['dbpassword'], $options);
  }

  /**
   * Prepare an SQL statement and bind parameter values
   *
   * @param string $sql the SQL string with for example ':email' for parameters
   * @param array  $bindParameters associative array e.g. ['email' => 'joe@a.b'];
   *
   * @return PDOStatement the prepared PDO statement with bound values
   * @throws PDOException when failed to complete the binding or preparation for technical reasons
   */
  private function prepareAndBind($sql, $bindParameters) {
    $stmt = $this->pdo->prepare($sql);

    foreach ($bindParameters as $key => $value){
      $stmt->bindValue(':' . $key, $value);
    }

    return $stmt;
  }

  /**
   * Prepare an SQL statement, bind parameter values and execute the statement
   *
   * @param string $sql the SQL string with for example ':email' for parameters
   * @param array  $bindParameters associative array e.g. ['email' => 'joe@a.b'];
   *
   * @return PDOStatement the executed PDO statement
   * @throws PDOException when failed to connect to the database
   * @throws Exception when failed to complete the binding or preparation for technical reasons
   */
  private function prepareBindAndExecute($sql, $bindParameters) {
    if (!isset($this->pdo)) {
      $this->connectToDb();
    }

    try {
      $stmt = $this->prepareAndBind($sql, $bindParameters);
      $stmt->execute();
      return $stmt;
    }
    catch (PDOException $e) {
      $queryMessage = 'Performed query: ' . $sql;
      throw new Exception($e->getMessage() . '; ' . $queryMessage);
    }
  }

  public function createRow($sql, $bindParameters) {
    $this->prepareBindAndExecute($sql, $bindParameters);
    return $this->pdo->lastInsertId();
  }

  public function readMultipleRows($sql, $bindParameters, $className = NULL, $keyName = NULL) {
    $stmt = $this->prepareBindAndExecute($sql, $bindParameters);

    if ($className) {
      $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
    }

    if ($keyName) {
      $result = [];
      foreach ($stmt as $row) {
        $result[$row->$keyName] = $row;
      }
      return $result;
    }
    return $stmt->fetchAll();
  }

  public function readOneRow($sql, $bindParameters, $className = NULL) {
    $stmt = $this->prepareBindAndExecute($sql, $bindParameters);

    if ($className) {
      $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
    }

    $row = $stmt->fetch();

    if (!$row) {
      return NULL;
    }
    return $row;
  }

  public function updateRow($sql, $bindParameters) {
    $stmt = $this->prepareBindAndExecute($sql, $bindParameters);
    return $stmt->rowCount();
  }

  public function deleteRows($sql, $bindParameters) {
    $stmt = $this->prepareBindAndExecute($sql, $bindParameters);
    return $stmt->rowCount();
  }
}

?>