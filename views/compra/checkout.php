<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
    .checkout-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background: #161616;
        border-radius: 8px;
        color: #fff;
        border: 1px solid #333;
    }
    .grid-checkout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 1.5rem;
    }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; margin-bottom: 0.4rem; color: #ccc; }
    .form-group input, .form-group select {
        width: 100%; padding: 0.6rem; background: #222; color: #fff; border: 1px solid #444; border-radius: 4px;
    }
    .btn-pagar {
        width: 100%; padding: 0.8rem; background: #2ecc71; color: #fff; border: none; font-size: 1rem;
        font-weight: bold; border-radius: 5px; cursor: pointer; margin-top: 1rem;
    }
    .btn-pagar:hover { background: #27ae60; }
</style>

<div class="checkout-container">
    <h2>🛍️ Proceso de Compra</h2>
    
    <div class="grid-checkout">
        <!-- Resumen de la Obra -->
        <div style="background: #222; padding: 1rem; border-radius: 6px;">
            <h3>Resumen del Pedido</h3>
            <hr style="border-color: #333; margin: 0.8rem 0;">
            <p><strong>Obra:</strong> <?= htmlspecialchars($obra['titulo'] ?? $obra['nombre'] ?? 'Geometría Urbana') ?></p>
            <p><strong>Precio:</strong> <span style="color: #2ecc71; font-weight: bold;">$<?= htmlspecialchars($obra['precio'] ?? '400.00') ?></span></p>
        </div>

        <!-- Formulario de Datos y Pago -->
        <form action="index.php?c=compra&a=procesar" method="POST">
            <input type="hidden" name="obra_id" value="<?= $obra['id'] ?>">

            <div class="form-group">
                <label>Nombre Completo:</label>
                <input type="text" name="nombre_comprador" required placeholder="Tu nombre completo">
            </div>

            <div class="form-group">
                <label>Correo Electrónico:</label>
                <input type="email" name="email_comprador" required placeholder="correo@ejemplo.com">
            </div>

            <div class="form-group">
                <label>Método de Pago:</label>
                <select name="metodo_pago" required>
                    <option value="tarjeta">💳 Tarjeta de Crédito / Débito</option>
                    <option value="paypal">🅿️ PayPal</option>
                    <option value="transferencia">🏦 Transferencia Bancaria</option>
                </select>
            </div>

            <button type="submit" class="btn-pagar">Confirmar y Pagar</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>