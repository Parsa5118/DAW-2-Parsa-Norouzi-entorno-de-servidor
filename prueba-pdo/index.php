<?php

require_once 'Producto.php';
require_once 'ProductoRepository.php';
// ---------------------------------------------------------
// 3. EJEMPLO DE USO (Script Principal)
// ---------------------------------------------------------

// Configuración de conexión
$dsn = 'mysql:host=localhost:3307;dbname=Almacen;charset=utf8mb4';
$user = 'root'; // Cambia esto
$pass = '';     // Cambia esto

try {
    // A. Conexión
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    





    // Instanciamos el repositorio
    $repo = new ProductoRepository($pdo);

    echo "<h2>--- Inicio del CRUD ---</h2>";

    // 1. CREATE: Crear un nuevo producto
    $nuevoProd = new Producto();
    $nuevoProd->nombre = "Teclado Mecánico";
    $nuevoProd->precio = 59.99;
    $nuevoProd->stock = 10;

    $idGenerado = $repo->crear($nuevoProd);
    echo "✅ Producto creado: " . $nuevoProd->info() . "<br>";

    // 2. READ: Listar todos
    echo "<br><strong>Lista de productos:</strong><br>";
    $lista = $repo->obtenerTodos();
    foreach ($lista as $p) {
        echo "- " . $p->info() . "<br>";
    }

    // 3. UPDATE: Modificar el producto creado
    // Primero lo recuperamos por ID para asegurarnos que tenemos el objeto correcto
    $prodParaEditar = $repo->obtenerPorId($idGenerado);
    
    if ($prodParaEditar) {
        $prodParaEditar->precio = 45.00; // Bajamos el precio
        $prodParaEditar->stock  = 9;     // Vendimos uno
        
        $repo->actualizar($prodParaEditar);
        echo "<br>🔄 Producto actualizado (Nuevo precio: 45.00$).<br>";
    }

    // 4. READ (Verificación): Vemos el cambio
    $prodVerificado = $repo->obtenerPorId($idGenerado);
    echo "Verificación: " . $prodVerificado->info() . "<br>";

    // 5. DELETE: Borrar el producto
    $filas = $repo->eliminar($idGenerado);
    if ($filas > 0) {
        echo "<br>🗑️ Producto eliminado correctamente.";
    }

} catch (PDOException $e) {
    echo "Error Grave: " . $e->getMessage();
    die;
}

// Desconexión (Opcional, PHP lo hace al final del script)
$pdo = null;
?>
