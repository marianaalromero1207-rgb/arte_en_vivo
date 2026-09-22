<?php
require_once __DIR__ . '/../models/Mensaje.php';

class MensajeController {
    private $db;
    private $mensajeModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=showLogin");
            exit();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->mensajeModel = new Mensaje($this->db);
    }

    // Formulario de envío
    public function nuevo() {
        $id_obra = $_GET['id_obra'] ?? null;
        
        // Obtener ID del artista dueño de la obra
        $query = "SELECT o.*, g.id_artista FROM obras o JOIN galerias g ON o.id_galeria = g.id WHERE o.id = :id_obra LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_obra', $id_obra);
        $stmt->execute();
        $obra = $stmt->fetch();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/mensaje/nuevo.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Enviar mensaje
    public function enviar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_destinatario = $_POST['id_destinatario'];
            $id_obra = $_POST['id_obra'] ?: null;
            $asunto = trim($_POST['asunto']);
            $mensaje = trim($_POST['mensaje']);

            if ($this->mensajeModel->enviar($_SESSION['user_id'], $id_destinatario, $id_obra, $asunto, $mensaje)) {
                header("Location: index.php?c=mensaje&a=bandeja&msg=enviado");
                exit();
            }
        }
    }

    // Bandeja de entrada
    public function bandeja() {
        $mensajes = $this->mensajeModel->obtenerPorUsuario($_SESSION['user_id']);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/mensaje/bandeja.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}