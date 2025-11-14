<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
</head>
<body>
    <h1>Agregar nuevo producto</h1>
    <form action="<?php echo BASE_URL; ?>?controller=ControllerProducto&action=postNuevoProducto" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre del producto</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ejemplo: Chocolate 50gr Negro" required>

        <label for="empresa">Nombre de la Empresa</label>
        <input type="text" id="empresa" name="empresa" placeholder="Ejemplo: Hellmans" required>

        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" placeholder="Ejemplo: 1 al ∞" required>

        <label for="cantidad">Cantidad</label>
        <input type="number" id="cantidad" name="cantidad" placeholder="Ejemplo: 1 al ∞" required>

        <label for="img">Imagen(Nombre del Archivo con Extension)</label>
        <input type="text" id="img" name="img" placeholder="Ejemplo: IMG.jpg" required>

        <div class="actions">
            <button type="submit">Guardar producto</button>
        </div>
    </form>
</body>
</html>
