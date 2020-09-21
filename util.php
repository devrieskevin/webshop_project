<?php

/**
 * Description of Util
 *
 * @author Kevin de Vries
 */
class Util {
  public static function getArrayVal($array, $key, $default='') {
    return isset($array[$key]) ? $array[$key] : $default;
  }

  public static function getPostVar($key, $default='') {
    // $value = filter_input(INPUT_POST, $key);
    // return isset($value) ? $value : $default;
    return self::getArrayVal($_POST, $key, $default);
  }

  public static function getPostArray($key, $default=[]) {
    // $value = filter_input(INPUT_POST, $key, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    // return isset($value) ? $value : $default;
    return self::getArrayVal($_POST, $key, $default);
  }

  public static function getUrlVar($key, $default='') {
    // $value = filter_input(INPUT_GET, $key);
    // return isset($value) ? $value : $default;
    return self::getArrayVal($_GET, $key, $default);
  }
}

?>