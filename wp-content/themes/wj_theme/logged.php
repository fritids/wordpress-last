<?php

if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}
else {
    exit;
}

$db = new PDO('mysql:host=localhost;dbname=wordpress;charset=utf-8', 'wordpressuser', 'password');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$pass_hash = password_hash($password, PASSWORD_BCRYPT);

try {
    $command = "SELECT ID FROM users WHERE username = ? AND password = ?";
    
    $query = $db->prepare($command);
    $query->execute(array($username, $password));
    
    if($query->rowCount()>0) {
        $_SESSION['username'] = $username;
    }
} catch (PDOException $ex) {
    echo "<p>" . $ex->getMessage() . "</p>";
}
?>
