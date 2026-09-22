<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->usuarioModel = new UsuarioModel();
    }

public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $usuario = $this->usuarioModel->login($email, $password);
        if ($usuario) {
            session_regenerate_id(true);
            $_SESSION['usuario'] = $usuario;
            
            // Redirigir a la pantalla de Inicio tras un login exitoso
            header("Location: index.php");
            exit;
        } else {
            $error = "Credenciales incorrectas.";
            require_once __DIR__ . '/../views/auth/login.php';
            return;
        }
    }
    require_once __DIR__ . '/../views/auth/login.php';
}

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            unset($_SESSION['usuario']);

            $nombre    = trim($_POST['nombre'] ?? '');
            $email     = trim($_POST['email'] ?? '');
            $password  = $_POST['password'] ?? '';
            $tipo      = $_POST['tipo'] ?? 'visitante';
            $biografia = trim($_POST['biografia'] ?? '');

            if (empty($nombre) || empty($email) || empty($password)) {
                $error = "Todos los campos obligatorios deben ser completados.";
                require_once __DIR__ . '/../views/auth/register.php';
                return;
            }

            if ($this->usuarioModel->registrar($nombre, $email, $password, $tipo, $biografia)) {
                header("Location: index.php?c=auth&a=login&mensaje=registrado");
                exit;
            } else {
                $error = "El correo electrónico ya está registrado o falló el registro.";
                require_once __DIR__ . '/../views/auth/register.php';
                return;
            }
        }
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
        exit;
    }
}