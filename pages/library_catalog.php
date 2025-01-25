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
                <p id="header-subtitle2" class="headerSubtitle">всего книг 0</p>
            </div>
            <div class="table-container">

                <table>
                    <thead>
                        <tr>
                            <th class="fixed-checkbox sortable">
                                <input type="checkbox" id="selectAll" class="select-all-checkbox">
                            </th>
                            <th class="sortable" data-sort="InventoryNumber">Инвентарный номер</th>
                            <th class="sortable" data-sort="Authors">Автор(ы)</th>
                            <th class="sortable" data-sort="Title">Название издания</th>
                            <th class="sortable" data-sort="PublicationType">Вид издания</th>
                            <th class="sortable" data-sort="PlaceOfPublication">Место издания</th>
                            <th class="sortable" data-sort="Publisher">Издательство</th>
                            <th class="sortable" data-sort="Year">Год</th>
                            <th class="sortable" data-sort="Volume">Объем издания</th>
                            <th class="sortable" data-sort="Language">Язык</th>
                            <th class="sortable" data-sort="ISBN">ISBN</th>
                            <th class="sortable" data-sort="Category">Рубрика</th>
                            <th class="sortable" data-sort="Keyword">Ключевое слово</th>
                            <th class="sortable" data-sort="UDC">УДК</th>
                            <th class="sortable" data-sort="BBK">ББК</th>
                            <th class="sortable" data-sort="Series">Серия</th>
                            <th class="sortable" data-sort="Content">Содержание</th>
                            <th class="sortable" data-sort="Label">Гриф</th>
                            <th class="sortable" data-sort="SecondAuthor">Второй автор</th>
                            <th class="sortable" data-sort="TitleRelatedInfo">Свед.относящ.к заглав.</th>
                            <th class="sortable" data-sort="RecordDate">Дата</th>
                            <th class="sortable" data-sort="RecordTime">время записи</th>
                            <th class="sortable" data-sort="Price">Цена</th>
                            <th class="sortable" data-sort="Notes">Примечание</th>
                            <th class="sortable" data-sort="DecommissionActNumber">№ акта выбытия</th>
                            <th class="sortable" data-sort="Copies">Количество экземпляров</th>
                            <th class="sortable" data-sort="AuthorSign">Авторский знак</th>
                            <th class="sortable" data-sort="ResponsibilityInfo">Сведения об ответст-ти</th>
                            <th class="sortable" data-sort="Sigla">Сигла</th>
                            <th class="sortable" data-sort="OrganizationName">Название организации</th>
                            <th class="sortable" data-sort="ThirdAuthor">Третий автор</th>
                            <th class="sortable" data-sort="MaterialDesignation">Обозначение материала</th>
                            <th class="sortable" data-sort="PrintRun">Тираж издания</th>
                            <th class="sortable" data-sort="Binding">Переплет</th>
                            <th class="sortable" data-sort="PrintedSheets">Объем печат.листов</th>
                            <th class="sortable" data-sort="SystemRequirements">Системные требования</th>
                            <th class="sortable" data-sort="ResponsibilityArea">Область ответственности</th>
                            <th class="sortable" data-sort="DocumentEmail">Электронный адрес документа</th>
                            <th class="sortable" data-sort="TimeInterval">Интервал</th>
                            <th class="fixed-menu">Действия</th>
                        </tr>
                    </thead>
                    <tbody id="book-table-body">
        <!-- Данные загружаются динамически -->
    </tbody>
                </table>

        </main>
    </div>
    <!-- Модальное окно -->
    <div id="addModal" class="modal" >
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Добавить новую запись</h2>

            <form id="addBookForm" class="form-grid">
                <input type="hidden" name="table" value="bookss">

                <div><label for="inventory_number">Инвентарный номер</label><input type="text" id="inventory_number" name="inventory_number" required></div>
                <div><label for="record_date">Дата</label><input type="date" id="record_date" name="record_date" required></div>
                <div><label for="publication_type">Вид издания</label><input type="text" id="publication_type" name="publication_type"></div>
                <div><label for="authors">Автор(ы)</label><input type="text" id="authors" name="authors"></div>
                <div><label for="secondary_author">Второй автор</label><input type="text" id="secondary_author" name="secondary_author"></div>
                <div><label for="tertiary_author">Третий автор</label><input type="text" id="tertiary_author" name="tertiary_author"></div>
                <div><label for="responsibility_info">Ответственность</label><input type="text" id="responsibility_info" name="responsibility_info"></div>
                <div><label for="title">Название</label><input type="text" id="title" name="title"></div>
                <div><label for="title_info">Связанная информация</label><input type="text" id="title_info" name="title_info"></div>
                <div><label for="edition_info">Информация об издании</label><input type="text" id="edition_info" name="edition_info"></div>
                <div><label for="series">Серия</label><input type="text" id="series" name="series"></div>
                <div><label for="city">Место издания</label><input type="text" id="city" name="city"></div>
                <div><label for="publisher">Издатель</label><input type="text" id="publisher" name="publisher"></div>
                <div><label for="publication_year">Год</label><input type="number" id="publication_year" name="publication_year"></div>
                <div><label for="pages">Объем издания</label><input type="number" id="pages" name="pages"></div>
                <div><label for="printed_sheets_volume">Объем печат.листов</label><input type="number" step="0.1" id="printed_sheets_volume" name="printed_sheets_volume"></div>
                <div><label for="isbn">ISBN</label><input type="text" id="isbn" name="isbn"></div>
                <div><label for="organization_country">Страна</label><input type="text" id="organization_country" name="organization_country"></div>
                <div><label for="copies">Количество экземпляров</label><input type="number" id="copies" name="copies"></div>
                <div><label for="price">Цена (тенге)</label><input type="number" step="0.01" id="price" name="price"></div>
                <div><label for="circulation">Тираж</label><input type="number" id="circulation" name="circulation"></div>
                <div><label for="material_type">Обозначение материала</label><input type="text" id="material_type" name="material_type"></div>
                <div><label for="summary">Краткое содержание</label><textarea id="summary" name="summary"></textarea></div>
                <div><label for="notes">Примечания</label><textarea id="notes" name="notes"></textarea></div>
                <div><label for="illustrations">Иллюстрации</label><input type="text" id="illustrations" name="illustrations"></div>
                <div><label for="binding">Переплёт</label><input type="text" id="binding" name="binding"></div>
                <div><label for="verification_mark_1">Отметка о проверке №1, год</label><input type="number" id="verification_mark_1" name="verification_mark_1"></div>
                <div><label for="verification_mark_2">Отметка о проверке №2, год</label><input type="number" id="verification_mark_2" name="verification_mark_2"></div>
                <div><label for="verification_mark_3">Отметка о проверке №3, год</label><input type="number" id="verification_mark_3" name="verification_mark_3"></div>
                <div><label for="sigla">Сигла</label><input type="text" id="sigla" name="sigla"></div>
                <div><label for="organization_name">Название организации</label><input type="text" id="organization_name" name="organization_name"></div>
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
            <input type="hidden" name="table" value="bookss">
            <div><label for="inventory_number">Инвентарный номер</label><input type="text" id="inventory_number" name="inventory_number" required></div>
            <div><label for="record_date">Дата</label><input type="date" id="record_date" name="record_date" required></div>
            <div><label for="publication_type">Вид издания</label><input type="text" id="publication_type" name="publication_type"></div>
            <div><label for="authors">Автор(ы)</label><input type="text" id="authors" name="authors"></div>
            <div><label for="secondary_author">Второй автор</label><input type="text" id="secondary_author" name="secondary_author"></div>
            <div><label for="tertiary_author">Третий автор</label><input type="text" id="tertiary_author" name="tertiary_author"></div>
            <div><label for="responsibility_info">Ответственность</label><input type="text" id="responsibility_info" name="responsibility_info"></div>
            <div><label for="title">Название</label><input type="text" id="title" name="title"></div>
            <div><label for="title_info">Связанная информация</label><input type="text" id="title_info" name="title_info"></div>
            <div><label for="edition_info">Информация об издании</label><input type="text" id="edition_info" name="edition_info"></div>
            <div><label for="series">Серия</label><input type="text" id="series" name="series"></div>
            <div><label for="city">Место издания</label><input type="text" id="city" name="city"></div>
            <div><label for="publisher">Издатель</label><input type="text" id="publisher" name="publisher"></div>
            <div><label for="publication_year">Год</label><input type="number" id="publication_year" name="publication_year"></div>
            <div><label for="pages">Объем издания</label><input type="number" id="pages" name="pages"></div>
            <div><label for="printed_sheets_volume">Объем печат.листов</label><input type="number" step="0.1" id="printed_sheets_volume" name="printed_sheets_volume"></div>
            <div><label for="isbn">ISBN</label><input type="text" id="isbn" name="isbn"></div>
            <div><label for="organization_country">Страна</label><input type="text" id="organization_country" name="organization_country"></div>
            <div><label for="copies">Количество экземпляров</label><input type="number" id="copies" name="copies"></div>
            <div><label for="price">Цена (тенге)</label><input type="number" step="0.01" id="price" name="price"></div>
            <div><label for="circulation">Тираж</label><input type="number" id="circulation" name="circulation"></div>
            <div><label for="material_type">Обозначение материала</label><input type="text" id="material_type" name="material_type"></div>
            <div><label for="summary">Краткое содержание</label><textarea id="summary" name="summary"></textarea></div>
            <div><label for="notes">Примечания</label><textarea id="notes" name="notes"></textarea></div>
            <div><label for="illustrations">Иллюстрации</label><input type="text" id="illustrations" name="illustrations"></div>
            <div><label for="binding">Переплёт</label><input type="text" id="binding" name="binding"></div>
            <div><label for="verification_mark_1">Отметка о проверке №1, год</label><input type="number" id="verification_mark_1" name="verification_mark_1"></div>
            <div><label for="verification_mark_2">Отметка о проверке №2, год</label><input type="number" id="verification_mark_2" name="verification_mark_2"></div>
            <div><label for="verification_mark_3">Отметка о проверке №3, год</label><input type="number" id="verification_mark_3" name="verification_mark_3"></div>
            <div><label for="sigla">Сигла</label><input type="text" id="sigla" name="sigla"></div>
            <div><label for="organization_name">Название организации</label><input type="text" id="organization_name" name="organization_name"></div>
            <div><label for="physical_characteristics">Физ. характеристики</label><input type="text" id="physical_characteristics" name="physical_characteristics"></div>


            <button type="submit" class="submit">Сохранить изменения</button>
        </form>
    </div>
</div>

<script src="../assets/js/library_catalog.js"></script>
<script src="../assets/js/sort.js"></script>
</body>


</html>