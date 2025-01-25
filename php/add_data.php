<?php
require 'db.php'; // Подключение к БД

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // название таблицы
    $table = isset($_POST['table']) ? $_POST['table'] : '';

    if (empty($table)) {
        die("Ошибка: не указана таблица.");
    }

    //  список столбцов из базы данных
    $query = $conn->prepare("SHOW COLUMNS FROM `$table`");
    $query->execute();
    $columns = $query->fetchAll(PDO::FETCH_ASSOC); 

    if (!$columns) {
        die("Ошибка: таблица '$table' не найдена.");
    }

    //  массив с данными, которые соответствуют столбцам таблицы
    $data = array();
    $placeholders = array();
    foreach ($columns as $column) {
        //  название столбца хранится в $column['Field']
        $column_name = $column['Field'];
        if (isset($_POST[$column_name])) {
            $data[$column_name] = $_POST[$column_name];
            $placeholders[] = ":$column_name";
        }
    }

    if (empty($data)) {
        die("Ошибка: нет данных для вставки.");
    }

    //  SQL-запрос
    $sql = "INSERT INTO `$table` (" . implode(", ", array_keys($data)) . ") VALUES (" . implode(", ", $placeholders) . ")";
    $stmt = $conn->prepare($sql); 

    // запрос
    if ($stmt->execute($data)) {
        echo "Данные успешно добавлены в таблицу '$table'.";
    } else {
        echo "Ошибка при добавлении данных.";
    }
} else {
    echo "Ошибка: неверный метод запроса.";
}
?>
