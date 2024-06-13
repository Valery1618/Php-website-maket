<?php

error_reporting(E_ALL);

ini_set("display_errors", 1);

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$password= trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($login) < 2) {
    echo "Login must be longer than 2 characters";
    exit();
}elseif (strlen($name) < 2) {
    echo "Name must be longer than 2 characters";
    exit();
}elseif (strlen($email) < 2 && !str_contains($email, '@')) {
    echo "Email must be longer than 2 characters";
    exit();
}elseif (strlen($password) < 8) {
    echo "Password must be longer than 8 characters";
    exit();
}

//PASSWORD

$salt = 'kje8489iejhg734873939&^&8';
$password = md5($salt . $password);

// DB

$pdo = new PDO('mysql:host=localhost;dbname=tutorial_db2', 'root', 'password');

//INSERT
/*
$sql = "INSERT INTO website_users(login, user_name, email, password) VALUES (?, ?, ?, ?)";
$query = $pdo->prepare($sql);
$query->execute([$login, $name, $email, $password]);
*/

$sql = "INSERT INTO website_users(login, user_name, email, password)
            VALUES (:login, :user_name, :email, :password)";
$query = $pdo->prepare($sql);

$query->execute([
    'login' => $login,
    'user_name' => $name,
    'email' => $email,
    'password' => $password
]);

header('Location: /');

