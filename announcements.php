<?php

require "config/config.php";
require "config/connection.php";

if (!$maintenance) {
    header('Content-Type: application/json');

    $stmt = $conn->query("SELECT * FROM announcements ORDER BY id DESC");

    $annnouncements = $stmt->fetchAll();

    echo json_encode($annnouncements, JSON_PRETTY_PRINT);
} else {
    echo "Servicio no disponible temporalmente";
    http_response_code(503);
}