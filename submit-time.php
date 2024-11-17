<?php

function addTime ($time, $fileName, $sentTime) {

    include "config/connection.php";
    include_once "lib/time.php";

    $sent_time = getUnixTime();

    $expire_time = $sent_time + $time; # tiempo + segundos
    $stmt = $conn->prepare("INSERT INTO tmp_files (file_name, sent_time, expire_time) VALUES (:file_name, :sent_time, :expire_time)");
    $stmt->bindParam(":file_name", $fileName);
    $stmt->bindParam("sent_time", $sentTime);
    $stmt->bindParam(":expire_time", $expire_time);
    $stmt->execute();

}