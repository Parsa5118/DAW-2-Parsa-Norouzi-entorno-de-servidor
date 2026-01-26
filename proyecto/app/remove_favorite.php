<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["login"])) {
  echo "NO_AUTH";
  exit;
}

$game = $_POST["game"] ?? "";
$user = $_SESSION["login"];

if ($game === "") {
  echo "INVALID";
  exit;
}

$sql = "DELETE FROM favorites WHERE login = :login AND game_code = :game";
$stmt = $pdo->prepare($sql);
$stmt->execute([
  ":login" => $user,
  ":game" => $game
]);

echo "REMOVED";
