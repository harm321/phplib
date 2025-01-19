<?php
require 'db.php'; // Подключение к базе данных

$table = $_GET['table'];
$id = $_GET['id'];

//  id — это число
if (!is_numeric($id)) {
    echo json_encode(array('error' => 'Invalid ID'));
    exit;
}


$query = $conn->prepare("SELECT * FROM $table WHERE id = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);

$query->execute();

$data = $query->fetch(PDO::FETCH_ASSOC);

//  сообщение об ошибке
if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'No data found'));
}
?>
