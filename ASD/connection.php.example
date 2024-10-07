<?php

$host = "localhost";
$database = "filebeam";
$user = "root";
$password = "";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password, $options);
} catch (PDOException $e) {
  die("PDO Connection Error: " . $e->getMessage());
}