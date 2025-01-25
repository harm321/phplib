<?php
$serverName = "localhost";
$database = "gtklib";
$username = "gtklib";
$password = "gtklib";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем параметры запроса
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 200;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'Title'; // Поле для сортировки
    $sortOrder = isset($_GET['sort_order']) && strtolower($_GET['sort_order']) === 'desc' ? 'DESC' : 'ASC'; // Порядок сортировки

    // Проверка на допустимые поля для сортировки
    $allowedSortFields = array('InventoryNumber', 'Authors', 'Title', 'Year', 'Category'); // Допустимые поля для сортировки
    if (!in_array($sortBy, $allowedSortFields)) {
        $sortBy = 'Title'; // Значение по умолчанию
    }

    // Основной SQL-запрос
    $sql = "SELECT * FROM Bookss";
    $params = array(); // Используем старый синтаксис для массива

    // Если есть поисковый запрос, добавляем условие для поиска по всем столбцам
    if (!empty($search)) {
        $sql .= " WHERE Title LIKE :search OR Authors LIKE :search OR InventoryNumber LIKE :search OR Year LIKE :search OR Category LIKE :search";
        $params[':search'] = '%' . $search . '%';
    }

    // Добавляем сортировку и ограничение выборки
    $sql .= " ORDER BY $sortBy $sortOrder LIMIT :offset, :limit";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

    // Привязываем параметры для поиска
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }

    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Получаем общее количество книг
    $countStmt = $conn->prepare("SELECT COUNT(*) FROM Bookss");
    $countStmt->execute();
    $totalBooksCount = $countStmt->fetchColumn();

    echo json_encode(array('books' => $books, 'totalBooks' => $totalBooksCount));
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage())); // Старый синтаксис для массива
}
?>
