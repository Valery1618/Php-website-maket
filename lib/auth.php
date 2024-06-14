<?php

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password= trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($login) < 2) {
    echo "Login must be longer than 2 characters";
    exit();
}elseif (strlen($password) < 8) {
    echo "Password must be longer than 8 characters";
    exit();
}

//PASSWORD
$salt = 'kje8489iejhg734873939&^&8';
$password = md5($salt . $password);

//DB
require "db.php";

//Auth user

$sql = "SELECT id FROM website_users WHERE login = :login AND password = :password";
$query = $pdo->prepare($sql);
$query->execute([
   'login' => $login,
   'password' => $password
]);

if($query->rowCount() == 0) {
    header('Location: /registration.php');
}else {
    setcookie('login', $login, time() + 3600 * 24 * 30, "/");
    header('Location: /user.php');
}