<?php 
if (!isset($DB_HOST)) {
    function loadEnv($file) {
    if (!file_exists($file)) {
        throw new Exception("Soubor se sys variables nenalezen");
    }

    $vars = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach($vars as $var) {
        if (strpos(trim($var), '#') === 0) {
            # preskoci komentare
            continue;
        }

        list($key, $value) = explode('=', $var, 2);
        putenv(trim($key) . '=' . trim($value));
    }
}
 
loadEnv(__DIR__ . '/.env');

$DB_HOST = getenv('DB_HOST');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');
$DB_NAME = getenv('DB_NAME');


// Připojení k databdzi
try {
    // $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection success";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
} }