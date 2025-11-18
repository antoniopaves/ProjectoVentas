<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="<?php echo CORE_URL . 'src/css/viewEditarNuevoStyle.css'; ?>">
<body>
   <h1>Editar Producto</h1>
    <form action="<?php echo BASE_URL . '?controller=ControllerProducto&action=postEditarProducto'; ?>" method="post">
        <label for="nombre">Nombre del producto</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $producto->nombre ?>" >

        <label for="empresa">Nombre de la Empresa</label>
        <input type="text" id="empresa" name="empresa" value="<?php echo $producto->empresa ?>" >

        <label for="precio">Precio</label>
        <input type="number" step="0.01" id="precio" name="precio" value="<?php echo $producto->precio ?>" >

        <label for="cantidad">Cantidad</label>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo $producto->cantidad ?>" >

        <label for="img">Imagen(Nombre del Archivo con Extension)</label>
        <input type="text" id="img" name="img" value="<?php echo $producto->img ?>" >

        <input type="hidden" name="id_producto" value="<?php echo $producto->id_producto ?>">

        <div class="actions">
            <button type="submit">Guardar Cambios</button>
        </div>
    </form>
</body>
</html>