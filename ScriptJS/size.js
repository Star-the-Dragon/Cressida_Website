document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.size-button');
    const sizeText = document.getElementById('size-text');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Сбросить активные классы
            buttons.forEach(btn => btn.classList.remove('active'));
            // Установить активный класс
            button.classList.add('active');
            // Сохранить выбранный размер
            const selectedSize = button.getAttribute('data-size');
            sizeText.textContent = selectedSize;
            // Здесь можно сохранить выбранный размер в локальное
            // хранилище, отправить на сервер и т.д.
            //localStorage.setItem('selectedSize', selectedSize);
        });
    });
});