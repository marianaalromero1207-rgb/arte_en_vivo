<div class="checkout-container">
    <h2>Checkout - Confirmar Compra</h2>
    <div class="resumen-obra">
        <h3>Obra: <?= htmlspecialchars($obra['titulo']) ?></h3>
        <p><strong>Precio:</strong> $<?= number_format($obra['precio'], 2) ?> USD</p>
    </div>

    <form action="index.php?c=pago&a=procesar" method="POST" class="form-pago">
        <input type="hidden" name="id_obra" value="<?= $obra['id'] ?>">
        <input type="hidden" name="monto" value="<?= $obra['precio'] ?>">

        <h4>Método de Pago (Simulación de Pasarela)</h4>
        <div class="form-group">
            <label for="tarjeta">Número de Tarjeta:</label>
            <input type="text" id="tarjeta" placeholder="4532 •••• •••• 8890" required>
        </div>
        <div class="form-group">
            <label for="titular">Nombre en la Tarjeta:</label>
            <input type="text" id="titular" required>
        </div>

        <button type="submit" class="btn btn-success">Completar Compra Directa</button>
    </form>
</div>