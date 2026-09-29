<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="max-width: 600px; margin: 4rem auto; text-align: center; background: #161616; padding: 3rem; border-radius: 8px; border: 1px solid #2ecc71; color: #fff;">
    <h1 style="font-size: 3rem; margin-bottom: 1rem;">🎉</h1>
    <h2 style="color: #2ecc71;">¡Compra Realizada con Éxito!</h2>
    <p style="margin-top: 1rem; color: #ccc;">
        Gracias <strong><?= htmlspecialchars($comprador) ?></strong> por adquirir esta obra. Hemos enviado los detalles del comprobante a tu correo electrónico.
    </p>
    <a href="index.php?c=galeria&a=index" style="display: inline-block; margin-top: 2rem; background: #ff3b5c; color: #fff; padding: 0.8rem 1.5rem; text-decoration: none; font-weight: bold; border-radius: 5px;">
        Volver a la Galería
    </a>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>