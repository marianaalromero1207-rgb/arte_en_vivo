<?php
class DashboardController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        $usuario = $_SESSION['usuario'];
        require_once __DIR__ . '/../views/dashboard/index.php';
    }
}