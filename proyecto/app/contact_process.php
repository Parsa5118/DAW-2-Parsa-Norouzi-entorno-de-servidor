<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $message === "") {
        die("❌ Todos los campos son obligatorios");
    }

    $sql = "INSERT INTO contact_messages (name, email, message)
            VALUES (:name, :email, :message)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "name" => $name,
        "email" => $email,
        "message" => $message
    ]);

    header("Location: ../layouts/contacto.html?ok=1");
    exit;
}
?>