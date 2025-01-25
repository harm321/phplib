let offset = 0;
const limit = 50;
let isLoading = false;
let currentSearch = ''; // Текущий поисковый запрос
let currentSortBy = 'Title'; // Поле для сортировки (по умолчанию)
let currentSortOrder = 'ASC'; // Порядок сортировки (по умолчанию)

let selectedBooks = []; // Массив для хранения инвентарных номеров выбранных книг
let totalBooksCount = 0; // Общее количество книг

// Функция загрузки данных
async function loadBooks(reset = false) {
    if (isLoading) return;
    isLoading = true;

    try {
        if (reset) {
            offset = 0;
            document.getElementById('book-table-body').innerHTML = '';
        }

        const response = await fetch(
            `../php/db.php?offset=${offset}&limit=${limit}&search=${encodeURIComponent(currentSearch)}&sort_by=${currentSortBy}&sort_order=${currentSortOrder}`
        );
        const data = await response.json();

        const books = data.books;
        totalBooksCount = data.totalBooks; // Получаем общее количество книг

        if (books.length === 0) {
            window.removeEventListener('scroll', handleScroll);
            return;
        }

        // Обновляем отображение общего количества книг
        const totalCountElement = document.getElementById('header-subtitle2');
        if (totalCountElement) {
            totalCountElement.textContent = `Всего книг: ${totalBooksCount}`;
        }

        const tbody = document.getElementById('book-table-body');

        // Генерация строк
        books.forEach(book => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class='fixed-checkbox'><input type='checkbox' class='row-checkbox' data-inventory='${book.InventoryNumber}'></td>
                <td>${book.InventoryNumber}</td>
                <td>${book.Authors}</td>
                <td>${book.Title}</td>
                <td>${book.PublicationType}</td>
                <td>${book.PlaceOfPublication}</td>
                <td>${book.Publisher}</td>
                <td>${book.Year}</td>
                <td>${book.Volume}</td>
                <td>${book.Language}</td>
                <td>${book.ISBN}</td>
                <td>${book.Category}</td>
                <td>${book.Keyword}</td>
                <td>${book.UDC}</td>
                <td>${book.BBK}</td>
                <td>${book.Series}</td>
                <td>${book.Content}</td>
                <td>${book.Label}</td>
                <td>${book.SecondAuthor}</td>
                <td>${book.TitleRelatedInfo}</td>
                <td>${book.RecordDate}</td>
                <td>${book.RecordTime}</td>
                <td>${book.Price}</td>
                <td>${book.Notes}</td>
                <td>${book.DecommissionActNumber}</td>
                <td>${book.Copies}</td>
                <td>${book.AuthorSign}</td>
                <td>${book.ResponsibilityInfo}</td>
                <td>${book.Sigla}</td>
                <td>${book.OrganizationName}</td>
                <td>${book.ThirdAuthor}</td>
                <td>${book.MaterialDesignation}</td>
                <td>${book.PrintRun}</td>
                <td>${book.Binding}</td>
                <td>${book.PrintedSheets}</td>
                <td>${book.SystemRequirements}</td>
                <td>${book.ResponsibilityArea}</td>
                <td>${book.DocumentEmail}</td>
                <td>${book.TimeInterval}</td>
                <td class='fixed-menu'>
                    <button class='menu-btn'>
                        <img src='../assets/img/library-dashboard/menu-ico.svg' alt='Меню' class='menu-icon' title='Меню'>
                    </button>
                    <div class='menu-options'>
                        <button class='menu-icon-btn edit-btn' data-id='${book.InventoryNumber}'>
                            <img src='../assets/img/library-dashboard/edit-ico.svg' alt='Редактировать' class='menu-icon' title='Редактировать'>
                        </button>
                        <button class='menu-icon-btn delete-btn' data-id='${book.InventoryNumber}'>
                            <img src='../assets/img/library-dashboard/delete-ico.svg' alt='Удалить' class='menu-icon' title='Удалить'>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });

        offset += limit;
    } catch (error) {
        console.error('Ошибка загрузки данных:', error);
    } finally {
        isLoading = false;
    }
}

