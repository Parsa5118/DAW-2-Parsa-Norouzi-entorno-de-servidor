<?php

session_start();


$visitas = isset($_COOKIE['visitas']) ? (int)$_COOKIE['visitas'] : 0;
$visitas++;
setcookie('visitas', (string)$visitas, time() + 30*24*3600, '/');


if (!isset($_SESSION['dinero'])) {
    $_SESSION['dinero'] = 200; 
}

$dinero       = $_SESSION['dinero'];
$msg          = '';   
$error        = '';   
$finalizado   = false;
$saldo_final  = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {

    $accion = $_POST['accion'];

    if ($accion === 'apostar') {
        
        $apuesta = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 0;
        $tipo    = isset($_POST['tipo']) ? $_POST['tipo'] : '';

        if ($apuesta <= 0) {
            $error = 'La cantidad a apostar debe ser un número positivo.';
        } elseif ($apuesta > $dinero) {
            $error = "Error: no dispone de $apuesta euros. Tiene $dinero euros.";
        } elseif ($tipo !== 'Par' && $tipo !== 'Impar') {
            $error = 'Debe elegir el tipo de apuesta (Par o Impar).';
        } else {
            
            $numero = random_int(1, 10);
            $esPar  = ($numero % 2 === 0);
            $resultado = $esPar ? 'Par' : 'Impar';

            $acierto = ($resultado === $tipo);

            if ($acierto) {
                $dinero += $apuesta;
                $msg = "RESULTADO: $resultado — ¡GANASTE! (+$apuesta €). Número: $numero.";
            } else {
                $dinero -= $apuesta;
                $msg = "RESULTADO: $resultado — Perdiste (-$apuesta €). Número: $numero.";
            }

            
            $_SESSION['dinero'] = $dinero;

           
            if ($dinero <= 0) {
                $finalizado  = true;
                $saldo_final = 0;
                $_SESSION = [];
                if (ini_get('session.use_cookies')) {
                    $p = session_get_cookie_params();
                    setcookie(session_name(), '', time()-42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
                }
                session_destroy();
            }
        }

    } elseif ($accion === 'abandonar') {
        
        $finalizado  = true;
        $saldo_final = $dinero;

        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time()-42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
    }
}


if (session_status() !== PHP_SESSION_ACTIVE) {
    $dinero = $saldo_final ?? 0;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>El Minicasino</title>
  <style>
 
  </style>
</head>
<body>
<div >
  <h1>BIENVENIDO AL CASINO</h1>
  <p class="note">Esta es tu visita nº <strong><?= (int)$visitas ?></strong>.</p>

  <?php if ($error): ?>
    <div class="msg error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if ($msg && !$finalizado): ?>
    <div class="msg ok"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <?php if ($finalizado): ?>
    <h2>Muchas gracias por jugar con nosotros.</h2>
    <p>Su resultado final es de <strong><?= (int)$dinero ?></strong> Euros.</p>
    <p><a href="minicasino.php">Crear nueva sesión y volver a jugar</a></p>
  <?php else: ?>
    <p>Dispone de <strong><?= (int)$dinero ?></strong> Euros para jugar.</p>

    <form method="post">
      <div class="row">
        <label for="cantidad">Cantidad a apostar (€):</label>
        <input id="cantidad" name="cantidad" type="number" min="1" step="1" required>
      </div>

      <div >
        <label>Tipo de apuesta:</label>
        <label><input type="radio" name="tipo" value="Par"> Par</label>
        <label><input type="radio" name="tipo" value="Impar"> Impar</label>
      </div>

      <div>
        <button name="accion" value="apostar">Apostar cantidad</button>
        <button class="secondary" name="accion" value="abandonar">Abandonar el Casino</button>
      </div>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
