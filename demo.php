<?php
include "Db.php";

define('_DB_HOST', 'localhost');
define('_DB_NAME', 'frydrva1');
define('_DB_USER', 'frydrva1');
define('_DB_PASSWORD', 'venda2007');


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    Db::connect(_DB_HOST, _DB_NAME, _DB_USER, _DB_PASSWORD);
} catch (Exception $ex) {
    echo "Chyba připojení k databázi: " . $ex->getMessage();
    exit;
}

$allRecords = Db::queryAll('SELECT * FROM pauta');
foreach ($allRecords as $record) {
    echo('ID: ' . $record['ID'] ."\n");
}

?>