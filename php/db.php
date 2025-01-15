<?php
$serverName = "localhost";  
$database = "gtklib";
$username = "gtklib";  
$password = "gtklib"; 

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Подключение успешно!"; // Отладочный вывод
    echo "Подключение к базе данных: $database на сервере $serverName";
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Запрос на получение данных
$sql = "SELECT * FROM Books";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Проверка наличия данных
if ($stmt->rowCount() > 0) {
    echo "Найдено строк: " . $stmt->rowCount(); // Отладочный вывод
    // Вывод данных каждой строки
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print_r($row); // Вывод каждой строки для отладки
    }
} else {
    echo "<tr><td colspan='38'>Нет данных</td></tr>";
}

echo "SQL-запрос: $sql";
?>
