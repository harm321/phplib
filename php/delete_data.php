<?php
require 'db.php'; // Подключение к БД

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //  название таблицы и ID записи для удаления
    $table = isset($_POST['table']) ? $_POST['table'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if (empty($table) || empty($id)) {
        die("Ошибка: не указана таблица или ID записи.");
    }

    // Проверка на существование записи в таблице
    $query = $conn->prepare("SELECT COUNT(*) FROM `$table` WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $count = $query->fetchColumn();

    if ($count == 0) {
        die("Ошибка: запись с ID '$id' не найдена в таблице '$table'.");
    }

    //  SQL-запрос для удаления записи
    $sql = "DELETE FROM `$table` WHERE id = :id";
    $stmt = $conn->prepare($sql);

    //  запрос
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Запись с ID '$id' успешно удалена из таблицы '$table'.";
    } else {
        echo "Ошибка при удалении записи.";
    }
} else {
    echo "Ошибка: неверный метод запроса.";
}
?>
