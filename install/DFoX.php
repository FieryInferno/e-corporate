<?php 
// Data Source Name
$dsn = 'mysql:host='. Input::post("db_host") . ';dbname=' . Input::post("db_name") . ';charset=utf8mb4';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $connection = new PDO($dsn, Input::post("db_username"), Input::post("db_password"), $options);
} catch (\Exception $e) {
    jsonecho("Couldn't connect to the database!", 107);
}


$config_file_path = "../app/config/db_config.php";
$sql_file_path = "app/inc/db_jurnal.sql";
$index_file_path = "../index.php";

if (!is_file($sql_file_path)) {
    jsonecho("Some of SQL files didn't not found in install folder!", 109);
}


require_once $config_file_path;
if (DB_HOST != "BS_DB_HOST") {
    jsonecho("Something went wrong! It seems that application is already installed!", 110);
}


$SQL = "";
if (!is_file($sql_file_path)) {
    jsonecho("Some of SQL files didn't not found in install folder!", 109);
}


# Install DB
$SQL .= file_get_contents($sql_file_path);
$SQL = str_replace(
    array(
        "ADMIN_NAME",
        "ADMIN_PASSWORD",
        "ADMIN_EMAIL",
        "ADMIN_USERNAME",
    ), 
    array(
        Input::post("user_name"),
        md5(Input::post("user_password")),
        Input::post("user_email"),
        Input::post("user_username"),
    ),
    $SQL
);

$smtp = $connection->prepare($SQL);
$smtp->execute();


#Update DB Configuration file
$dbconfig = file_get_contents($config_file_path);
$dbconfig = str_replace(
    array(
        "BS_DB_HOST",
        "BS_DB_NAME",
        "BS_DB_USER",
        "BS_DB_PASS",
        "BS_TABLE_PREFIX",
    ),
    array(
        Input::post("db_host"),
        Input::post("db_name"),
        Input::post("db_username"),
        Input::post("db_password"),
        Input::post("db_table_prefix"),
    ),
    $dbconfig
);
file_put_contents($config_file_path, $dbconfig);

# Update index
$index = file_get_contents($index_file_path);
$index = preg_replace('/installation/', 'production', $index, 1);
file_put_contents($index_file_path, $index);