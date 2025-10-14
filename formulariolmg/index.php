<?php

const UP_DIR   = __DIR__ . '/uploads/';
const MAX_SIZE = 10 * 1024;     
const MIME_OK  = 'image/png';

if (!is_dir(UP_DIR)) { @mkdir(UP_DIR, 0775, true); }

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$nombre = $_POST['nombre'] ?? '';
$alias  = $_POST['alias']  ?? '';
$edad   = (int)($_POST['edad'] ?? 0);
$armas  = isset($_POST['armas']) && is_array($_POST['armas']) ? $_POST['armas'] : [];
$magia  = $_POST['magia']  ?? 'No';

$imgPath   = 'calavera.png';
$errImagen = '';


if (isset($_FILES['imagen'])) {
  $f = $_FILES['imagen'];

  if ($f['error'] === UPLOAD_ERR_NO_FILE) {
  
    $imgPath   = 'calavera.png';
    $errImagen = 'No se subió ninguna imagen.';
  } elseif ($f['error'] !== UPLOAD_ERR_OK) {
    $imgPath   = 'calavera.png';
    $errImagen = 'Error al subir la imagen (código ' . $f['error'] . ').';
  } elseif ($f['size'] > MAX_SIZE) {
    $imgPath   = 'calavera.png';
    $errImagen = 'La imagen supera el tamaño máximo (10 KB).';
  } else {
    
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($f['tmp_name']);
    if ($mime !== MIME_OK) {
      $imgPath   = 'calavera.png';
      $errImagen = 'Tipo de archivo no permitido. Solo PNG.';
    } else {
      
      $newName = bin2hex(random_bytes(6)) . '.png';
      if (move_uploaded_file($f['tmp_name'], UP_DIR . $newName)) {
        $imgPath   = 'uploads/' . $newName;
        $errImagen = '';
      } else {
        $imgPath   = 'calavera.png';
        $errImagen = 'No se pudo guardar la imagen en el servidor.';
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datos del Jugador</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f2f2f2; margin:32px; }
    .card { max-width:760px; background:#fff8aa; border:1px solid #e6dc54; border-radius:14px; padding:18px; }
    .grid { display:grid; grid-template-columns:1fr 220px; gap:16px; align-items:start; }
    .imgbox img { max-width:220px; height:auto; border:1px solid #ccc; border-radius:8px; background:#fff; display:block; margin-bottom:8px; }
    ul { margin:8px 0 0 18px; }
    .msg { color:#a10; font-weight:600; margin-top:6px; }
    .btn { display:inline-block; margin-top:14px; padding:10px 14px; background:#0d6efd; color:#fff; border-radius:10px; text-decoration:none; }
  </style>
</head>
<body>
  <div class="card">
    <div class="grid">
      <div>
        <h2>Datos del Jugador</h2>
        <ul>
          <li><strong>Nombre:</strong> <?= e($nombre) ?></li>
          <li><strong>Alias:</strong> <?= e($alias) ?></li>
          <li><strong>Edad:</strong> <?= e($edad) ?></li>
          <li><strong>Armas seleccionadas:</strong> <?= e($armas ? implode(', ', $armas) : '—') ?></li>
          <li><strong>¿Practica artes mágicas?:</strong> <?= e($magia ?: 'No') ?></li>
        </ul>
        <a class="btn" href="captura.html">← Volver al formulario</a>
      </div>

      <div class="imgbox">
        <p><strong>Imagen subida:</strong></p>
        <img src="<?= e($imgPath) ?>" alt="imagen del jugador">
        <?php if ($errImagen !== ''): ?>
          <p class="msg"><?= e($errImagen) ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
