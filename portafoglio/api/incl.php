<?php
/*
$dbServername = "MariaDB 10";
$dbUsername = "root";
$dbPassword = "";
$dbName = "portafoglio";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);


//altervista
/* $config = [
    'db_engine' => 'mysql',
    'db_host' => '127.0.0.1',
    'db_name' => 'my_andreacostamagna',
    'db_user' => 'root',
    'db_password' => '',
];



$db_config = $config['db_engine'] . ":host=" . $config['db_host'] . ";dbname=" . $config['db_name'];
$conn = mysqli_connect($config['db_host'], $config['user'], $config['password'], $config['name']);

try {
    $pdo = new PDO($db_config, $config['db_user'], $config['db_password'], [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    echo "connesso";
} catch (PDOException $e) {
    echo ("Impossibile connettersi al database: " . $e->getMessage());
}
*/

//MAMP
/*
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'portafoglio';
*/
//$conn = mysqli_connect($db_host, $db_user, $db_password, $db_db);

//XAMP
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_db = 'portafoglio';

$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($mysqli->connect_error) {
    echo 'Errno: ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}

echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: ' . $mysqli->host_info;
echo '<br>';
echo 'Protocol version: ' . $mysqli->protocol_version;
echo '<br/>';

//$mysqli->close();