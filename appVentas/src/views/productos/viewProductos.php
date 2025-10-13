<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <table border="1" >
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Empresa</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Imagen</th>
        </tr>
        <?php foreach($producto as $p) { ?>
            <tr>
                <th><?php echo $p->id_producto ?></th>
                <th><?php echo $p->nombre ?></th>
                <th><?php echo $p->empresa ?></th>
                <th><?php echo $p->precio ?></th>
                <th><?php echo $p->cantidad ?></th>
                <th><?php echo $p->img ?></th>
        <?php } ?>
    </table>
</body>
</html>