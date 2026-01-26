<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["login"])) {
    http_response_code(401);
    echo "NO_AUTH";
    exit;
}

$user = $_SESSION["login"];
$game = $_POST["game"] ?? "";
$title = $_POST["title"] ?? "";
$platform = $_POST["platform"] ?? "";

if ($game === "" || $title === "") {
    http_response_code(400);
    echo "INVALID_DATA";
    exit;
}


$checkSql = "SELECT id FROM favorites 
             WHERE login = :user AND game_code = :game";
$check = $pdo->prepare($checkSql);
$check->execute([
    ":user" => $user,
    ":game" => $game
]);

if ($check->fetch()) {
    echo "ALREADY_EXISTS";
    exit;
}


$insertSql = "INSERT INTO favorites (login, game_code, platform, game_title)
              VALUES (:user, :game, :platform, :title)";
$stmt = $pdo->prepare($insertSql);
$stmt->execute([
    ":user" => $user,
    ":game" => $game,
    ":platform" => $platform,
    ":title" => $title
]);

echo "OK";
