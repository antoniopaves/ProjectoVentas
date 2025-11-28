<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito</title>
</head>
<link rel="stylesheet" href="<?php echo CORE_URL . 'src/css/viewCarroStyle.css'; ?>">
<body>
    <h1>Carrito de compras</h1>
    <?php if(empty($productosCarro)): ?>
    <p>Vista de carrito vacía.</p>
    <a href="<?php echo BASE_URL."?controller=ControllerProducto&action=mostrarProductos" ?>">Volver a la Lista</a>
    <?php else: ?>
    <a href="<?php echo BASE_URL."?controller=ControllerProducto&action=mostrarProductos" ?>">Volver a la Lista</a>
    <form action="<?php echo BASE_URL.'?controller=ControllerProducto&action=Comprar'; ?>" method="post">
    <button type="submit" class="boton-comprar">Comprar</button>
    </form>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Empresa</th>
            <th>Precio</th>
            <th>Cantidad en Carro</th>
            <th>Imagen</th>
            <th>Eliminar del Carro</th>
            <th>Eliminar uno del Carro</th>
        </tr>
        <?php foreach($productosCarro as $producto): ?>
        <tr>
            <th><?php echo $producto->id_producto; ?></th>
            <th><?php echo $producto->nombre; ?></th>
            <th><?php echo $producto->empresa; ?></th>
            <th><?php echo $producto->precio; ?></th>
            <th><?php echo $producto->cantidad_carrito; ?></th>
            <th>
                <img src="<?php echo CORE_URL . 'src/img/' . $producto->img; ?>" 
                alt="Imagen del producto" 
                width="100">
            </th>
            <th>
                <a href="<?php echo BASE_URL . '?controller=ControllerProducto&action=eliminarDelCarro&id_producto=' . $producto->id_producto; ?>">Eliminar del Carro</a></th>
            <th><a href="<?php echo BASE_URL . '?controller=ControllerProducto&action=eliminarUnoDelCarro&id_producto=' . $producto->id_producto; ?>">Eliminar uno del Carro</a></th>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>