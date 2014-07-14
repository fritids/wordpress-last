<?php

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
</head>

<body>
    <h3>Logowanie</h3>

    <form class="login_form" method="post" action="logged.php">
        <p>Nazwa użytkownika/email</p>
        <input type="text" name="username" required />
        <p>Hasło</p>
        <input type="text" name="password" required /> <br>
        <input type="submit" value="Zaloguj" />
    </form>

    <a href="#">Przypomnij hasło</a>

    <h3>Nie masz konta?</h3>
    <a href="#">Zarejestruj</a>
    
</body>
</html>


