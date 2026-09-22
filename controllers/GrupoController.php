<?php
require_once __DIR__ . '/../models/GrupoModel.php';
require_once __DIR__ . '/../config/AuthMiddleware.php';

class GrupoController {
    private $model;

    public function __construct() {
        // Restringir TODO este controlador únicamente al Administrador
        AuthMiddleware::tieneRol(['administrador']);
        $this->model = new GrupoModel();
    }

    public function index() {
        $grupos = $this->model->obtenerTodos();
        require_once __DIR__ . '/../views/grupos/index.php';
    }
    
    // resto de métodos (crear, editar, eliminar)...
}

    // Crear grupo
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');

            if (!empty($nombre)) {
                $this->model->crear($nombre, $descripcion);
                header("Location: index.php?c=grupo&a=index");
                exit;
            }
        }
        require_once __DIR__ . '/../views/grupos/crear.php';
    }

    // Editar grupo
    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?c=grupo&a=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');

            $this->model->actualizar($id, $nombre, $descripcion);
            header("Location: index.php?c=grupo&a=index");
            exit;
        }

        $grupo = $this->model->obtenerPorId($id);
        require_once __DIR__ . '/../views/grupos/editar.php';
    }

    // Eliminar grupo
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->eliminar($id);
        }
        header("Location: index.php?c=grupo&a=index");
        exit;
    }
}