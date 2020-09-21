<?php

/**
 *
 * @author Kevin de Vries
 */
interface ICrud {
  /**
   * Insert a row of values into from the database
   *
   * @param string $sql the SQL string with for example ':email' for parameters
   * @param array  $bindParameters associative array e.g. ['email' => 'joe@a.b'];
   *
   * @return int the inserted id or 0 if failed
   * @throws PDOException when failed to complete the insert for technical reasons
   */
  function createRow($sql, $bindParameters);

  /**
   * Read an array of objects from the database
   *
   * @param string $sql the SQL string with for example ':email' for parameters
   * @param array  $bindParameters associative array e.g. ['email' => 'joe@a.b'];
   * @param string $className the name of the class where the fetched data is inserted,
   *               set to NULL for a standard object to be returned
   * @param string $keyName the name of the field to use as 'key' for the associative array,
   *               set to NULL for a regular array
   *
   * @return array (associative) array of objects or an empty array
   * @throws PDOException when failed to complete the select for technical reasons
   */
  function readMultipleRows($sql, $bindParameters, $className = NULL, $keyName = NULL);

  /**
   * Read one object from the database
   *
   * @param string $sql the SQL string with for example ':email' for parameters
   * @param array  $bindParameters associative array e.g. ['email' => 'joe@a.b'];
   * @param string $className the name of the class where the fetched data is inserted,
   *               set to NULL for a standard object to be returned
   *
   * @return object the object found or NULL otherwise
   * @throws PDOException when failed to complete the select for technical reasons
   */
  function readOneRow($sql, $bindParameters, $className = NULL);

  /**
   * Update values from the database
   *
   * @param string $sql the SQL string with for example ':email' for parameters
   * @param array  $bindParameters associative array e.g. ['email' => 'joe@a.b']);
   *
   * @return int number of updated rows or 0 if failed
   * @throws PDOException when failed to complete the update for technical reasons
   */
  function updateRow($sql, $bindParameters);

  /**
   * Removes rows from the database
   *
   * @param string $sql the SQL string with for example ':email' for parameters
   * @param array  $bindParameters associative array e.g. ['email' => 'joe@a.b'];
   *
   * @return int number of deleted rows or 0 if failed
   * @throws PDOException when failed to complete the delete for technical reasons
   */
  function deleteRows($sql, $bindParameters);
}
