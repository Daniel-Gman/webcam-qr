<?php

/* Note!
 * Deze code is kwetsbaar tot een file upload -> RCE
 * Dit kan gefixt worden door meerdere checks toe te voegen
 * zoals mimetype van afbeeldingen, filepath limieten tot een directory
 * Dit is heel insecure, dus gebruik deze code alleen voor lokaal/testing
 * en niet voor productie!
 */

include_once("../source/database.php");

// 64-bit random name
$filename = bin2hex(random_bytes(64)) . ".png";
$dir = "../source/uploads/";
$fpath = $dir . $filename;

if (file_exists($fpath)) {
    die("Foto bestaat al!");
}

$raw = file_get_contents('php://input');
$json = json_decode($raw);

$raw_bytes = explode("data:image/png;base64,", $json->base64)[1];
file_put_contents($fpath, base64_decode($raw_bytes));

$query = "INSERT INTO saves (fname) VALUES ('$filename')";
$result = $conn->query($query);

if ($result) {
    echo $filename;
} else {
    echo "Error inserting into the database: " . $conn->error;
}
