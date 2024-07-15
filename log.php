<?php

function log_upload($fileName, $timestamp, $dateTime) {

    require "config/connection.php";

    // timestamp, time_date, user_agent, ip_address, file_name

    $statement = $conn->prepare("INSERT INTO file_logs (timestamp, time_date, user_agent, ip_address, file_name) VALUES (:timestamp, :time_date, :user_agent, :ip_address, :file_name)");
    $statement->bindParam(":timestamp", $timestamp);
    $statement->bindParam(":time_date", $dateTime);
    $statement->bindParam(":user_agent", $_SERVER['HTTP_USER_AGENT']);
    $statement->bindParam(":ip_address", $_SERVER['REMOTE_ADDR']);
    $statement->bindParam("file_name", $fileName);
    $statement->execute();
}