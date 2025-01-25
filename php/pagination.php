<?php
// Подключение к базе данных
include '../php/db.php'; // Замените путь на правильный

// Получаем текущую страницу, если она не задана — устанавливаем 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Количество записей на одной странице
$recordsPerPage = 10;

// Вычисляем начальную позицию для текущей страницы
$offset = ($page - 1) * $recordsPerPage;

// Получаем общее количество записей
$sqlTotal = "SELECT COUNT(*) as total FROM bookss";
$totalRecordsStmt = $conn->prepare($sqlTotal);
$totalRecordsStmt->execute();
$totalRecordsRow = $totalRecordsStmt->fetch(PDO::FETCH_ASSOC); // Получаем строку
$totalRecords = $totalRecordsRow['total']; // Достаем значение 'total'

// Получаем записи для текущей страницы
$sql = "SELECT * FROM bookss LIMIT :offset, :limit";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $recordsPerPage, PDO::PARAM_INT);
$stmt->execute();

// Считаем общее количество страниц
$totalPages = ceil($totalRecords / $recordsPerPage);
?>
