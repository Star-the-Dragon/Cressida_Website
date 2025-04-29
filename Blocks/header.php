<table border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td width="100" align="left">
            <div class="dropdown">
                <a href="woman.php" class="nav-link">Женщины</a>
                <div class="dropdown-content">
                    <a href="/leather_w.php">Дубленки и кожа</a>
                    <a href="/furs_w.php">Меха</a>
                </div>
            </div>
        </td>
        <td width="100" align="left">
            <div class="dropdown">
                <a href="man.php" class="nav-link">Мужчины</a>
                <div class="dropdown-content">
                    <a href="/coat_m.php">Пальто</a>
                    <a href="/leather_m.php">Дубленки и кожа</a>
                </div>
            </div>
        </td>
        <td width="150" align="center">
            <a href="index.php"><img src="Images/logo.png" alt="Логотип" align="center" width="110%" height="110%"></a>
        </td>
        <td width="150" align="right">
            <?php
                session_start();
                if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
                    echo '
                    <a href="/Cart.php" class="nav-link">КОРЗИНА</a>
                    <a href="/account.php"><img src="Images/profile.webp" alt="Профиль" class="trigger"></a>
                    ';                    
                }
                else{
                    echo '
                        <img src="Images/profile.webp" alt="Профиль" class="trigger" id="trigger">
                        <div class="modal" id="modal">
                            <div class="modal-content">
                                <span class="close" id="close">&times;</span>
                                <h2>Личный кабинет</h2>
                                <div class="tabs">
                                    <button class="tab-btn" id="login-tab">Авторизоваться</button>
                                    <button class="tab-btn" id="register-tab">Зарегистрироваться</button>
                                </div>
                                <div class="tab-content" id="login-content">
                                    <form id="loginForm" action="Php/Login.php" method="post">
                                        <input name="email" type="email" placeholder="Email" class="input-field" required>
                                        <input id="password-input" name="password" type="password" placeholder="Пароль" class="input-field" required>
                                        <label style="font-size: 13px;"><input type="checkbox" id="togglePassword">Показать пароль</label>
                                        <br>
                                        <a href="#" class="forgot-password">Забыли свой пароль?</a>
                                        <button class="submit-btn">Войти</button>
                                    </form>
                                </div>
                                <div class="tab-content" id="register-content" style="display: none;">
                                    <form id="RegisterForm" action="Php/Register.php" method="post">
                                        <input name="login" type="text" placeholder="Логин" class="input-field" required>
                                        <input name="name" type="text" placeholder="Имя" class="input-field" required>
                                        <input name="surname" type="text" placeholder="Фамилия" class="input-field" required>
                                        <input name="email" type="email" placeholder="Email" class="input-field" required>
                                        <input name="phone" type="tel" placeholder="X-XXX-XXX-XX-XX" class="input-field pattern="[0-9]{1}[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" required>
                                        <input id="password-input" name="password" type="text" placeholder="Пароль" class="input-field" required>
                                        <br>
                                        <label style="font-size: 13px;">
                                            <input type="checkbox" required >Подписываясь на рассылку, Вы даёте<a href="personal-data-processing.php" class="Links" style="font-size: 13px;"> Согласие на обработку персональных данных</a>, а также подтверждаете, что ознакомлены с <a href="/Privacy-Policy.php" class="Links"style="font-size: 13px;">Политикой конфиденциальности</a>
                                        </label>
                                        <button class="submit-btn" type="submit">Зарегистрироваться</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                }
            ?>
        </td>
    </tr>
</table>
<table border="0" width="100%" cellpadding="5" cellpaccing="0" align="center" bgcolor="#e4e7e7">
    <tr>
        <td align="center"><a href="/Onas.php" class="nav-link">О НАС</a></td>
        <!-- <td align="center"><a href="/Delivery.php" class="nav-link">ДОСТАВКА</a></td>
        <td align="center"><a href="/Payment.php" class="nav-link">ОПЛАТА</a></td> -->
        <td align="center"><a href="/Magazines.php" class="nav-link">МАГАЗИНЫ</a></td>
        <td align="center"><a href="/Contacts.php" class="nav-link">КОНТАКТЫ</a></td>
    </tr>
</table>

<script>
    document.getElementById('togglePassword').addEventListener('change', function() {
        var passwordField = document.getElementById('password-input');
        if (this.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
</script>