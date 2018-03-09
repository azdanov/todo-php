<?php

declare(strict_types=1);

use Todo\Storage\MariaDbTaskStorage;
use Todo\TaskManager;

require_once __DIR__.'/vendor/autoload.php';

$host = '192.168.10.10';
$db = 'todo';
$user = 'homestead';
$pass = 'secret';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$db = new PDO($dsn, $user, $pass, $opt);

$storage = new MariaDbTaskStorage($db);
$manager = new TaskManager($storage);

$task = $manager->getTask(1);

echo '<pre>';
print_r($task);
echo '</pre>';
