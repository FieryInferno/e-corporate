<?php 
require_once 'init.php';

if (Input::post("action") != "install") {
    jsonecho("Invalid action", 101);
}

// Check required keys
$required_fields = array("key", "db_host", "db_name", "db_username");

foreach ($required_fields as $f) {
    if (!Input::post($f)) {
        jsonecho("Missing data: ".$f, 102);
    }
}

// Check database connection
$dsn = 'mysql:host='. Input::post("db_host") . ';dbname=' . Input::post("db_name") . ';charset=utf8mb4';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $connection = new PDO($dsn, Input::post("db_username"), Input::post("db_password"), $options);
} catch (\Exception $e) {
    jsonecho("Couldn't connect to the database!", 105);
}


$license_key = Input::post("key");
if($license_key != 'WWW.ISYANTO.COM') {
    jsonecho("KEY ERROR!", 106);
}
require_once('DFoX.php');
jsonecho('Application installed successfully!',1);

