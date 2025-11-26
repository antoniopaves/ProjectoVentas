<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito</title>
</head>
<body>
    <h1>Carrito de compras</h1>
    <?php if(empty($productosCarro)): ?>
    <p>Vista de carrito vacía.</p>
    <?php else: ?>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Empresa</th>
            <th>Precio</th>
            <th>Cantidad en Carro</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($productosCarro as $producto): ?>
        <tr>
            <td><?php echo $producto->id_producto; ?></td>
            <td><?php echo $producto->nombre; ?></td>
            <td><?php echo $producto->empresa; ?></td>
            <td><?php echo $producto->precio; ?></td>
            <td><?php echo $producto->cantidad_carrito; ?></td>
            <td>
                <img src="<?php echo CORE_URL . 'src/img/' . $producto->img; ?>" 
                alt="Imagen del producto" 
                width="100">
            </td>
            <td>
                <a href="<?php echo BASE_URL . '?controller=ControllerProducto&action=eliminarDelCarro&id_producto=' . $producto->id_producto; ?>">Eliminar del Carro</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>