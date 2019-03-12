<?php
session_start();
unset($_SESSION["cart"][$_GET["id"]]);
print_r($_SESSION);
?>
