<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Приход книг</title>
    <link rel="stylesheet" href="../assets/css/library_catalog.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <h1 id="header-title" class="header-title">Библиотечный каталог</h1>
            <a href="index.html" class="nav-section">Главная</a>
            <button class="nav-section">Справочник</button>
            <div id="handbook" class="submenu">
                <a href="#">(В процессе) Вызов и просмотр справочника</a>
                <a href="#">(В процессе) справочник нового элемента</a>
                <a href="#">(В процессе)Редактирование элемента справочника</a>
                <a href="#">(В процессе)Орфографический контроль</a>
                <a href="#">(В процессе)Удаление элемента справочника</a>
                <a href="#">(В процессе)Копирование элемета справочника</a>
                <a href="#">(В процессе)Печать справочника</a>
                <a href="#">(В процессе)Работа с историей значения справочника</a>
                <a href="#">(В процессе)Поиск в справочнике</a>
                <a href="#">(В процессе)Контекстный поиск</a>
                <a href="#">(В процессе)Скользящий поиск</a>
                <a href="#">(В процессе)Иерархический список справочников</a>
            </div>
            <button class="nav-section">Документы</button>
            <div id="documents" class="submenu">
                <a href="book_arrival.php">Приход книг</a>
                <a href="reader_description.php">Читатели</a>
                <a href="lib_record.php">Ведомость учёта библиотечного фонда</a>
                <a href="inventory_book.php">Инвентарная книга</a>
            </div>
            <button class="nav-section">Отчёты</button>
            <div id="reports" class="submenu">
                <a href="fund_receipt.php">Книга суммарного учёта (Поступление в фонд)</a>
                <a href="book_retirement.php">Книга суммарного учёта (Выбытие книг)</a>
                <a href="fund_movements.php">Книга суммарного учёта (Итоги движения фонда)</a>
            </div>
            <button class="nav-section">Каталоги</button>
            <div id="catalogs" class="submenu">
                <a href="library_catalog.php">Библиотечный каталог</a>
                <a href="magazine_catalog.php">Каталог журналов и газет</a>
            </div>
        </aside>
        <main>
            <button class="button-action add-book-btn"><img src="../assets/img/ico-reader.svg"
                alt="Иконка добавления читателя" class="button-icon">Добавить новую запись</button>
            <button class="button-action export-btn">
                <img src="../assets/img/ico-export.svg" alt="Иконка экспорта" class="button-icon">
                Экспортировать
            </button>

            <div class="controls">

                <input type="text" id="search-input" placeholder="Поиск..." class="searchInput">
                <p id="header-subtitle" class="headerSubtitle">0 книг выбрано</p>
            </div>
            <div class="table-container">

                <table>
                    <thead>
                        <tr>
                            <th class="fixed-checkbox sortable"  data-sort="asc">
                                <input type="checkbox" id="selectAll" class="select-all-checkbox">
                            </th>
                            <th class="sortable" data-sort="asc">Инвентарный номер</th>
                            <th class="sortable" data-sort="asc">Дата зап. в инв.кн.</th>
                            <th class="sortable" data-sort="asc">Вид издания</th>
                            <th class="sortable" data-sort="asc">Автор(ы) издания</th>
                            <th class="sortable" data-sort="asc">Второй автор</th>
                            <th class="sortable" data-sort="asc">Третий автор</th>
                            <th class="sortable" data-sort="asc">Сведения об ответст-ти</th>
                            <th class="sortable" data-sort="asc">Название издания</th>
                            <th class="sortable" data-sort="asc">Свед.относящ.к заглав.</th>
                            <th class="sortable" data-sort="asc">Сведения об издании</th>
                            <th class="sortable" data-sort="asc">Серия</th>
                            <th class="sortable" data-sort="asc">Обозначение материала</th>
                            <th class="sortable" data-sort="asc">Место издания</th>
                            <th class="sortable" data-sort="asc">Издательство</th>
                            <th class="sortable" data-sort="asc">Год издания</th>
                            <th class="sortable" data-sort="asc">Объем страниц</th>
                            <th class="sortable" data-sort="asc">Объем печат.листов</th>
                            <th class="sortable" data-sort="asc">Гриф</th>
                            <th class="sortable" data-sort="asc">ISBN</th>
                            <th class="sortable" data-sort="asc">Страна производителя</th>
                            <th class="sortable" data-sort="asc">Количество экземпляров</th>
                            <th class="sortable" data-sort="asc">Цена (тенге)</th>
                            <th class="sortable" data-sort="asc">Тираж издания</th>
                            <th class="sortable" data-sort="asc">Рубрика</th>
                            <th class="sortable" data-sort="asc">Ключевое слово</th>
                            <th class="sortable" data-sort="asc">Индекс ББК</th>
                            <th class="sortable" data-sort="asc">Индекс УДК</th>
                            <th class="sortable" data-sort="asc">Индекс ГРНТИ</th>
                            <th class="sortable" data-sort="asc">Авторский знак</th>
                            <th class="sortable" data-sort="asc">Язык текста</th>
                            <th class="sortable" data-sort="asc">Краткое содержание</th>
                            <th class="sortable" data-sort="asc">Примечание</th>
                            <th class="sortable" data-sort="asc">Иллюстрация</th>
                            <th class="sortable" data-sort="asc">Переплет</th>
                            <th class="sortable" data-sort="asc">Отметка о проверке №1, год</th>
                            <th class="sortable" data-sort="asc">Отметка о проверке №2, год</th>
                            <th class="sortable" data-sort="asc">Отметка о проверке №3, год</th>
                            <th class="sortable" data-sort="asc">Сигла</th>
                            <th class="sortable" data-sort="asc">Название организации</th>
                            <th class="sortable" data-sort="asc">HTML ссылка</th>
                            <th class="sortable" data-sort="asc">Физические характеристики</th>
                            <th class="sortable" data-sort="asc">Системные требования</th>
                            <th class="fixed-menu">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include '../php/db.php'; // Подключение к базе данных

                    // Запрос на получение данных
                    $sql = "SELECT * FROM Books";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Проверка наличия данных
                    if ($stmt->rowCount() > 0) {
                        // Вывод данных каждой строки
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                    <td class='fixed-checkbox'><input type='checkbox' class='row-checkbox'></td>
                                    <td>{$row['inventory_number']}</td>
                                    <td>{$row['inventory_date']}</td>
                                    <td>{$row['publication_type']}</td>
                                    <td>{$row['authors']}</td>
                                    <td>{$row['second_author']}</td>
                                    <td>{$row['third_author']}</td>
                                    <td>{$row['responsibility_info']}</td>
                                    <td>{$row['title']}</td>
                                    <td>{$row['title_related_info']}</td>
                                    <td>{$row['publication_info']}</td>
                                    <td>{$row['series']}</td>
                                    <td>{$row['material_type']}</td>
                                    <td>{$row['publication_place']}</td>
                                    <td>{$row['publisher']}</td>
                                    <td>{$row['year_of_publication']}</td>
                                    <td>{$row['page_count']}</td>
                                    <td>{$row['printed_sheets']}</td>
                                    <td>{$row['mark']}</td>
                                    <td>{$row['isbn']}</td>
                                    <td>{$row['country']}</td>
                                    <td>{$row['copies']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['edition_copies']}</td>
                                    <td>{$row['category']}</td>
                                    <td>{$row['keywords']}</td>
                                    <td>{$row['bbk_index']}</td>
                                    <td>{$row['udc_index']}</td>
                                    <td>{$row['grnti_index']}</td>
                                    <td>{$row['author_sign']}</td>
                                    <td>{$row['language']}</td>
                                    <td>{$row['summary']}</td>
                                    <td>{$row['notes']}</td>
                                    <td>{$row['illustrations']}</td>
                                    <td>{$row['binding']}</td>
                                    <td>{$row['verification_mark_1']}</td>
                                    <td>{$row['verification_mark_2']}</td>
                                    <td>{$row['verification_mark_3']}</td>
                                    <td>{$row['sigla']}</td>
                                    <td>{$row['organization_name']}</td>
                                    <td>{$row['html_link']}</td>
                                    <td>{$row['physical_characteristics']}</td>
                                    <td>{$row['system_requirements']}</td>
                                    <td class='fixed-menu'>
                                        <button class='menu-btn'>
                                            <img src='../assets/img/library-dashboard/menu-ico.svg' alt='Меню' class='menu-icon' title='Меню'>
                                        </button>
                                        <div class='menu-options'>
                                            <button class='menu-icon-btn edit-btn' data-id='{$row['id']}'>
                                                <img src='../assets/img/library-dashboard/edit-ico.svg' alt='Редактировать' class='menu-icon' title='Редактировать'>
                                            </button>
                                            <button class='menu-icon-btn delete-btn' data-id='{$row['id']}'>
                                                <img src='../assets/img/library-dashboard/delete-ico.svg' alt='Удалить' class='menu-icon' title='Удалить'>
                                            </button>
                                        </div>
                                    </td>

                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='38'>Нет данных</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <!-- Модальное окно -->
    <div id="addModal" class="modal" >
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Добавить новую запись</h2>

            <form id="addBookForm" class="form-grid">
                <input type="hidden" name="table" value="books">

                <div><label for="inventory_number">Инвентарный номер</label><input type="text" id="inventory_number" name="inventory_number" required></div>
                <div><label for="inventory_date">Дата зап. в инв.кн.</label><input type="date" id="inventory_date" name="inventory_date" required></div>
                <div><label for="publication_type">Вид издания</label><input type="text" id="publication_type" name="publication_type"></div>
                <div><label for="authors">Автор(ы)</label><input type="text" id="authors" name="authors"></div>
                <div><label for="second_author">Второй автор</label><input type="text" id="second_author" name="second_author"></div>
                <div><label for="third_author">Третий автор</label><input type="text" id="third_author" name="third_author"></div>
                <div><label for="responsibility_info">Ответственность</label><input type="text" id="responsibility_info" name="responsibility_info"></div>
                <div><label for="title">Название</label><input type="text" id="title" name="title"></div>
                <div><label for="title_related_info">Связанная информация</label><input type="text" id="title_related_info" name="title_related_info"></div>
                <div><label for="publication_info">Информация об издании</label><input type="text" id="publication_info" name="publication_info"></div>
                <div><label for="series">Серия</label><input type="text" id="series" name="series"></div>
                <div><label for="material_type">Тип материала</label><input type="text" id="material_type" name="material_type"></div>
                <div><label for="publication_place">Место издания</label><input type="text" id="publication_place" name="publication_place"></div>
                <div><label for="publisher">Издатель</label><input type="text" id="publisher" name="publisher"></div>
                <div><label for="year_of_publication">Год издания</label><input type="number" id="year_of_publication" name="year_of_publication"></div>
                <div><label for="page_count">Страниц</label><input type="number" id="page_count" name="page_count"></div>
                <div><label for="printed_sheets">Печатные листы</label><input type="number" step="0.1" id="printed_sheets" name="printed_sheets"></div>
                <div><label for="mark">Марка</label><input type="text" id="mark" name="mark"></div>
                <div><label for="isbn">ISBN</label><input type="text" id="isbn" name="isbn"></div>
                <div><label for="country">Страна</label><input type="text" id="country" name="country"></div>
                <div><label for="copies">Экземпляры</label><input type="number" id="copies" name="copies"></div>
                <div><label for="price">Цена (тенге)</label><input type="number" step="0.01" id="price" name="price"></div>
                <div><label for="edition_copies">Тираж</label><input type="number" id="edition_copies" name="edition_copies"></div>
                <div><label for="category">Категория</label><input type="text" id="category" name="category"></div>
                <div><label for="keywords">Ключевые слова</label><input type="text" id="keywords" name="keywords"></div>
                <div><label for="bbk_index">ББК</label><input type="text" id="bbk_index" name="bbk_index"></div>
                <div><label for="udc_index">УДК</label><input type="text" id="udc_index" name="udc_index"></div>
                <div><label for="grnti_index">ГРНТИ</label><input type="text" id="grnti_index" name="grnti_index"></div>
                <div><label for="author_sign">Авторский знак</label><input type="text" id="author_sign" name="author_sign"></div>
                <div><label for="language">Язык</label><input type="text" id="language" name="language"></div>
                <div><label for="summary">Краткое содержание</label><textarea id="summary" name="summary"></textarea></div>
                <div><label for="notes">Примечания</label><textarea id="notes" name="notes"></textarea></div>
                <div><label for="illustrations">Иллюстрации</label><input type="text" id="illustrations" name="illustrations"></div>
                <div><label for="binding">Переплёт</label><input type="text" id="binding" name="binding"></div>
                <div><label for="verification_mark_1">Проверка 1</label><input type="number" id="verification_mark_1" name="verification_mark_1"></div>
                <div><label for="verification_mark_2">Проверка 2</label><input type="number" id="verification_mark_2" name="verification_mark_2"></div>
                <div><label for="verification_mark_3">Проверка 3</label><input type="number" id="verification_mark_3" name="verification_mark_3"></div>
                <div><label for="sigla">Сигла</label><input type="text" id="sigla" name="sigla"></div>
                <div><label for="organization_name">Организация</label><input type="text" id="organization_name" name="organization_name"></div>
                <div><label for="physical_characteristics">Физ. характеристики</label><input type="text" id="physical_characteristics" name="physical_characteristics"></div>


                <button type="submit" class="submit">Добавить запись</button>
            </form>
        </div>
    </div>
<!-- Модальное окно для редактирования -->
<div id="editModal" class="modal" >
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Редактировать запись</h2>

        <form id="editBookForm" class="form-grid">
            <input type="hidden" id="editId" name="id"> <!-- ID записи для редактирования -->
            <input type="hidden" name="table" value="books">
            <div><label for="inventory_number">Инвентарный номер</label><input type="text" id="inventory_number" name="inventory_number" required></div>
            <div><label for="inventory_date">Дата зап. в инв.кн.</label><input type="date" id="inventory_date" name="inventory_date" required></div>
            <div><label for="publication_type">Вид издания</label><input type="text" id="publication_type" name="publication_type"></div>
            <div><label for="authors">Автор(ы)</label><input type="text" id="authors" name="authors"></div>
            <div><label for="second_author">Второй автор</label><input type="text" id="second_author" name="second_author"></div>
            <div><label for="third_author">Третий автор</label><input type="text" id="third_author" name="third_author"></div>
            <div><label for="responsibility_info">Ответственность</label><input type="text" id="responsibility_info" name="responsibility_info"></div>
            <div><label for="title">Название</label><input type="text" id="title" name="title"></div>
            <div><label for="title_related_info">Связанная информация</label><input type="text" id="title_related_info" name="title_related_info"></div>
            <div><label for="publication_info">Информация об издании</label><input type="text" id="publication_info" name="publication_info"></div>
            <div><label for="series">Серия</label><input type="text" id="series" name="series"></div>
            <div><label for="material_type">Тип материала</label><input type="text" id="material_type" name="material_type"></div>
            <div><label for="publication_place">Место издания</label><input type="text" id="publication_place" name="publication_place"></div>
            <div><label for="publisher">Издатель</label><input type="text" id="publisher" name="publisher"></div>
            <div><label for="year_of_publication">Год издания</label><input type="number" id="year_of_publication" name="year_of_publication"></div>
            <div><label for="page_count">Страниц</label><input type="number" id="page_count" name="page_count"></div>
            <div><label for="printed_sheets">Печатные листы</label><input type="number" step="0.1" id="printed_sheets" name="printed_sheets"></div>
            <div><label for="mark">Марка</label><input type="text" id="mark" name="mark"></div>
            <div><label for="isbn">ISBN</label><input type="text" id="isbn" name="isbn"></div>
            <div><label for="country">Страна</label><input type="text" id="country" name="country"></div>
            <div><label for="copies">Экземпляры</label><input type="number" id="copies" name="copies"></div>
            <div><label for="price">Цена (тенге)</label><input type="number" step="0.01" id="price" name="price"></div>
            <div><label for="edition_copies">Тираж</label><input type="number" id="edition_copies" name="edition_copies"></div>
            <div><label for="category">Категория</label><input type="text" id="category" name="category"></div>
            <div><label for="keywords">Ключевые слова</label><input type="text" id="keywords" name="keywords"></div>
            <div><label for="bbk_index">ББК</label><input type="text" id="bbk_index" name="bbk_index"></div>
            <div><label for="udc_index">УДК</label><input type="text" id="udc_index" name="udc_index"></div>
            <div><label for="grnti_index">ГРНТИ</label><input type="text" id="grnti_index" name="grnti_index"></div>
            <div><label for="author_sign">Авторский знак</label><input type="text" id="author_sign" name="author_sign"></div>
            <div><label for="language">Язык</label><input type="text" id="language" name="language"></div>
            <div><label for="summary">Краткое содержание</label><textarea id="summary" name="summary"></textarea></div>
            <div><label for="notes">Примечания</label><textarea id="notes" name="notes"></textarea></div>
            <div><label for="illustrations">Иллюстрации</label><input type="text" id="illustrations" name="illustrations"></div>
            <div><label for="binding">Переплёт</label><input type="text" id="binding" name="binding"></div>
            <div><label for="verification_mark_1">Проверка 1</label><input type="number" id="verification_mark_1" name="verification_mark_1"></div>
            <div><label for="verification_mark_2">Проверка 2</label><input type="number" id="verification_mark_2" name="verification_mark_2"></div>
            <div><label for="verification_mark_3">Проверка 3</label><input type="number" id="verification_mark_3" name="verification_mark_3"></div>
            <div><label for="sigla">Сигла</label><input type="text" id="sigla" name="sigla"></div>
            <div><label for="organization_name">Организация</label><input type="text" id="organization_name" name="organization_name"></div>
            <div><label for="physical_characteristics">Физ. характеристики</label><input type="text" id="physical_characteristics" name="physical_characteristics"></div>


            <button type="submit" class="submit">Сохранить изменения</button>
        </form>
    </div>
</div>

<script src="../assets/js/library_catalog.js"></script>
<script src="../assets/js/sort.js"></script>
</body>


</html>