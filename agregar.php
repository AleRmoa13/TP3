<?php
$conexion = new mysqli("mysql-aler13.alwaysdata.net", "aler13", "Ar44783122", "aler13_insertar_crud");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['guardar'])) {
       
        $nombre = $conexion->real_escape_string($_POST['nombre']);
        $apellido = $conexion->real_escape_string($_POST['apellido']);
        $nacionalidad = $conexion->real_escape_string($_POST['nacionalidad']);
        $fecha_nacimiento = $conexion->real_escape_string($_POST['fecha_nacimiento']);
        $campeonatos_ganados = $conexion->real_escape_string($_POST['campeonatos_ganados']);
        $imagen_url = $conexion->real_escape_string($_POST['img']);
        
        $conexion->query("INSERT INTO pilotos (nombre, apellido, nacionalidad, fecha_nacimiento, campeonatos_ganados, img) 
        VALUES ('$nombre', '$apellido', '$nacionalidad', '$fecha_nacimiento', '$campeonatos_ganados', '$imagen_url')");
        
        if ($conexion->affected_rows > 0) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error al agregar el piloto: " . $conexion->error; 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Piloto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Nuevo Piloto</h1>
        <div class="formulario-nuevo">
            <form action="" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
                
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required>
            
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" name="nacionalidad" required>
            
                <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                <input type="text" name="fecha_nacimiento" required>
            
                <label for="campeonatos_ganados">Campeonatos Ganados:</label>
                <input type="text" name="campeonatos_ganados" required>
                
                <label for="imagen_url">URL de la Imagen:</label>
                <input type="url" name="img" required onchange="previewImage(this, 'preview-new')">
                
                <div class="preview-container">
                    <img id="preview-new" src="" alt="Vista previa">
                </div>
                
                <button type="submit" name="guardar">Guardar</button>
                <a href="index.php" class="btn-volver">Volver a la lista</a>
            </form>
        </div>
    </div>

    <script src="Js/agregar.js"></script>
</body>
</html>

<?php $conexion->close(); ?>