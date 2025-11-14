<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="<?php echo CORE_URL . 'src/css/viewProductosStyle.css'; ?>">
<body>
    <a href="<?php echo BASE_URL."?controller=ControllerProducto&action=viewNuevoProducto" ?>">Nuevo Producto</a>
    <form action="<?php echo BASE_URL; ?>?controller=ControllerProducto&action=buscarProductoID" method="post" enctype="multipart/form-data">
    <label for="Producto">Buscar Producto Por ID</label>
        <input type="number" id="id_producto" name="id_producto" placeholder="Ejemplo: 1 al ∞" >
        <div class="actions">
            <button type="submit">Buscar producto</button>
        </div>
    </form>

<?php if (!empty($productos) && is_array($productos)) { ?>
   <table border="1" >
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Empresa</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Imagen</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php foreach($productos as $p){ ?>
            <tr>
                <th><?php echo $p->id_producto; ?></th>
                <th><?php echo $p->nombre; ?></th>
                <th><?php echo $p->empresa; ?></th>
                <th><?php echo $p->precio; ?></th>
                <th><?php echo $p->cantidad; ?></th>
                <th>
                <img src="<?php echo CORE_URL . 'src/img/' . $p->img; ?>" 
                alt="Imagen del producto" 
                width="100">
                </th>
                <th><a href="<?php echo BASE_URL."?controller=ControllerProducto&action=viewEditarProducto&id_producto=$p->id_producto" ?>">Editar</a></th>
                <th><a href="<?php echo BASE_URL."?controller=ControllerProducto&action=EliminarProducto&id_producto=$p->id_producto" ?>">Eliminar</a></th>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>No hay productos para mostrar.</p>
<?php } ?>
</body>
</html>