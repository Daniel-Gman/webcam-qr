<?php

include_once("../source/config.php");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);

function get_img_by_name($fname) {
    $stmt = $conn->prepare("SELECT * FROM saves WHERE fname = ?");
    $stmt->bind_param("s", $fname); 
    $stmt->execute();
    $result = $stmt->get_result(); 
    return $result->fetch_assoc(); 
}