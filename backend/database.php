<?php
$user = 'root';
$pass = 'root';
$db = 'task_3';
$host = 'localhost';

$dns = 'mysql:host=' . $host . ';dbname=' . $db;
try {
    $pdo = new PDO($dns, $user, $pass);
} catch (PDOException $e) {
	die($e->getMessage());
}
?>
