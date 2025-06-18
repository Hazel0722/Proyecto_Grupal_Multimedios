<?php

require_once __DIR__ . '/../accessData/AuditoriaDoctorDAO.php';
require_once __DIR__ . '/../model/AuditoriaDoctor.php';

class AuditoriaDoctorController {
    private $dao;

    public function __construct() {
        $this->dao = new AuditoriaDoctorDAO();
    }

    // 🔍 Obtener todas las auditorías de doctores
    public function obtenerTodos() {
        try {
            return $this->dao->obtenerTodos();
        } catch (Exception $e) {
            error_log('Error en AuditoriaDoctorController::obtenerTodos - ' . $e->getMessage());
            return [];
        }
    }

    // 🔍 Obtener una auditoría específica por ID
    public function obtenerPorId($id) {
        if (!is_numeric($id)) {
            error_log("ID inválido: $id");
            return null;
        }

        try {
            return $this->dao->obtenerPorId($id);
        } catch (Exception $e) {
            error_log('Error en AuditoriaDoctorController::obtenerPorId - ' . $e->getMessage());
            return null;
        }
    }
}

?>
