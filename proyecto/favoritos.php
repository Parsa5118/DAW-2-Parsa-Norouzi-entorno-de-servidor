<?php
session_start();
require_once "app/config.php";

$login = $_SESSION["login"];

$sql = "SELECT * FROM favorites WHERE login = :login";
$stmt = $pdo->prepare($sql);
$stmt->execute([":login" => $login]);
$favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis favoritos</title>
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

        </li>
    </ul>
  </nav>

<h1>🎮 Mis juegos favoritos</h1>

<?php if (empty($favorites)): ?>
    <p>No tienes juegos en favoritos.</p>
<?php else: ?>
    <?php foreach ($favorites as $fav): ?>
  <div class="fav-item">
  <strong><?= htmlspecialchars($fav["game_title"]) ?></strong>
  <div class="platform">
    🎮 <?= htmlspecialchars($fav["platform"]) ?>
  </div>

  <button class="remove-fav"
    data-game="<?= htmlspecialchars($fav["game_code"]) ?>">
    ❌ Quitar de favoritos
  </button>
</div>

<?php endforeach; ?>
<?php endif; ?>

<script src="js/favorites-remove.js"></script>

<footer>
    <div class="footer-content">
      <a href="index.php" class="footer-link">INICIO</a>
      <a href="layouts/contacto.html" class="footer-link">CONTACTO</a>
      <a href="layouts/conocenos.html" class="footer-link">CONÓCENOS</a>
      <a href="layouts/term_legales.html" class="footer-link">TERMINOS LEGALES</a>
      <a href="layouts/redes.html" class="footer-link">REDES SOCIALES</a>
      <a href="layouts/politicas.html" class="footer-link">POLITICAS</a>
    </div>
  </footer>

</body>
</html>
