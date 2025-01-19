<!DOCTYPE html>
<html lang="ru">

<head>
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Приход книг</title>
    <link rel="stylesheet" href="../assets/css/library_catalog.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
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
            <div class="header">
                <h1 id="header-title">Библиотечный каталог</h1>
                <p id="header-subtitle">N книг</p>
            </div>
            <button class="button-action add-book-btn"><img src="../assets/img/ico-reader.svg"
                            alt="Иконка добавления читателя" class="button-icon">Добавить новую запись</button>
            <button class="button-action export-btn"><img src="../assets/img/ico-export.svg" alt="Иконка экспорта"
                            class="button-icon">Экспортировать</button>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th class="fixed-checkbox">
                                <input type="checkbox" id="selectAll" class="select-all-checkbox">
                            </th>
                            <th>Инвентарный номер</th>
                            <th>Дата зап. в инв.кн.</th>
                            <th>Вид издания</th>
                            <th>Автор(ы) издания</th>
                            <th>Второй автор</th>
                            <th>Третий автор</th>
                            <th>Сведения об ответст-ти</th>
                            <th>Название издания</th>
                            <th>Свед.относящ.к заглав.</th>
                            <th>Сведения об издании</th>
                            <th>Серия</th>
                            <th>Обозначение материала</th>
                            <th>Место издания</th>
                            <th>Издательство</th>
                            <th>Год издания</th>
                            <th>Объем страниц</th>
                            <th>Объем печат.листов</th>
                            <th>Гриф</th>
                            <th>ISBN</th>
                            <th>Страна производителя</th>
                            <th>Количество экземпляров</th>
                            <th>Цена (тенге)</th>
                            <th>Тираж издания</th>
                            <th>Рубрика</th>
                            <th>Ключевое слово</th>
                            <th>Индекс ББК</th>
                            <th>Индекс УДК</th>
                            <th>Индекс ГРНТИ</th>
                            <th>Авторский знак</th>
                            <th>Язык текста</th>
                            <th>Краткое содержание</th>
                            <th>Примечание</th>
                            <th>Иллюстрация</th>
                            <th>Переплет</th>
                            <th>Отметка о проверке №1, год</th>
                            <th>Отметка о проверке №2, год</th>
                            <th>Отметка о проверке №3, год</th>
                            <th>Сигла</th>
                            <th>Название организации</th>
                            <th>HTML ссылка</th>
                            <th>Физические характеристики</th>
                            <th>Системные требования</th>
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
    <div id="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Добавить новую запись</h2>

            <form id="addBookForm" class="form-grid">
                <input type="hidden" name="table" value="books">

                <div><label for="inventoryNumber">Инвентарный номер</label><input type="text" id="inventoryNumber" name="inventory_number" required></div>
                <div><label for="inventoryDate">Дата зап. в инв.кн.</label><input type="date" id="inventoryDate" name="inventory_date" required></div>
                <div><label for="publicationType">Вид издания</label><input type="text" id="publicationType" name="publication_type"></div>
                <div><label for="authors">Автор(ы)</label><input type="text" id="authors" name="authors"></div>
                <div><label for="secondAuthor">Второй автор</label><input type="text" id="secondAuthor" name="second_author"></div>
                <div><label for="thirdAuthor">Третий автор</label><input type="text" id="thirdAuthor" name="third_author"></div>
                <div><label for="responsibilityInfo">Ответственность</label><input type="text" id="responsibilityInfo" name="responsibility_info"></div>
                <div><label for="title">Название</label><input type="text" id="title" name="title"></div>
                <div><label for="titleRelatedInfo">Связанная информация</label><input type="text" id="titleRelatedInfo" name="title_related_info"></div>
                <div><label for="publicationInfo">Информация об издании</label><input type="text" id="publicationInfo" name="publication_info"></div>
                <div><label for="series">Серия</label><input type="text" id="series" name="series"></div>
                <div><label for="materialType">Тип материала</label><input type="text" id="materialType" name="material_type"></div>
                <div><label for="publicationPlace">Место издания</label><input type="text" id="publicationPlace" name="publication_place"></div>
                <div><label for="publisher">Издатель</label><input type="text" id="publisher" name="publisher"></div>
                <div><label for="yearOfPublication">Год издания</label><input type="number" id="yearOfPublication" name="year_of_publication"></div>
                <div><label for="pageCount">Страниц</label><input type="number" id="pageCount" name="page_count"></div>
                <div><label for="printedSheets">Печатные листы</label><input type="number" step="0.1" id="printedSheets" name="printed_sheets"></div>
                <div><label for="mark">Марка</label><input type="text" id="mark" name="mark"></div>
                <div><label for="isbn">ISBN</label><input type="text" id="isbn" name="isbn"></div>
                <div><label for="country">Страна</label><input type="text" id="country" name="country"></div>
                <div><label for="copies">Экземпляры</label><input type="number" id="copies" name="copies"></div>
                <div><label for="price">Цена (тенге)</label><input type="number" step="0.01" id="price" name="price"></div>
                <div><label for="editionCopies">Тираж</label><input type="number" id="editionCopies" name="edition_copies"></div>
                <div><label for="category">Категория</label><input type="text" id="category" name="category"></div>
                <div><label for="keywords">Ключевые слова</label><input type="text" id="keywords" name="keywords"></div>
                <div><label for="bbkIndex">ББК</label><input type="text" id="bbkIndex" name="bbk_index"></div>
                <div><label for="udcIndex">УДК</label><input type="text" id="udcIndex" name="udc_index"></div>
                <div><label for="grntiIndex">ГРНТИ</label><input type="text" id="grntiIndex" name="grnti_index"></div>
                <div><label for="authorSign">Авторский знак</label><input type="text" id="authorSign" name="author_sign"></div>
                <div><label for="language">Язык</label><input type="text" id="language" name="language"></div>
                <div><label for="summary">Краткое содержание</label><textarea id="summary" name="summary"></textarea></div>
                <div><label for="notes">Примечания</label><textarea id="notes" name="notes"></textarea></div>
                <div><label for="illustrations">Иллюстрации</label><input type="text" id="illustrations" name="illustrations"></div>
                <div><label for="binding">Переплёт</label><input type="text" id="binding" name="binding"></div>
                <div><label for="verificationMark1">Проверка 1</label><input type="number" id="verificationMark1" name="verification_mark_1"></div>
                <div><label for="verificationMark2">Проверка 2</label><input type="number" id="verificationMark2" name="verification_mark_2"></div>
                <div><label for="verificationMark3">Проверка 3</label><input type="number" id="verificationMark3" name="verification_mark_3"></div>
                <div><label for="sigla">Сигла</label><input type="text" id="sigla" name="sigla"></div>
                <div><label for="organizationName">Организация</label><input type="text" id="organizationName" name="organization_name"></div>
                <div><label for="physicalCharacteristics">Физ. характеристики</label><input type="text" id="physicalCharacteristics" name="physical_characteristics"></div>

                <button type="submit" class="submit">Добавить запись</button>
            </form>
        </div>
    </div>
    <!-- Модальное окно для редактирования -->
