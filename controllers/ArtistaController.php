<?php
require_once __DIR__ . '/../models/Galeria.php';
require_once __DIR__ . '/../models/Obra.php';
require_once __DIR__ . '/../config/AuthMiddleware.php';

class ArtistaController {
    private $db;
    private $galeriaModel;
    private $obraModel;

    public function __construct() {
        // Solo el administrador puede acceder al CRUD de artistas
        AuthMiddleware::tieneRol(['administrador']);
        // Control de acceso: Solo usuarios tipo 'artista'
        if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] !== 'artista') {
            header("Location: index.php?c=auth&a=showLogin");
            exit();
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->galeriaModel = new Galeria($this->db);
        $this->obraModel = new Obra($this->db);
    }

    // Dashboard con lista de galerías
    public function dashboard() {
        $galerias = $this->galeriaModel->obtenerPorArtista($_SESSION['user_id']);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/artista/dashboard.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Crear Galería 2D
    public function crearGaleria() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $estilo = $_POST['estilo_tema'];

            if ($this->galeriaModel->crear($_SESSION['user_id'], $titulo, $descripcion, $estilo)) {
                header("Location: index.php?c=artista&a=dashboard");
                exit();
            }
        }
    }

    // Guardar una nueva obra dentro de una galería con carga de imagen
    public function guardarObra() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_galeria = $_POST['id_galeria'];
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
            $orden = $_POST['orden_exposicion'] ?? 1;

            // Procesar la subida del archivo de la obra
            $nombreImagen = time() . '_' . $_FILES['imagen']['name'];
            $rutaDestino = __DIR__ . '/../public/uploads/' . $nombreImagen;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                $this->obraModel->crear($id_galeria, $titulo, $descripcion, $categoria, $precio, $nombreImagen, $orden);
                header("Location: index.php?c=artista&a=verGaleria&id=" . $id_galeria);
                exit();
            }
        }
    }

    // Ver detalle de una galería y sus obras
    public function verGaleria() {
        $id_galeria = $_GET['id'] ?? null;
        $galeria = $this->galeriaModel->obtenerPorId($id_galeria, $_SESSION['user_id']);

        if (!$galeria) {
            header("Location: index.php?c=artista&a=dashboard");
            exit();
        }

        $obras = $this->obraModel->obtenerPorGaleria($id_galeria);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/artista/galeria_detalle.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}

<?php
require_once __DIR__ . '/../models/ArtistaModel.php';

class ArtistaController {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->model = new ArtistaModel();
    }

    // LISTAR
    public function index() {
        $artistas = $this->model->obtenerTodos();
        require_once __DIR__ . '/../views/artistas/index.php';
    }

    // CREAR
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $biografia = trim($_POST['biografia'] ?? '');

            if ($this->model->crear($nombre, $email, $password, $biografia)) {
                header("Location: index.php?c=artista&a=index");
                exit;
            }
        }
        require_once __DIR__ . '/../views/artistas/crear.php';
    }

    // EDITAR
    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?c=artista&a=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $biografia = trim($_POST['biografia'] ?? '');

            if ($this->model->actualizar($id, $nombre, $email, $biografia)) {
                header("Location: index.php?c=artista&a=index");
                exit;
            }
        }

        $artista = $this->model->obtenerPorId($id);
        require_once __DIR__ . '/../views/artistas/editar.php';
    }

    // ELIMINAR
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->eliminar($id);
        }
        header("Location: index.php?c=artista&a=index");
        exit;
    }
}