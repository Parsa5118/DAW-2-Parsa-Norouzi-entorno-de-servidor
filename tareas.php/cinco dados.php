<?php

define('NUMDADOS', 5);

$tcharDados = [
  1 => "&#9856;", 2 => "&#9857;",
  3 => "&#9858;", 4 => "&#9859;",
  5 => "&#9860;", 6 => "&#9861;"
];

function generarDados(int $numdados): array {
  $res = [];
  for ($i = 0; $i < $numdados; $i++) {
    $res[] = random_int(1, 6);
  }
  return $res;
}

function calcularPuntos(array $tdados): int {
  if (count($tdados) < 2) return 0; 
  $suma = array_sum($tdados);
  $max  = max($tdados);
  $min  = min($tdados);
  return $suma - $max - $min;
}

function generarMensajeGanador(int $puntos1, int $puntos2): string {
  if ($puntos1 === $puntos2) return "¡Empate!";
  return ($puntos1 > $puntos2) ? "Ha Ganado el Jugador 1" : "Ha Ganado el Jugador 2";
}


function generarImagenes(array $tdados): string {
  global $tcharDados;
  $msg = "<div style='font-size:100px; line-height:1;'>";
  foreach ($tdados as $v) {
    $msg .= "<span style='display:inline-block; padding:6px 8px;'>{$tcharDados[$v]}</span>";
  }
  $msg .= "</div>";
  return $msg;
}


$dadosJugador1  = generarDados(NUMDADOS);
$dadosJugador2  = generarDados(NUMDADOS);

$puntosJugador1 = calcularPuntos($dadosJugador1);
$puntosJugador2 = calcularPuntos($dadosJugador2);

$msgGanador     = generarMensajeGanador($puntosJugador1, $puntosJugador2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cinco dados</title>
  <style>
    body { font-family: system-ui, Arial, sans-serif; }
    table { border-collapse: collapse; margin-top: 12px; }
    th, td { padding: 10px; }
    th { text-align: left; }
    .rojo { background:#e31616; }
    .azul { background:#1236e3; color:#fff; }
  </style>
</head>
<body>
  <h1>Cinco dados</h1>
  <p>Actualice la página para mostrar una nueva tirada.</p>

  <table>
    <tbody>
      <tr>
        <th>Jugador 1</th>
        <td class="rojo">
          <?= generarImagenes($dadosJugador1); ?>
        </td>
        <th><?= $puntosJugador1; ?> puntos</th>
      </tr>
      <tr>
        <th>Jugador 2</th>
        <td class="azul">
          <?= generarImagenes($dadosJugador2); ?>
        </td>
        <th><?= $puntosJugador2; ?> puntos</th>
      </tr>
      <tr>
        <th>Resultado</th>
        <td colspan="2"><strong><?= $msgGanador; ?></strong></td>
      </tr>
    </tbody>
  </table>

  <footer>
    <p><u>By Alberto López</u></p>
  </footer>
</body>
</html>
