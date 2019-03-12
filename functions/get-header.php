<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../includes/connect.php";

$stmt = $mysqli->prepare("SELECT * FROM instelling WHERE id = ?");
$stmt->bind_param("i", $_POST["instelling"]);
$stmt->execute();
$rs = $stmt->get_result();
$instelling = $rs->fetch_assoc();

$stmt = $mysqli->prepare("SELECT * FROM richtingen WHERE richting = ?");
$stmt->bind_param("s", $_POST["richting"]);
$stmt->execute();
$rs = $stmt->get_result();
$richting = $rs->fetch_assoc();

echo json_encode(["instelling" => $instelling["naam_kort"], "richting" => $richting["richting_compleet"]]);
?>
