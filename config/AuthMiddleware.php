<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthMiddleware {

    // Verificar que el usuario haya iniciado sesión
    public static function autenticado() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }
    }

    // Verificar si el usuario tiene uno de los roles permitidos
    public static function tieneRol($rolesPermitidos = []) {
        self::autenticado();

        $rolActual = $_SESSION['usuario']['tipo'] ?? '';

        if (!in_array($rolActual, $rolesPermitidos)) {
            // Si no tiene permisos, redirigir a una vista sin acceso o a la galería
            header("Location: index.php?c=galeria&a=index&error=acceso_denegado");
            exit;
        }
    }
}