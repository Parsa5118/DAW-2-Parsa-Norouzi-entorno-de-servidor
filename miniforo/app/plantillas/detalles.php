<?php
include_once __DIR__. '/../funciones.php';
?>

<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen ($_REQUEST['comentario'])?></td></tr>
<tr><td>Nº de palabras:    </td><td><?= contarPalabras($_REQUEST['comentario']) ?></td></tr>
<tr><td>Letra + repetida:  </td><td><?= letraMasRepetida($_REQUEST['comentario']) ?></td></tr>
<tr><td>Palabra + repetida:</td><td><?= palabraMasRepetida($_REQUEST['comentario']) ?></td></tr>
</table>
</div>
