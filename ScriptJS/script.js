document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('trigger');
    const modal = document.getElementById('modal');
    const close = document.getElementById('close');
    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const loginContent = document.getElementById('login-content');
    const registerContent = document.getElementById('register-content');

    trigger.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    close.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    loginTab.addEventListener('click', function() {
        loginContent.style.display = 'block';
        registerContent.style.display = 'none';
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
    });

    registerTab.addEventListener('click', function() {
        loginContent.style.display = 'none';
        registerContent.style.display = 'block';
        registerTab.classList.add('active');
        loginTab.classList.remove('active');
    });
});