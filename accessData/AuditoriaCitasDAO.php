<?php

require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../model/AuditoriaCita.php';

class AuditoriaCitasDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    // Obtener todos los registros
    public function obtenerTodos() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM g2_auditoria_citas ORDER BY fecha DESC;");
            $resultado = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado[] = new AuditoriaCita(
                    $row['id'],
                    $row['cita_id'],
                    $row['accion'],
                    $row['realizada_por'],
                    $row['detalle'],
                    $row['fecha']
                );
            }

            return $resultado;
        } catch (PDOException $e) {
            error_log('Error al obtener auditorías de citas: ' . $e->getMessage());
            return [];
        }
    }

    // Obtener uno por ID
    public function obtenerPorId($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM g2_auditoria_citas WHERE id = ?;");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new AuditoriaCita(
                    $row['id'],
                    $row['cita_id'],
                    $row['accion'],
                    $row['realizada_por'],
                    $row['detalle'],
                    $row['fecha']
                );
            }

            return null;
        } catch (PDOException $e) {
            error_log('Error al obtener auditoría de cita por ID: ' . $e->getMessage());
            return null;
        }
    }
}

?>
