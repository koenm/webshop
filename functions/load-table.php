<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../includes/connect.php";

$stmt = $mysqli->prepare("SELECT * FROM cursussen ORDER BY fase ASC, id ASC");
$stmt->execute();
$rs = $stmt->get_result();
$courses = $rs->fetch_all(MYSQLI_ASSOC);

echo json_encode($courses);
?>
