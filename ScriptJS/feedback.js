function openModal() {
    event.preventDefault(); // Предотвращаем переход по ссылке
    document.getElementById('modal').style.display = 'block';
}
function closeModal() {
document.getElementById('modal').style.display = 'none';
showLoginForm(); // Возвращаем назад на форму входа
}

function showRegisterForm() {
document.getElementById('login-form').style.display = 'none';
document.getElementById('register-form').style.display = 'block';
}

function showLoginForm() {
document.getElementById('register-form').style.display = 'none';
document.getElementById('login-form').style.display = 'block';
}

function openFeedbackForm() {
    document.getElementById('feedback-modal').style.display = 'block';
}

function closeFeedbackForm() {
    document.getElementById('feedback-modal').style.display = 'none';
}