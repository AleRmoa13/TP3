<?php
$conexion = new mysqli("mysql-aler13.alwaysdata.net", "aler13", "Ar44783122", "aler13_insertar_crud");

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$resultado = $conexion->query("SELECT * FROM pilotos WHERE id = $id"); 

$piloto = $resultado->fetch_assoc();

if (!$piloto) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellido = $conexion->real_escape_string($_POST['apellido']);
    $nacionalidad = $conexion->real_escape_string($_POST['nacionalidad']);
    $fecha_nacimiento = $conexion->real_escape_string($_POST['fecha_nacimiento']);
    $campeonatos_ganados = $conexion->real_escape_string($_POST['campeonatos_ganados']);
    $imagen_url = $conexion->real_escape_string($_POST['imagen_url']); 

    $query = "UPDATE pilotos SET nombre = '$nombre', apellido = '$apellido', nacionalidad = '$nacionalidad', 
    fecha_nacimiento = '$fecha_nacimiento', campeonatos_ganados = '$campeonatos_ganados', img = '$imagen_url' WHERE id = $id";

    if ($conexion->query($query) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al actualizar: " . $conexion->error; // Para depuración
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Registro</h1>

        <form action="" method="POST" class="formulario-nuevo">
            <input type="hidden" name="id" value="<?php echo $piloto['id']; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $piloto['nombre']; ?>" required>
            
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" value="<?php echo $piloto['apellido']; ?>" required>
            
            <label for="nacionalidad">Nacionalidad:</label> <!-- Corregido el typo 'Nacionaliad' -->
            <input type="text" name="nacionalidad" value="<?php echo $piloto['nacionalidad']; ?>" required>
            
            <label for="fecha_nacimiento">Fecha Nacimiento:</label>
            <input type="text" name="fecha_nacimiento" value="<?php echo $piloto['fecha_nacimiento']; ?>" required>
            
            <label for="campeonatos_ganados">Campeonatos Ganados:</label>
            <input type="text" name="campeonatos_ganados" value="<?php echo $piloto['campeonatos_ganados']; ?>" required>

            <label for="imagen_url">URL de la Imagen:</label>
            <input type="url" name="imagen_url" value="<?php echo $piloto['img']; ?>" required
                onchange="previewImage(this, 'preview-image')">

            <div class="preview-container">
                <img id="preview-image" src="<?php echo $piloto['img']; ?>" alt="Vista previa">
            </div>

            <div class="botones-container">
                <button type="submit">Aceptar</button>
                <a href="index.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="Js/editar.js"></script>
</body>

</html>

<?php $conexion->close(); ?>

