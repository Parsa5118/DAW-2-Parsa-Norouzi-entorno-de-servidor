<?php
require_once 'Producto.php';

// ---------------------------------------------------------
// 2. CLASE REPOSITORIO (Maneja la lógica PDO)
// ---------------------------------------------------------
class ProductoRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // --- CREATE (Insertar) ---
    public function crear(Producto $producto) {
        $sql = "INSERT INTO productos (nombre, precio, stock) 
                VALUES (:nombre, :precio, :stock)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nombre', $producto->nombre);
        $stmt->bindValue(':precio', $producto->precio);
        $stmt->bindValue(':stock',  $producto->stock);

        $stmt->execute();

        // Asignamos el ID generado al objeto
        $producto->id = $this->pdo->lastInsertId();
        return $producto->id;
    }

    // --- READ (Leer Todos) - Uso de FETCH_CLASS ---
    public function obtenerTodos() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }

    // --- READ (Leer Uno) ---
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        return $stmt->fetch();
    }

    // --- UPDATE (Actualizar) ---
    public function actualizar(Producto $producto) {
        $sql = "UPDATE productos 
                SET nombre = :nombre, precio = :precio, stock = :stock 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nombre', $producto->nombre);
        $stmt->bindValue(':precio', $producto->precio);
        $stmt->bindValue(':stock',  $producto->stock);
        $stmt->bindValue(':id',     $producto->id);

        return $stmt->execute();
    }

    // --- DELETE (Eliminar) ---
    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->rowCount();
    }
}
