<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - ArteEnVivo</title>
    <link rel="stylesheet" href="/arte_en_vivo/public/css/styles.css">
</head>
<body>
    <main class="auth-container">
        <h2>Iniciar Sesión en ArteEnVivo</h2>

        <?php if (!empty($error)): ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?c=auth&a=login" class="auth-form">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>

            <button type="submit" class="btn-primary">Ingresar</button>
        </form>

        <p class="auth-footer">¿No tienes cuenta? <a href="index.php?c=auth&a=register">Regístrate aquí</a></p>
    </main>
</body>
</html>
<main class="auth-container">
    <h2>Iniciar Sesión en ArteEnVivo</h2>

    <!-- Mensaje de éxito tras el registro -->
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'registered'): ?>
        <div class="alert-success">Registrado con éxito. ¡Ya puedes iniciar sesión!</div>
    <?php endif; ?>

    <!-- Mensaje de error (si existe) -->
    <?php if (!empty($error)): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?c=auth&a=login" class="auth-form">
        <!-- campos del formulario -->
    </form>
</main>
<form action="index.php?c=auth&a=login" method="POST">

    <!-- Campo Nombre de Usuario -->
    <div class="form-group mb-3">
        <label for="nombre">Nombre de Usuario:</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre" 
            class="form-control" 
            placeholder="Tu nombre de usuario" 
            required>
    </div>

    <!-- Campo Correo Electrónico -->
    <div class="form-group mb-3">
        <label for="email">Correo Electrónico:</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            class="form-control" 
            placeholder="correo@ejemplo.com" 
            required>
    </div>

    <!-- Campo Contraseña -->
    <div class="form-group mb-3">
        <label for="password">Contraseña:</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            class="form-control" 
            placeholder="********" 
            required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
</form>