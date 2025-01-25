<?php
// Подключение к базе данных
$pdo = new PDO('mysql:host=localhost;dbname=your_database;charset=utf8', 'username', 'password');

// Получаем параметры из запроса
$search = $_POST['search'] ?? '';
$sortColumn = $_POST['sort_column'] ?? 'id';
$sortDirection = $_POST['sort_direction'] ?? 'asc';
$page = $_POST['page'] ?? 1;
$itemsPerPage = 10;

// Вычисляем смещение для пагинации
$offset = ($page - 1) * $itemsPerPage;

// Формируем базовый SQL-запрос
$sql = "SELECT * FROM your_table WHERE 1";

// Добавляем фильтр по поиску
if (!empty($search)) {
    $sql .= " AND (column1 LIKE :search OR column2 LIKE :search OR column3 LIKE :search)";
}

// Добавляем сортировку
$sql .= " ORDER BY $sortColumn $sortDirection";

// Добавляем пагинацию
$sql .= " LIMIT :offset, :itemsPerPage";

$stmt = $pdo->prepare($sql);

// Привязываем параметры
if (!empty($search)) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
$stmt->bindValue(':itemsPerPage', (int) $itemsPerPage, PDO::PARAM_INT);

// Выполняем запрос
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Получаем общее количество записей (для пагинации)
$totalSql = "SELECT COUNT(*) FROM your_table WHERE 1";
if (!empty($search)) {
    $totalSql .= " AND (column1 LIKE :search OR column2 LIKE :search OR column3 LIKE :search)";
}
$totalStmt = $pdo->prepare($totalSql);
if (!empty($search)) {
    $totalStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$totalStmt->execute();
$totalRecords = $totalStmt->fetchColumn();

// Отправляем JSON-ответ
echo json_encode([
    'data' => $data,
    'totalRecords' => $totalRecords,
]);