// Обработчик сортировки
document.querySelectorAll('th[data-sort]').forEach(header => {
    header.addEventListener('click', () => {
        const sortBy = header.getAttribute('data-sort');

        // Если нажали на тот же столбец, меняем порядок сортировки
        if (currentSortBy === sortBy) {
            currentSortOrder = currentSortOrder === 'ASC' ? 'DESC' : 'ASC';
        } else {
            currentSortBy = sortBy;
            currentSortOrder = 'ASC'; // По умолчанию при смене столбца
        }

        loadBooks(true); // Перезагружаем данные с новой сортировкой
    });
});

// Обработчик поиска
document.getElementById('search-input').addEventListener('input', (e) => {
    currentSearch = e.target.value.trim();
    loadBooks(true);
});

// Обработчик прокрутки
function handleScroll() {
    const scrollPosition = window.innerHeight + window.scrollY;
    const threshold = document.body.offsetHeight - 200;

    if (scrollPosition >= threshold) {
        loadBooks();
    }
}

// Инициализация
document.addEventListener('DOMContentLoaded', () => {
    loadBooks();
    window.addEventListener('scroll', handleScroll);
});

// Обработчик для "Выбрать все" чекбоксы
const selectAllCheckbox = document.getElementById('selectAll');
const headerSubtitle = document.getElementById('header-subtitle');

// Функция для обновления текста в заголовке
function updateSelectedCount() {
    const selectedCount = selectedBooks.length;
    headerSubtitle.textContent = `${selectedCount} книг выбрано`;
}

// Устанавливаем обработчик для "Выбрать все"
selectAllCheckbox.addEventListener('change', function() {
    const isChecked = selectAllCheckbox.checked;

    // Обновляем массив выбранных книг
    selectedBooks = isChecked ? [...document.querySelectorAll('.row-checkbox')].map(checkbox => checkbox.getAttribute('data-inventory')) : [];

    // Обновляем состояние чекбоксов
    document.querySelectorAll('.row-checkbox').forEach(checkbox => {
        checkbox.checked = isChecked;
    });

    updateSelectedCount(); // Обновляем количество после изменения состояния
});

// Добавляем обработчик для новых чекбоксов
document.getElementById('book-table-body').addEventListener('change', function(e) {
    if (e.target.classList.contains('row-checkbox')) {
        const inventoryNumber = e.target.getAttribute('data-inventory');
        if (e.target.checked) {
            selectedBooks.push(inventoryNumber);
        } else {
            selectedBooks = selectedBooks.filter(item => item !== inventoryNumber);
        }
        updateSelectedCount();

        // Обновляем состояние "Выбрать все"
        const allChecked = [...document.querySelectorAll('.row-checkbox')].every(checkbox => checkbox.checked);
        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = !allChecked && [...document.querySelectorAll('.row-checkbox')].some(checkbox => checkbox.checked);
    }
});



// начальное количество выбранных чекбоксов
updateSelectedCount();

// Обработчик для кнопки "Экспортировать"
const exportButton = document.querySelector('.export-btn');

exportButton.addEventListener('click', function() {
    const selectedRows = selectedBooks.map(inventoryNumber => {
        const row = [...document.querySelectorAll('.row-checkbox')].find(checkbox => checkbox.getAttribute('data-inventory') === inventoryNumber).closest('tr');
        const rowData = [];
        row.querySelectorAll('td').forEach((cell, index) => {
            if (index !== 0) { // Пропускаем первый столбец
                rowData.push(cell.textContent.trim()); // Собираем текст из каждой ячейки строки
            }
        });
        return rowData;
    });

    const headers = [
        "Инвентарный номер", "Автор(ы)", "Название издания", "Вид издания", "Место издания", "Издательство", "Год",
        "Объем издания", "Язык", "ISBN", "Рубрика", "Ключевое слово", "УДК", "ББК", "Серия", "Содержание", "Гриф",
        "Второй автор", "Свед.относящ.к заглав.", "Дата", "время записи", "Цена", "Примечание", "№ акта выбытия",
        "Количество экземпляров", "Авторский знак", "Сведения об ответст-ти",
        "Сигла", "Название организации", "Третий автор", "Обозначение материала", "Тираж издания", "Переплет",
        "Объем печат.листов", "Системные требования", "Область ответственности", "Электронный адрес документа", "Интервал"
    ];

    if (selectedRows.length > 0) {
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.aoa_to_sheet([headers, ...selectedRows]);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Книги');
        XLSX.writeFile(workbook, 'selected_books.xlsx');
    } else {
        alert('Выберите хотя бы одну книгу для экспорта.');
    }
});
