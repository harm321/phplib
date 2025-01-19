<?php
require 'db.php'; // Подключение к базе данных

$table = $_GET['table'];
$id = $_GET['id'];

// Просто убедитесь, что id — это число
if (!is_numeric($id)) {
    echo json_encode(array('error' => 'Invalid ID'));
    exit;
}

// Используем переменную $conn, как объект подключения
$query = $conn->prepare("SELECT * FROM $table WHERE id = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);

$query->execute();

$data = $query->fetch(PDO::FETCH_ASSOC);

// Если данные найдены, возвращаем их, если нет — сообщение об ошибке
if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'No data found'));
}
?>
