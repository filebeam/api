<?php 

# Crea logs de cada uso de la API para posibles futuras incidencias

function addLog ($fileName, $hash) {
    
    require "config/connection.php";
    $timestamp = new DateTime();
    $timestamp = $timestamp->getTimestamp();
    $dateTime = getDateTime();

    $stmt1 = $conn->prepare("INSERT INTO file_logs (timestamp, date_time, user_agent, ip_addr, file_name, hash) VALUES (:timestamp, :date_time, :user_agent, :ip_addr, :file_name, :hash)");
    $stmt1->bindParam(":timestamp", $timestamp);
    $stmt1->bindParam(":date_time", $dateTime);
    $stmt1->bindParam(":user_agent", $_SERVER['HTTP_USER_AGENT']);
    $stmt1->bindParam(":ip_addr", $_SERVER['REMOTE_ADDR']);
    $stmt1->bindParam(":file_name", $fileName);
    $stmt1->bindParam(":hash", $hash);
    $stmt1->execute();

}