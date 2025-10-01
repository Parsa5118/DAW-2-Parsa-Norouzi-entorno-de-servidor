<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Piedra, Papel o Tijera</title>
</head>
<body>
<h1>¡Piedra, papel, tijera!</h1>
<p>Actualice la página para mostrar otra partida.</p>

<?php
define('PIEDRA', "&#x1F91C;");  
define('PIEDRA2', "&#x1F91B;"); 
define('TIJERAS', "&#x1F596;"); 
define('PAPEL', "&#x1F91A;");   

$opciones = ["PIEDRA", "PAPEL", "TIJERAS"];

$j1 = $opciones[array_rand($opciones)];
$j2 = $opciones[array_rand($opciones)];

echo "<table border='0' cellpadding='20'><tr>";
echo "<td><b>Jugador 1</b><br>" . constant($j1) . "</td>";
echo "<td><b>Jugador 2</b><br>" . constant($j2) . "</td>";
echo "</tr></table>";

if ($j1 == $j2) {
    echo "<h3>¡Empate!</h3>";
} elseif (
    ($j1 == "PIEDRA" && $j2 == "TIJERAS") ||
    ($j1 == "PAPEL" && $j2 == "PIEDRA") ||
    ($j1 == "TIJERAS" && $j2 == "PAPEL")
) {
    echo "<h3>Ha ganado el jugador 1</h3>";
} else {
    echo "<h3>Ha ganado el jugador 2</h3>";
}
?>
</body>
</html>
