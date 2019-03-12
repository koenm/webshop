<?php
session_start();

// get the product id
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$quantity = isset($_GET["quantity"]) ? $_GET["quantity"] : 1;
$price = isset($_GET["price"]) ? $_GET["price"] : 0;

// make quantity a minimum of 1
$quantity = $quantity <= 0 ? 1 : $quantity;

// add new item on array
$cart_item = array(
  "quantity" => $quantity,
  "price" => $price
);

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// check if the item is in the array, if it is, do not add
if (!array_key_exists($id, $_SESSION['cart'])) {
  $_SESSION['cart'][$id] = $cart_item;
}
?>
