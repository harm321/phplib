<?php
$serverName = "localhost";  
$database = "gtklib";
$username = "gtklib";  
$password = "gtklib"; 

try {
    // Подключение к MySQL
    $conn = new PDO("mysql:host=$serverName;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>