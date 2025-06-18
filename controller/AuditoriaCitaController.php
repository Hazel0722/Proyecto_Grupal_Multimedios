<?php

require_once __DIR__ . '/../accessData/AuditoriaCitasDAO.php';
require_once __DIR__ . '/../model/AuditoriaCita.php';

class AuditoriaCitaController {
    private $dao;

    public function __construct() {
        $this->dao = new AuditoriaCitasDAO();
    }

    // 🔍 Obtener todas las auditorías
    public function obtenerTodos() {
        try {
            return $this->dao->obtenerTodos();
        } catch (Exception $e) {
            error_log('Error en AuditoriaCitaController::obtenerTodos - ' . $e->getMessage());
            return [];
        }
    }

    // 🔍 Obtener una auditoría por ID
    public function obtenerPorId($id) {
        if (!is_numeric($id)) {
            error_log("ID inválido: $id");
            return null;
        }

        try {
            return $this->dao->obtenerPorId($id);
        } catch (Exception $e) {
            error_log('Error en AuditoriaCitaController::obtenerPorId - ' . $e->getMessage());
            return null;
        }
    }
}

?>
