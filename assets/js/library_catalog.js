document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modal");
    const addBookForm = document.getElementById("addBookForm");
    const openBtn = document.querySelector(".add-book-btn");
    const closeBtn = document.querySelector(".close");
    let isEditMode = false;
    let editRecordId = null;

    // Открытие окна для добавления
    openBtn.addEventListener("click", function () {
        isEditMode = false;
        editRecordId = null;
        addBookForm.reset();
        modal.style.display = "block";
    });

    // Закрытие окна
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Закрытие по клику вне окна
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Обработка меню для каждой записи с делегированием событий
    document.addEventListener('click', function(e) {
        if (e.target.closest('.menu-btn')) {
            e.stopPropagation();
            document.querySelectorAll('.menu-options').forEach(menu => {
                if (menu !== e.target.closest('.menu-btn').nextElementSibling) {
                    menu.style.display = 'none';
                }
            });

            const menuOptions = e.target.closest('.menu-btn').nextElementSibling;
            menuOptions.style.display = menuOptions.style.display === 'block' ? 'none' : 'block';
        } else if (!e.target.closest('.menu-options')) {
            document.querySelectorAll('.menu-options').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });

    // Удаление записи с делегированием
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-btn')) {
            const id = e.target.getAttribute('data-id');
            const table = 'books';

            if (!confirm("Вы уверены, что хотите удалить эту запись?")) {
                return;
            }

            fetch("../php/delete_data.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ table: table, id: id })
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => {
                console.error("Ошибка:", error);
                alert("Произошла ошибка при удалении.");
            });
        }
    });

    // Редактирование записи
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('edit-btn')) {
            const bookId = e.target.dataset.id;
            openEditModal(bookId);
        }
    });

    function openEditModal(bookId) {
        const tableName = "books";
        modal.style.display = 'block';
        
        fetch(`get_data.php?id=${bookId}`)
            .then(response => response.json())
            .then(data => {
                Object.keys(data).forEach(key => {
                    if (document.getElementById(key)) {
                        document.getElementById(key).value = data[key];
                    }
                });
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert("Произошла ошибка при загрузке данных.");
            });
    }

    // Отправка формы
    addBookForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        if (isEditMode) {
            formData.append("id", editRecordId);
        }

        const actionUrl = isEditMode ? "../php/update_data.php" : "../php/add_data.php";

        fetch(actionUrl, {
            method: "POST",
            body: formData,
        })
        .then((response) => response.text())
        .then((data) => {
            alert(data);
            modal.style.display = "none";
            location.reload();
        })
        .catch((error) => {
            console.error("Ошибка:", error);
            alert("Произошла ошибка при сохранении данных.");
        });
    });

    // Закрытие модального окна
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
});






