<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Actualizar-Borrar</title>
</head>
<body>
<?php
    include_once("conexion.php");
    $link=conectarBD();
    if (!empty($_GET["opcion"])&&$_GET["opcion"]=="borrar") {
        $id=$_GET["id"];
        $consulta="DELETE FROM datos WHERE id=$id";
        $resultado=mysqli_query($link,$consulta);
        if ($resultado){
            echo "<br>El resgistro fue borrado correctamente";
        }else{
            echo "<br>El resgistro no fue borrado correctamente";
        }
    }

    if(isset($_POST["nombre"])&&isset($_POST["apellidos"])){
        $actualizar="update datos set nombre='$_POST[nombre]', apellidos='$_POST[apellidos]' WHERE id='$_POST[id]'";
        $resultado=mysqli_query($link,$actualizar);
        if ($resultado){
            echo "<br>El registro fue actualizado correctamente";
        }else{
            echo "<p style='color: darkred'><br>ERROR. Registro no actualizado</p>";
        }
    }

?>
<div class="contanier">
    <table class="tabla-form">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <ht>ACCIONES</ht>
        </tr>
        <?php
            $sql="SELECT * FROM datos";
            $resultado=mysqli_query($link,$sql);
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                    echo "<td>".$fila["id"]."</td>";
                    echo "<td>".$fila["nombre"]."</td>";
                    echo "<td>".$fila["apellidos"]."</td>";
                    echo "<td><a href='update.php?opcion=actualizar&id=".$fila["id"]."'>Actualizar</a></td>";
                    echo "<td><a href='update.php?opcion=borrar&id=".$fila["id"]."'>Borrar</a></td>";


                echo "</tr>";
            }

        ?>
    </table>

    <?php
    if (isset($_GET["opcion"])&&$_GET["opcion"]=="actualizar") {
        $consulta="select * from datos where id=$_GET[id]";
        $resultado=mysqli_query($link,$consulta);
        // OJO -> Si el resultado es solo un registro, no se necesita un bucle para obtener el array, sino únicamente un: mysqli_fetch_assoc($array).
        $row=mysqli_fetch_assoc($resultado); //$row["nommbre"] -> Me traerá el nombre de la BBDD.
    ?>
        <!--  Formulario de Actualización  -->
        <form action="" method="post">
            <input type="hidden" value="<?=$row['id']?>" name="id">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?=$row['nombre']?>">
            </div>
            <div>
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" value="<?=$row['apellidos']?>">
            </div>
            <div>
                <input type="submit" value="Actualizar">
                <input type="reset" value="Limpiar">
            </div>
        </form>

    <?php
    }
    ?>

</div>

</body>
</html>