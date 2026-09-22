<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArteEnVivo</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; }
        .header-nav {
            background-color: #0d0d0d;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo { color: #ff3b5c; font-size: 1.5rem; font-weight: bold; text-decoration: none; }
        .nav-links { display: flex; align-items: center; gap: 1.5rem; }
        .nav-links a { color: #ffffff; text-decoration: none; font-size: 0.95rem; }
        .nav-links a:hover { color: #ff3b5c; }
        .btn-login {
            border: 1px solid #ff3b5c;
            color: #ff3b5c !important;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: bold;
        }
        .btn-registro {
            background-color: #ff3b5c;
            color: #ffffff !important;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<header class="header-nav">
    <a href="index.php" class="logo">ArteEnVivo</a>
    <nav class="nav-links">
        <a href="index.php?c=home&a=index">Inicio</a>
        <a href="index.php?c=galeria&a=index">Explorar Galería</a>

        <?php if (isset($_SESSION['usuario'])): ?>
            <?php $rol = $_SESSION['usuario']['tipo']; ?>

            <!-- Menú dinámico por Rol -->
            <?php if ($rol === 'administrador'): ?>
                <a href="index.php?c=grupo&a=index">Gestión Categorías</a>
                <a href="index.php?c=artista&a=index">Gestión Artistas</a>
            <?php elseif ($rol === 'artista'): ?>
                <a href="index.php?c=dashboard&a=index">Mi Panel de Artista</a>
            <?php elseif ($rol === 'comprador'): ?>
                <a href="index.php?c=galeria&a=mis_compras">Mis Compras</a>
            <?php endif; ?>

            <span style="color: #fff;">
                Hola, <strong><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></strong> 
                (<?= ucfirst($rol) ?>)
            </span>
            <a href="index.php?c=auth&a=logout" style="color: #aaa;">Cerrar Sesión</a>

        <?php else: ?>
            <a href="index.php?c=auth&a=login" class="btn-login">Iniciar Sesión</a>
            <a href="index.php?c=auth&a=register" class="btn-registro">Registrarse</a>
        <?php endif; ?>
    </nav>
</header>