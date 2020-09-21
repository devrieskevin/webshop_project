<?php

/**
 *
 * @author Kevin de Vries
 */
interface ISessionManager {
  function loginUser($user);

  function logoutUser();

  function isUserLoggedIn();

  function getLoggedInUser();

  function isUserAdmin();

  function getLoggedInUserName();

  function getLoggedInUserId();

  function getShoppingcartProducts();

  function addToShoppingcart($product_id);

  function updateProductQuantities($quantities);

  function emptyShoppingcart();
}
