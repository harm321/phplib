document.addEventListener("DOMContentLoaded", function () {
    const addModal = document.getElementById("addModal"); // Модальное окно добавления
    const editModal = document.getElementById("editModal"); // Модальное окно редактирования
    const addBookForm = document.getElementById("addBookForm"); // Форма добавления
    const editBookForm = document.getElementById("editBookForm"); // Форма редактирования
    const openAddBtn = document.querySelector(".add-book-btn"); // Кнопка для открытия окна добавления
    const closeBtns = document.querySelectorAll(".close"); // Кнопки закрытия окон
    let editRecordId = null; // Переменная для хранения ID редактируемой записи

    // функция для открытия окна
    function openModal(modal) {
        modal.style.display = "block";
    }

    // функция для закрытия окна
    function closeModal(modal) {
        modal.style.display = "none";
        editRecordId = null; // Сброс ID записи
    }

    // Открытие окна для добавления
    openAddBtn.addEventListener("click", function () {
        addBookForm.reset(); // Сброс формы
        openModal(addModal); // Открываем окно добавления
    });

    // Закрытие окон по кнопке
    closeBtns.forEach((btn) =>
        btn.addEventListener("click", function () {
            closeModal(addModal);
            closeModal(editModal);
        })
    );

    // Закрытие окна по клику вне его
    window.addEventListener("click", (event) => {
        if (event.target === addModal) closeModal(addModal);
        if (event.target === editModal) closeModal(editModal);
    });

    // Обработка меню
    document.addEventListener("click", function (e) {
        if (e.target.closest(".menu-btn")) {
            const menuOptions = e.target.closest(".menu-btn").nextElementSibling;
            toggleMenu(menuOptions);
        } else if (!e.target.closest(".menu-options")) {
            closeAllMenus();
        }
    });

    function toggleMenu(menuOptions) {
        document.querySelectorAll(".menu-options").forEach((menu) => {
            if (menu !== menuOptions) {
                menu.style.display = "none";
            }
        });
        menuOptions.style.display =
            menuOptions.style.display === "block" ? "none" : "block";
    }

    function closeAllMenus() {
        document.querySelectorAll(".menu-options").forEach((menu) => {
            menu.style.display = "none";
        });
    }

    // Удаление записи
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-btn")) {
            const id = e.target.getAttribute("data-id");
            const table = "books";

            if (confirm("Вы уверены, что хотите удалить эту запись?")) {
                sendRequest("../php/delete_data.php", { table, id })
                    .then((data) => {
                        alert(data);
                        location.reload();
                    })
                    .catch((error) => {
                        console.error("Ошибка:", error);
                        alert("Произошла ошибка при удалении.");
                    });
            }
        }
    });

    // Открытие окна для редактирования
    document.addEventListener("click", function (e) {
        if (e.target.closest(".edit-btn")) {
            const bookId = e.target.closest(".edit-btn").getAttribute("data-id");
            loadAndOpenEditModal(bookId);
        }
    });

    function loadAndOpenEditModal(bookId) {
        const tableName = "books";
        editRecordId = bookId; // Сохраняем ID записи
        openModal(editModal); // Открываем окно редактирования

        fetch(`../php/get_data.php?id=${bookId}&table=${tableName}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    alert(data.error);
                    closeModal(editModal);
                    return;
                }
                populateEditForm(data);
            })
            .catch((error) => {
                console.error("Ошибка загрузки данных:", error);
                alert("Произошла ошибка при загрузке данных.");
                closeModal(editModal);
            });
    }

    function populateEditForm(data) {
        Object.keys(data).forEach((key) => {
            const inputElement = editBookForm.querySelector(`[name="${key}"]`);
            if (inputElement) {
                inputElement.value = data[key];
            }
        });
    }

    // Отправка формы добавления
    addBookForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(addBookForm);
        handleSubmit("../php/add_data.php", formData, addModal);
    });

    // Отправка формы редактирования
    editBookForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(editBookForm);
        formData.append("id", editRecordId); //  id записи для редактирования
        handleSubmit("../php/updata_data.php", formData, editModal);
    });

    // функция отправки данных на сервер
    function handleSubmit(url, formData, modal) {
        console.log("Данные формы:", Array.from(formData.entries()));
        fetch(url, { method: "POST", body: formData })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Ошибка сети");
                }
                return response.text();
            })
            .then((data) => {
                if (data.startsWith("<")) {
                    console.error("Получен HTML-код вместо текста:", data);
                    alert("Произошла ошибка на сервере.");
                } else {
                    alert(data); 
                    closeModal(modal); 
                    location.reload(); 
                }
            })
            .catch((error) => {
                console.error("Ошибка сохранения:", error);
            });
    }
    



    //  функция отправки POST-запросов
    function sendRequest(url, data) {
        return fetch(url, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams(data),
        }).then((response) => response.text());
    }
});


