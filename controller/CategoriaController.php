<?php

require_once __DIR__ . '/../accessData/CategoriasDAO.php';
require_once __DIR__ . '/../model/Categoria.php';

class CategoriasController {
    private $dao;

    public function __construct() {
        $this->dao = new CategoriasDAO();
    }

    // 🔍 Obtener todas las categorías
    public function obtenerTodos() {
        try {
            return $this->dao->obtenerTodos();
        } catch (Exception $e) {
            error_log("Error al obtener categorías: " . $e->getMessage());
            return [];
        }
    }

    // 🔍 Obtener una categoría por ID
    public function obtenerPorId($id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido.");
        }

        try {
            return $this->dao->obtenerPorId($id);
        } catch (Exception $e) {
            error_log("Error al obtener categoría por ID: " . $e->getMessage());
            return null;
        }
    }

    // ➕ Insertar una nueva categoría
    public function insertar($datos) {
        if (empty($datos['nombre'])) {
            throw new Exception("El nombre de la categoría es obligatorio.");
        }

        $categoria = new Categoria(null, $datos['nombre']);
        return $this->dao->insertar($categoria);
    }

    // ✏️ Actualizar una categoría existente
    public function actualizar($id, $datos) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido.");
        }

        $categoria = $this->dao->obtenerPorId($id);
        if (!$categoria) {
            throw new Exception("Categoría no encontrada.");
        }

        if (!empty($datos['nombre'])) {
            $categoria->nombre = $datos['nombre'];
        }

        return $this->dao->actualizar($categoria);
    }

    // 🗑️ Eliminar una categoría por ID
    public function eliminar($id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido.");
        }

        return $this->dao->eliminar($id);
    }
}

?>
