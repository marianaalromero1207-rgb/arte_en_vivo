<?php
require_once __DIR__ . '/../models/ObraModel.php';

class GaleriaController {
    private $obraModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->obraModel = new ObraModel();
    }

    public function index() {
        // Obtener todas las obras publicadas
        $obras = $this->obraModel->obtenerTodasLasObras();
        require_once __DIR__ . '/../views/galeria/index.php';
    }
}