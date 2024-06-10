<?php
header('Content-Type: application/json');


require "../config/config.php";
require "../config/connection.php";

$stmt = $conn->query("SELECT * FROM announcements ORDER BY id DESC");

$annnouncements = $stmt->fetchAll();

echo json_encode($annnouncements, JSON_PRETTY_PRINT);