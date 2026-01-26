<?php

session_start();
require_once "app/config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $login = trim($_POST["login"] ?? "");
    $password = $_POST["password"] ?? "";

    $sql = "SELECT * FROM userapp WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["login" => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["login"] = $user["login"];
        $_SESSION["fullname"] = $user["fullname"];
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GameNation</title>
    <link rel="stylesheet" href="web/css/css/index.css">
  

</head>
<body>

<nav>
    <ul class="menu">
      <li class="menu-item playstation">
        <a href="#ps">Play Station</a>
        <div class="submenu ps">
          <div class="submenu-row">
            <a href="layouts/ps5.html">PS5</a>
            <a href="layouts/ps4.html">PS4</a>
            <a href="layouts/ps3.html">PS3</a>
          </div>
        </div>
      </li>

      <li class="menu-item xbox">
        <a href="#xbox">XBox</a>
        <div class="submenu xbox">
          <div class="submenu-row">
            <a href="layouts/xbox.html">Series X/S</a>
            <a href="layouts/gamepass.html">Game Pass</a>
          </div>
        </div>
      </li>

      <li class="menu-item nintendo">
        <a href="#nintendo">Nintendo</a>
        <div class="submenu nintendo">
          <div class="submenu-row">
            <a href="layouts/switch.html">Switch</a>
            <a href="layouts/switch_dos.html">Switch 2</a>
          </div>
        </div>
      </li>

      <li class="menu-item steam">
        <a href="#steam">Steam</a>
        <div class="submenu steam">
          <div class="submenu-row">
            <a href="layouts/steam_juegos.html">Juegos</a>
            <a href="layouts/steam_ofertas.html">Ofertas</a>
          </div>
        </div>
      </li>

      <li class="menu-item steam">
        <a href="./favoritos.php" class="nav-favorites">
    ⭐ FAVORITS
</a>
        <div class="submenu favorite">
          <div class="submenu-row">
      
        </div>
        </div>
      </li>
    </ul>
  </nav>
<section>

<?php if (!isset($_SESSION["login"])): ?>

<form method="post">
    <label>USUARIO:</label>
    <input type="text" name="login" required>

    <label>CONTRASEÑA:</label>
    <input type="password" name="password" required>

    <button type="submit">ENTRAR</button>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>
</form>

<?php else: ?>

<div class="welcome-box">
<p> Bienvenido/a <?= htmlspecialchars($_SESSION["login"]) ?> 👋<br>
  Por favor, selecciona la plataforma que prefieras desde la barra superior.
</p>
<a href="logout.php">Cerrar sesión</a>
</div>
<?php endif; ?>

</section>

<footer>
    <div class="footer-content">
      <a href="layouts/index.html" class="footer-link">INICIO</a>
      <a href="layouts/contacto.html" class="footer-link">CONTACTO</a>
      <a href="layouts/conocenos.html" class="footer-link">CONÓCENOS</a>
      <a href="layouts/term_legales.html" class="footer-link">TERMINOS LEGALES</a>
      <a href="layouts/redes.html" class="footer-link">REDES SOCIALES</a>
      <a href="layouts/politicas.html" class="footer-link">POLITICAS</a>
    </div>
  </footer>
</body>
</html>
