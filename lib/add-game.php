<?php
$image = trim(filter_var($_POST['image'], FILTER_SANITIZE_SPECIAL_CHARS));
$followers = trim(filter_var($_POST['followers'], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($image) < 3) {
    echo "Image ERROR";
    exit();
}elseif (strlen($followers) < 1) {
    echo "Followers ERROR";
    exit();
}

//DB
require 'db.php';

//SQL
$sql = "INSERT INTO trending (image, followers) VALUES (:image, :followers)";
$query = $pdo->prepare($sql);
$query->execute([
    'image'=>$image,
    'followers'=>$followers
]);
header('Location:/trending.php');
