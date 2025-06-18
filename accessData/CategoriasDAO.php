<?php

require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../model/Categoria.php';

class CategoriasDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    // Obtener todas las categorías
    public function obtenerTodos() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM g2_categorias;");
            $resultado = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado[] = new Categoria(
                    $row['id'],
                    $row['nombre']
                );
            }

            return $resultado;
        } catch (PDOException $e) {
            error_log('Error al obtener todas las categorías: ' . $e->getMessage());
            return [];
        }
    }

    // Obtener categoría por ID
    public function obtenerPorId($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM g2_categorias WHERE id = ?;");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Categoria($row['id'], $row['nombre']);
            }

            return null;
        } catch (PDOException $e) {
            error_log('Error al obtener categoría por ID: ' . $e->getMessage());
            return null;
        }
    }

    // Insertar nueva categoría
    public function insertar(Categoria $objeto) {
        try {
            $sql = "INSERT INTO g2_categorias (nombre) VALUES (?);";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$objeto->nombre]);
        } catch (PDOException $e) {
            error_log('Error al insertar categoría: ' . $e->getMessage());
            return false;
        }
    }

    // Actualizar categoría
    public function actualizar(Categoria $objeto) {
        try {
            $sql = "UPDATE g2_categorias SET nombre = ? WHERE id = ?;";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$objeto->nombre, $objeto->id]);
        } catch (PDOException $e) {
            error_log('Error al actualizar categoría: ' . $e->getMessage());
            return false;
        }
    }

    // Eliminar categoría
    public function eliminar($id) {
        try {
            $sql = "DELETE FROM g2_categorias WHERE id = ?;";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log('Error al eliminar categoría: ' . $e->getMessage());
            return false;
        }
    }
}

?>