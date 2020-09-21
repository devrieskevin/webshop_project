<?php

/**
 * Description of ObjectUtils
 *
 * @author Kevin de Vries
 */
trait ObjectUtils {
  public   function fromArray($data) {
    foreach ($data as $key => $value) {
      $this->$key = $value;
    }
  }

  public   function fromObject($object) {
    foreach (get_object_vars($object) as $property => $value) {
      $this->$property = $value;
    }
  }

  public   function get_properties($properties=NULL) {
    if ($properties) {
      $array = [];
      foreach ($properties as $property) {
        $array[$property] = $this->$property;
      }
      return $array;
    }
    return get_object_vars($this);
  }
}
