<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php'; // Подключение к БД

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получаем название таблицы
    $table = isset($_POST['table']) ? $_POST['table'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : ''; // Получаем id записи для редактирования

    if (empty($table) || empty($id)) {
        echo "Ошибка: не указана таблица или ID записи.";
        exit;
    }

    // Получаем список столбцов из базы данных
    $query = $conn->prepare("SHOW COLUMNS FROM `$table`");
    $query->execute();
    $columns = $query->fetchAll(PDO::FETCH_ASSOC);

    if (!$columns) {
        echo "Ошибка: таблица '$table' не найдена.";
        exit;
    }

    // Формируем массив с данными, которые соответствуют столбцам таблицы
    $data = array();
    $placeholders = array();
    foreach ($columns as $column) {
        // Предполагаем, что название столбца хранится в $column['Field']
        $column_name = $column['Field'];

        // Для редактирования пропускаем столбец ID
        if ($column_name != 'id' && isset($_POST[$column_name])) {
            $data[$column_name] = $_POST[$column_name];
            $placeholders[] = "$column_name = :$column_name";
        }
    }

    if (empty($data)) {
        echo "Ошибка: нет данных для обновления.";
        exit;
    }

    // Формируем SQL-запрос для обновления
    $sql = "UPDATE `$table` SET " . implode(", ", $placeholders) . " WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Добавляем id в массив данных
    $data['id'] = $id;

    // Выполняем запрос
    if ($stmt->execute($data)) {
        echo "Данные успешно обновлены в таблице '$table'.";
    } else {
        echo "Ошибка при обновлении данных.";
    }
} else {
    echo "Ошибка: неверный метод запроса.";
}

// Логирование данных для отладки
file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);
