console.log("JavaScript файл подключен!");

// Объявляем dbHandler до его использования
let dbHandler; // Объявляем переменную dbHandler

document.addEventListener('DOMContentLoaded', function() {
    // Убедитесь, что класс DatabaseHandler определен
    if (typeof DatabaseHandler !== 'undefined') {
        dbHandler = new DatabaseHandler(); // Инициализируем dbHandler здесь
    } else {
        console.error("Класс DatabaseHandler не определен!");
        return; // Прекращаем выполнение, если класс не определен
    }

    // Обработчик открытия модального окна
    const addBookBtn = document.querySelector('.add-book-btn');
    if (addBookBtn) {
        addBookBtn.addEventListener('click', function() {
            document.getElementById('addBookModal').style.display = 'block';
        });
    } else {
        console.error("Кнопка добавления книги не найдена!");
    }

    // Обработчик закрытия модального окна
    const closeModalBtn = document.querySelector('.close');
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            document.getElementById('addBookModal').style.display = 'none';
        });
    } else {
        console.error("Кнопка закрытия модального окна не найдена!");
    }

    // Убедитесь, что элемент с ID 'addBookForm' существует на странице
    const addBookForm = document.getElementById('addBookForm');
    if (addBookForm) {
        addBookForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            // ... остальной код для обработки формы добавления книги ...
        });
    } else {
        console.error("Форма добавления книги не найдена!");
    }

    // Закомментированные функции, которые не нужны для отображения данных в таблице
    /*
    // Обработка удаления
    document.addEventListener('click', async function (e) {
        const deleteBtn = e.target.closest('.delete-btn');
        if (deleteBtn) {
            const id = deleteBtn.dataset.id;
            if (confirm('Вы уверены, что хотите удалить эту запись?')) {
                try {
                    const result = await dbHandler.deleteRecord(id);
                    if (result.success) {
                        loadTableData(); // Перезагружаем таблицу
                    }
                } catch (error) {
                    console.error('Ошибка удаления записи:', error);
                }
            }
        }
    });

    // Обработка сортировки
    const sortButton = document.getElementById('applySort');
    if (sortButton) {
        sortButton.addEventListener('click', function () {
            const column = document.getElementById('sortColumn').value;
            const direction = document.getElementById('sortDirection').value;
            loadTableData(column, direction);
        });
    }

    // Обработка экспорта
    const exportButton = document.querySelector('.export-button');
    if (exportButton) {
        exportButton.addEventListener('click', function () {
            // Здесь можно добавить логику экспорта
            alert('Функция экспорта в разработке');
        });
    }
    */

    // Функция загрузки данных
    async function loadTableData(sortColumn = '', sortDirection = 'ASC') {
        try {
            const response = await dbHandler.fetchData(sortColumn, sortDirection);
            console.log('Получены данные:', response); // Для отладки
            
            if (response.success && Array.isArray(response.data)) {
                updateTableData(response.data);
            } else {
                console.error('Неверный формат данных:', response);
            }
        } catch (error) {
            console.error('Ошибка загрузки данных:', error);
        }
    }

    // Функция обновления данных в существующей таблице
    function updateTableData(data) {
        const tbody = document.querySelector('table tbody');
        tbody.innerHTML = '';
        
        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="fixed-checkbox">
                    <input type="checkbox" class="row-checkbox">
                </td>
                <td>${row.inventory_number || ''}</td>
                <td>${row.inventory_date || ''}</td>
                <td>${row.publication_type || ''}</td>
                <td>${row.authors || ''}</td>
                <td>${row.second_author || ''}</td>
                <td>${row.third_author || ''}</td>
                <td>${row.responsibility_info || ''}</td>
                <td>${row.title || ''}</td>
                <td>${row.title_related_info || ''}</td>
                <td>${row.publication_info || ''}</td>
                <td>${row.series || ''}</td>
                <td>${row.material_type || ''}</td>
                <td>${row.publication_place || ''}</td>
                <td>${row.publisher || ''}</td>
                <td>${row.year_of_publication || ''}</td>
                <td>${row.page_count || ''}</td>
                <td>${row.printed_sheets || ''}</td>
                <td>${row.mark || ''}</td>
                <td>${row.isbn || ''}</td>
                <td>${row.country || ''}</td>
                <td>${row.copies || ''}</td>
                <td>${row.price || ''}</td>
                <td>${row.edition_copies || ''}</td>
                <td>${row.category || ''}</td>
                <td>${row.keywords || ''}</td>
                <td>${row.bbk_index || ''}</td>
                <td>${row.udc_index || ''}</td>
                <td>${row.grnti_index || ''}</td>
                <td>${row.author_sign || ''}</td>
                <td>${row.language || ''}</td>
                <td>${row.summary || ''}</td>
                <td>${row.notes || ''}</td>
                <td>${row.illustrations || ''}</td>
                <td>${row.binding || ''}</td>
                <td>${row.verification_mark_1 || ''}</td>
                <td>${row.verification_mark_2 || ''}</td>
                <td>${row.verification_mark_3 || ''}</td>
                <td>${row.sigla || ''}</td>
                <td>${row.organization_name || ''}</td>
                <td>${row.html_link || ''}</td>
                <td>${row.physical_characteristics || ''}</td>
                <td>${row.system_requirements || ''}</td>
                <td class="fixed-menu">
                    <button class="menu-btn">
                        <img src="./img/library-dashboard/menu-ico.svg" alt="Меню" class="menu-icon">
                    </button>
                    <div class="menu-options">
                        <button class="menu-icon-btn edit-btn" data-id="${row.inventory_number}">
                            <img src="./img/library-dashboard/edit-ico.svg" alt="Редактировать" class="menu-icon">
                        </button>
                        <button class="menu-icon-btn delete-btn" data-id="${row.inventory_number}">
                            <img src="./img/library-dashboard/delete-ico.svg" alt="Удалить" class="menu-icon">
                        </button>
                    </div>
                </td>`;
            tbody.appendChild(tr);
        });

        // Обновляем счетчик книг
        updateBookCount();
        
        // Для отладки
        console.log('Обновлена таблица. Количество записей:', data.length);
        console.log('Данные:', data);
    }

    // Загружаем данные при загрузке страницы
    loadTableData();
});
