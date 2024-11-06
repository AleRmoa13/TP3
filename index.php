<?php 
 $conexion = new mysqli("mysql-aler13.alwaysdata.net", "aler13", "Ar44783122", "aler13_insertar_crud");
    
    if (isset($_GET['eliminar'])) {
        $id = $_GET['eliminar'];
        $conexion->query("DELETE FROM pilotos WHERE id = $id");
    }
    
    $resultado = $conexion->query("SELECT * FROM pilotos");
    ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP y MySQL</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Lista de pilotos de la F1</h1>
    <div class="container">
        <a href="agregar.php" class="btn-agregar">Agregar nuevo piloto</a>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nacionalidad</th>
                    <th>Fecha Nacimiento</th>
                    <th>Campeonatos Ganados</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><?php echo $fila['apellido']; ?></td>
                        <td><?php echo $fila['nacionalidad']; ?></td>
                        <td><?php echo $fila['fecha_nacimiento']; ?></td>
                        <td><?php echo $fila['campeonatos_ganados']; ?></td>
                        <td class="imagen-celda"><img src="<?php echo $fila['img']; ?>" alt="Imagen"></td>
                        <td>
                            <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn-accion btn-editar">Editar</a>
                            <a href="?eliminar=<?php echo $fila['id']; ?>"
                                onclick="return confirm('¿Estás seguro de eliminar este registro?')"
                                class="btn-accion btn-eliminar">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php $conexion->close(); ?>