<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - ArteEnVivo</title>
    <link rel="stylesheet" href="/arte_en_vivo/public/css/styles.css">
    <style>
        .auth-container {
            max-width: 480px;
            margin: 3rem auto;
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        .auth-container h2 {
            margin-bottom: 1.5rem;
            color: #111;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1.2rem;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 0.4rem;
            font-size: 0.9rem;
            color: #333;
        }
        .form-group input, .form-group select, .form-group textarea {
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.95rem;
            width: 100%;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 90px;
        }
        .btn-submit {
            width: 100%;
            padding: 0.8rem;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
        }
        .btn-submit:hover {
            background: #333;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        .auth-footer a {
            color: #0066cc;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="auth-container">
    <h2>Crear Cuenta en ArteEnVivo</h2>

    <?php if (!empty($error)): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="index.php?c=auth&a=register" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ej. Juan Pérez" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" placeholder="juan@ejemplo.com" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de Cuenta</label>
            <select id="tipo" name="tipo">
                <option value="visitante">Comprador / Visitante</option>
                <option value="artista">Artista</option>
            </select>
        </div>

        <div class="form-group">
            <label for="biografia">Biografía / Presentación (Opcional)</label>
            <textarea id="biografia" name="biografia" placeholder="Escribe una breve presentación si eres artista..."></textarea>
        </div>

        <button type="submit" class="btn-submit">Registrarse</button>
    </form>

    <div class="auth-footer">
        ¿Ya tienes cuenta? <a href="index.php?c=auth&a=login">Inicia sesión</a>
    </div>
</div>

</body>
</html>