<?php
session_start();

/// Manejo de la sesión con dos valores
// 'cliente' => nombre del cliente
// 'pedidos' => array asociativo fruta => cantidad


// Nuevo cliente: anoto en la sesión su nombre y creo su tabla de pedidos vacía
if (isset($_GET['cliente'])) {
    $nombre = trim($_GET['cliente']);
    if ($nombre !== '') {
        $_SESSION['cliente'] = $nombre;
        $_SESSION['pedidos'] = []; // carrito vacío
    }
}

// No hay definido un cliente todavía en la session 
if (!isset($_SESSION['cliente'])) {
    require_once 'bienvenida.php';
    exit;
}

// Aseguramos que exista el array de pedidos
if (!isset($_SESSION['pedidos']) || !is_array($_SESSION['pedidos'])) {
    $_SESSION['pedidos'] = [];
}

// Proceso las acciones 
$compraRealizada = '';

if (isset($_POST['accion'])) {
    $accion   = trim($_POST['accion']);  // Elimina espacios como " Anotar "
    $fruta    = isset($_POST['fruta']) ? trim($_POST['fruta']) : '';
    $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 0;

    switch ($accion) {
        case 'Anotar':
            if ($fruta !== '' && $cantidad > 0) {
                 // Actualizo la tabla de pedidos en la sesión
                if (!isset($_SESSION['pedidos'][$fruta])) {
                    $_SESSION['pedidos'][$fruta] = 0;
                }
                $_SESSION['pedidos'][$fruta] += $cantidad;
            }
            break;

        case 'Anular':
              // Vacío la tabla de pedidos en la sesión
            $_SESSION['pedidos'] = [];
            break;

        case 'Terminar':
            // Destruyo la sesión y vuelvo a la página de bienvenida
            $compraRealizada = htmlTablaPedidos();
            require_once 'despedida.php';
            
            // Elimina la sesión del cliente
            $_SESSION = [];
            if (ini_get('session.use_cookies')) {
                $p = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $p['path'], $p['domain'], $p['secure'], $p['httponly']
                );
            }
            session_destroy();
            exit;
    }
}


$compraRealizada = htmlTablaPedidos();
require_once 'compra.php';


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(): string {
    if (empty($_SESSION['pedidos'])) {
        return "<p>No hay artículos en el pedido todavía.</p>";
    }

    $html = "<table border='1' cellpadding='6' cellspacing='0' style='width:100%; border-collapse:collapse;'>";
    $html .= "<tr style='background-color:#f4f7f6;'><th>Fruta</th><th>Cantidad</th></tr>";

    foreach ($_SESSION['pedidos'] as $fruta => $cant) {
        $html .= "<tr><td>" . htmlspecialchars($fruta) . "</td><td>" . (int)$cant . "</td></tr>";
    }

    $html .= "</table>";
    return $html;
}
?>
