<?php
// Obtener el controlador y la acción desde la URL
$controllerName = $_GET['c'] ?? 'home';
$action = $_GET['a'] ?? 'index';

// Mapeo de controladores
switch ($controllerName) {
    case 'auth':
        require_once __DIR__ . '/../controllers/AuthController.php';
        $controller = new AuthController();
        break;

    case 'dashboard':
        require_once __DIR__ . '/../controllers/DashboardController.php';
        $controller = new DashboardController();
        break;

    case 'obra':
        require_once __DIR__ . '/../controllers/ObraController.php';
        $controller = new ObraController();
        break;

    case 'galeria':
        require_once __DIR__ . '/../controllers/GaleriaController.php';
        $controller = new GaleriaController();
        break;

    case 'artista':
        require_once __DIR__ . '/../controllers/ArtistaController.php';
        $controller = new ArtistaController();
        break;

    default:
        require_once __DIR__ . '/../controllers/HomeController.php';
        $controller = new HomeController();
        break;

    case 'grupo':
    require_once __DIR__ . '/../controllers/GrupoController.php';
    $controller = new GrupoController();
    break;
}

// Ejecutar la acción solicitada si existe
if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "Página no encontrada";
}