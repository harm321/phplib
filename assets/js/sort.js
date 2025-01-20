document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('table');
    const headers = table.querySelectorAll('th.sortable');
    const searchInput = document.getElementById('search-input');
    
    // Процесс сортировки
    headers.forEach(header => {
        header.addEventListener('click', function() {
            const index = Array.from(headers).indexOf(header); // Получаем индекс нажатого столбца
            const rows = Array.from(table.querySelectorAll('tbody tr')); // Получаем все строки таблицы
            const currentDirection = header.getAttribute('data-sort') || 'asc'; // Получаем текущее направление сортировки
            const newDirection = currentDirection === 'asc' ? 'desc' : 'asc'; // Переключаем направление

            // Сортируем строки на основе выбранного столбца
            rows.sort((a, b) => {
                const aText = a.cells[index].textContent.trim();
                const bText = b.cells[index].textContent.trim();

                const comparison = aText.localeCompare(bText, 'ru', { numeric: true });
                
                return newDirection === 'asc' ? comparison : -comparison;
            });

            // Перемещаем строки в правильном порядке
            rows.forEach(row => table.querySelector('tbody').appendChild(row));

            // Обновляем атрибуты сортировки
            headers.forEach(header => header.setAttribute('data-sort', 'asc')); // Сбрасываем направление сортировки для всех
            header.setAttribute('data-sort', newDirection); // Устанавливаем новое направление для текущего столбца

            // Обновляем визуальные индикаторы сортировки
            headers.forEach(header => header.classList.remove('asc', 'desc')); // Убираем старые классы
            header.classList.add(newDirection); // Добавляем новый класс для текущего столбца
        });
    });

    // Обработчик для поиска
    searchInput.addEventListener('input', function() {
        const query = searchInput.value.toLowerCase(); // Получаем текст поиска и приводим его к нижнему регистру
        const rows = table.querySelectorAll('tbody tr'); // Получаем все строки таблицы

        rows.forEach(row => {
            let found = false;

            // Проверяем все ячейки строки
            row.querySelectorAll('td').forEach(cell => {
                if (cell.textContent.toLowerCase().includes(query)) {
                    found = true;
                }
            });

            // Если в строке найдено совпадение, показываем строку, иначе скрываем
            row.style.display = found ? '' : 'none';
        });
    });
    // Обработчик для "Выбрать все" чекбокс
    const selectAllCheckbox = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const headerSubtitle = document.getElementById('header-subtitle');

    // Функция для обновления текста в заголовке
    function updateSelectedCount() {
        const selectedCount = [...rowCheckboxes].filter(checkbox => checkbox.checked).length;
        headerSubtitle.textContent = `${selectedCount} книг выбрано`;
    }

    // Устанавливаем обработчик для "Выбрать все"
    selectAllCheckbox.addEventListener('change', function() {
        const isChecked = selectAllCheckbox.checked;
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateSelectedCount(); // Обновляем количество после изменения состояния
    });

    // Обработчик для чекбоксов в строках
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = [...rowCheckboxes].every(checkbox => checkbox.checked);
            selectAllCheckbox.checked = allChecked; // Если все чекбоксы в строках выбраны, устанавливаем "Выбрать все" в состояние checked
            selectAllCheckbox.indeterminate = !allChecked && [...rowCheckboxes].some(checkbox => checkbox.checked); // Если некоторые чекбоксы выбраны, устанавливаем indeterminate
            updateSelectedCount(); // Обновляем количество после изменения состояния
        });
    });

    // Инициализируем начальное количество выбранных чекбоксов
    updateSelectedCount();
    // Обработчик для кнопки "Экспортировать"
    const exportButton = document.querySelector('.export-btn');

    exportButton.addEventListener('click', function() {
        const selectedRows = [...rowCheckboxes].filter(checkbox => checkbox.checked).map(checkbox => {
            const row = checkbox.closest('tr'); // Находим родительскую строку для выбранного чекбокса
            const rowData = [];
            row.querySelectorAll('td').forEach((cell, index) => {
                if (index !== 0) { // Пропускаем первый столбец
                    rowData.push(cell.textContent.trim()); // Собираем текст из каждой ячейки строки
                }
            });
            return rowData;
        });

        // Заголовки столбцов для экспорта
        const headers = [
            "Инвентарный номер", "Дата зап. в инв.кн.", "Вид издания", "Автор(ы) издания", "Второй автор", "Третий автор", "Сведения об ответст-ти",
            "Название издания", "Свед.относящ.к заглав.", "Сведения об издании", "Серия", "Обозначение материала", "Место издания",
            "Издательство", "Год издания", "Объем страниц", "Объем печат.листов", "Гриф", "ISBN", "Страна производителя",
            "Количество экземпляров", "Цена (тенге)", "Тираж издания", "Рубрика", "Ключевое слово", "Индекс ББК", "Индекс УДК",
            "Индекс ГРНТИ", "Авторский знак", "Язык текста", "Краткое содержание", "Примечание", "Иллюстрация", "Переплет",
            "Отметка о проверке №1, год", "Отметка о проверке №2, год", "Отметка о проверке №3, год", "Сигла", "Название организации",
            "HTML ссылка", "Физические характеристики", "Системные требования"
        ];

        if (selectedRows.length > 0) {
            // Добавляем заголовки в начало данных
            selectedRows.unshift(headers);

            // Создаем объект для записи в Excel
            const wb = XLSX.utils.book_new(); // Новый Excel файл
            const ws = XLSX.utils.aoa_to_sheet(selectedRows); // Преобразуем строки в формат листа Excel
            XLSX.utils.book_append_sheet(wb, ws, "Selected Books"); // Добавляем лист в файл
            XLSX.writeFile(wb, 'selected_books.xlsx'); // Загружаем файл
        } else {
            alert('Пожалуйста, выберите хотя бы один элемент для экспорта.');
        }
    });





});
