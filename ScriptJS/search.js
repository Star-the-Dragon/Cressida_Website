function searchPage() {
    const input = document.getElementById('search');
    const query = input.value.toLowerCase();
    const resultsDiv = document.getElementById('search-results');

    // Очищаем предыдущие результаты
    resultsDiv.innerHTML = '';

    const content = document.body.innerText.toLowerCase();

    // Проверяем наличие запроса в содержимом страницы
    if (content.includes(query) && query !== '') {
        resultsDiv.innerHTML = `<p>Найдено совпадение для: <strong>${input.value}</strong></p>`;
    } else {
        resultsDiv.innerHTML = `<p>Ничего не найдено для: <strong>${input.value}</strong></p>`;
    }
}