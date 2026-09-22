<?php
require_once __DIR__ . '/../models/ObraModel.php';

class ObraController {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new ObraModel();
    }

    // READ (Listar)
    public function index() {
        $obras = $this->model->obtenerTodas();
        require_once __DIR__ . '/../views/obras/index.php';
    }

    // CREATE (Vista)
    public function crear() {
        require_once __DIR__ . '/../views/obras/crear.php';
    }

    // CREATE (Proceso)
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $usuario_id = $_SESSION['usuario_id'] ?? null;

            $imagenNombre = $this->subirImagen($_FILES['imagen']);

            $this->model->insertar($titulo, $descripcion, $precio, $imagenNombre, $usuario_id);
            header('Location: index.php?c=obra&a=index');
            exit;
        }
    }

    // UPDATE (Vista)
    public function editar() {
        $id = $_GET['id'] ?? null;
        $obra = $this->model->obtenerPorId($id);
        require_once __DIR__ . '/../views/obras/editar.php';
    }

    // UPDATE (Proceso)
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $imagenNombre = null;
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $imagenNombre = $this->subirImagen($_FILES['imagen']);
            }

            $this->model->actualizar($id, $titulo, $descripcion, $precio, $imagenNombre);
            header('Location: index.php?c=obra&a=index');
            exit;
        }
    }

    // DELETE (Proceso)
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->eliminar($id);
        }
        header('Location: index.php?c=obra&a=index');
        exit;
    }

    // Helper para imágenes
    private function subirImagen($file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $nombre = uniqid('obra_') . '.' . $ext;
            $dir = __DIR__ . '/../../public/uploads/';
            if (!file_exists($dir)) mkdir($dir, 0777, true);
            move_uploaded_file($file['tmp_name'], $dir . $nombre);
            return $nombre;
        }
        return 'default.jpg';
    }
}