<?php

require_once 'icrud.php';

/**
 * Description of TestCrud
 *
 * @author Kevin de Vries
 */
class TestCrud implements ICrud {
  public $arrayToReturn = []; // To be set from the test itself during preperation
  public $objToReturn = NULL;  // To be set from the test itself during preperation
  public $sqlQueries = []; // list of queries to be validated by the test
  public $bindParams = []; // list of queries to be validated by the test

  #============================================================================
  function createRow($sql, $bindParameters)
  {
    array_push($this->sqlQueries, $sql);
    array_push($this->bindParams, $bindParameters);
    return 2;
  }

  #============================================================================
  function readMultipleRows($sql, $bindParameters, $className = NULL, $keyName = NULL)
  {
    array_push($this->sqlQueries, $sql);
    array_push($this->bindParams, $bindParameters);
    return $this->arrayToReturn;
  }

  #============================================================================
  function readOneRow($sql, $bindParameters, $className = NULL)
  {
    array_push($this->sqlQueries, $sql);
    array_push($this->bindParams, $bindParameters);
    return $this->objToReturn;
  }

  #============================================================================
  function updateRow($sql, $bindParameters)
  {
    array_push($this->sqlQueries, $sql);
    array_push($this->bindParams, $bindParameters);
    return 1;
  }

  #============================================================================
  function deleteRows($sql, $bindParameters)
  {
    array_push($this->sqlQueries, $sql);
    array_push($this->bindParams, $bindParameters);
    return 1;
  }
}