<div id="editModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Редактировать запись</h2>

        <form id="editBookForm" class="form-grid">
            <input type="hidden" id="editId" name="id"> <!-- ID записи для редактирования -->

            <div><label for="editInventoryNumber">Инвентарный номер</label><input type="text" id="editInventoryNumber" name="inventory_number" required></div>
            <div><label for="editInventoryDate">Дата зап. в инв.кн.</label><input type="date" id="editInventoryDate" name="inventory_date" required></div>
            <div><label for="editPublicationType">Вид издания</label><input type="text" id="editPublicationType" name="publication_type"></div>
            <div><label for="editAuthors">Автор(ы)</label><input type="text" id="editAuthors" name="authors"></div>
            <div><label for="editSecondAuthor">Второй автор</label><input type="text" id="editSecondAuthor" name="second_author"></div>
            <div><label for="editThirdAuthor">Третий автор</label><input type="text" id="editThirdAuthor" name="third_author"></div>
            <div><label for="editResponsibilityInfo">Ответственность</label><input type="text" id="editResponsibilityInfo" name="responsibility_info"></div>
            <div><label for="editTitle">Название</label><input type="text" id="editTitle" name="title"></div>
            <div><label for="editTitleRelatedInfo">Связанная информация</label><input type="text" id="editTitleRelatedInfo" name="title_related_info"></div>
            <div><label for="editPublicationInfo">Информация об издании</label><input type="text" id="editPublicationInfo" name="publication_info"></div>
            <div><label for="editSeries">Серия</label><input type="text" id="editSeries" name="series"></div>
            <div><label for="editMaterialType">Тип материала</label><input type="text" id="editMaterialType" name="material_type"></div>
            <div><label for="editPublicationPlace">Место издания</label><input type="text" id="editPublicationPlace" name="publication_place"></div>
            <div><label for="editPublisher">Издатель</label><input type="text" id="editPublisher" name="publisher"></div>
            <div><label for="editYearOfPublication">Год издания</label><input type="number" id="editYearOfPublication" name="year_of_publication"></div>
            <div><label for="editPageCount">Страниц</label><input type="number" id="editPageCount" name="page_count"></div>
            <div><label for="editPrintedSheets">Печатные листы</label><input type="number" step="0.1" id="editPrintedSheets" name="printed_sheets"></div>
            <div><label for="editMark">Марка</label><input type="text" id="editMark" name="mark"></div>
            <div><label for="editIsbn">ISBN</label><input type="text" id="editIsbn" name="isbn"></div>
            <div><label for="editCountry">Страна</label><input type="text" id="editCountry" name="country"></div>
            <div><label for="editCopies">Экземпляры</label><input type="number" id="editCopies" name="copies"></div>
            <div><label for="editPrice">Цена (тенге)</label><input type="number" step="0.01" id="editPrice" name="price"></div>
            <div><label for="editEditionCopies">Тираж</label><input type="number" id="editEditionCopies" name="edition_copies"></div>
            <div><label for="editCategory">Категория</label><input type="text" id="editCategory" name="category"></div>
            <div><label for="editKeywords">Ключевые слова</label><input type="text" id="editKeywords" name="keywords"></div>
            <div><label for="editBbkIndex">ББК</label><input type="text" id="editBbkIndex" name="bbk_index"></div>
            <div><label for="editUdcIndex">УДК</label><input type="text" id="editUdcIndex" name="udc_index"></div>
            <div><label for="editGrntiIndex">ГРНТИ</label><input type="text" id="editGrntiIndex" name="grnti_index"></div>
            <div><label for="editAuthorSign">Авторский знак</label><input type="text" id="editAuthorSign" name="author_sign"></div>
            <div><label for="editLanguage">Язык</label><input type="text" id="editLanguage" name="language"></div>
            <div><label for="editSummary">Краткое содержание</label><textarea id="editSummary" name="summary"></textarea></div>
            <div><label for="editNotes">Примечания</label><textarea id="editNotes" name="notes"></textarea></div>
            <div><label for="editIllustrations">Иллюстрации</label><input type="text" id="editIllustrations" name="illustrations"></div>
            <div><label for="editBinding">Переплёт</label><input type="text" id="editBinding" name="binding"></div>
            <div><label for="editVerificationMark1">Проверка 1</label><input type="number" id="editVerificationMark1" name="verification_mark_1"></div>
            <div><label for="editVerificationMark2">Проверка 2</label><input type="number" id="editVerificationMark2" name="verification_mark_2"></div>
            <div><label for="editVerificationMark3">Проверка 3</label><input type="number" id="editVerificationMark3" name="verification_mark_3"></div>
            <div><label for="editSigla">Сигла</label><input type="text" id="editSigla" name="sigla"></div>
            <div><label for="editOrganizationName">Организация</label><input type="text" id="editOrganizationName" name="organization_name"></div>
            <div><label for="editPhysicalCharacteristics">Физ. характеристики</label><input type="text" id="editPhysicalCharacteristics" name="physical_characteristics"></div>

            <button type="submit" class="submit">Сохранить изменения</button>
        </form>
    </div>
</div>

</body>
<script src="../assets/js/library_catalog.js"></script>


</html>