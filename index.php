<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Alta Usuarios</title>
</head>
<body>
<?php
    include_once("conexion.php");
    $link=conectarBD();
    /* Insercciones */
    if (!empty($_POST["nombre"]) && !empty($_POST["apellidos"])) {
        $nombre=$_POST["nombre"];
        $apellidos=$_POST["apellidos"];

        //Se crea la consulta, pero no se ejecuta
        $insersion="INSERT INTO datos (nombre, apellidos) VALUES ('$nombre', '$apellidos')";
        echo $insersion;
        //Ejecutar la consulta y se guarda en una variable el resultado
        $resultado=mysqli_query($link, $insersion);
        if ($resultado) {
            echo "Se ha dado de alta el usuario correctamente";
        }else{
            echo "Error.Al dar de alta al usuario";
        }
    }
    /* Mostrar las personas dadas de alta */
    $consulta="SELECT * FROM datos";
    $resultado=mysqli_query($link, $consulta); //Array de los resultados, y puede verse como array asociativos.
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<li>".$fila["nombre"]." ".$fila["apellidos"]."</li>";
    }

?>


<hr>
<section class="container">
    <h1>Alta de Usuarios</h1>
    <form action="index.php" method="post">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" required>
        </div>
        <div>
            <input type="submit" value="Alta">
            <input type="reset" value="Limpiar">
        </div>
    </form>
    <a href="update.php">Modificar o Eliminar Usuarios</a>
</section>
</body>
</html>
