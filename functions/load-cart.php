<?php
session_start();
$cart = [];
foreach ($_SESSION["cart"] as $key => $value) {
  array_push($cart, $key);
}
echo json_encode($cart);
?>
