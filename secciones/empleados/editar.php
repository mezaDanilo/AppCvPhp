<?php
// Incluye el archivo de conexión a la base de datos
include("../../bd.php");

// Consulta para obtener todos los puestos de trabajo
$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Verifica si se ha enviado el parámetro txtId a través de GET
if (isset($_GET["txtId"])) {
    // Recolecta los datos del método GET
    $txtID = (isset($_GET["txtId"])) ? $_GET["txtId"] : "";

    // Prepara la consulta para obtener los datos del empleado con el ID proporcionado
    $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id = :id");
    // Asigna el valor del ID al parámetro de la consulta
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Obtiene los datos del empleado
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Almacena los datos en variables
    $nombre = $registro["nombres"];
    $apellido = $registro["apellidos"];
    $foto = $registro["foto"];
    $cv = $registro["cv"];
    $idpuesto = $registro["idpuesto"];
    $fechadeingreso = $registro["fechadeingreso"];
}

// Verifica si se ha enviado datos a través de POST
if ($_POST) {
    // Recolecta los datos del método POST
    $txtID = (isset($_POST["txtId"])) ? $_POST["txtId"] : "";
    $nombre = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
    $apellido = (isset($_POST["apellido"])) ? $_POST["apellido"] : "";
    $idpuesto = (isset($_POST["idpuesto"])) ? $_POST["idpuesto"] : "";
    $fechadeingreso = (isset($_POST["fechadeingreso"])) ? $_POST["fechadeingreso"] : "";

    // Prepara la consulta de actualización de datos del empleado
    $sentencia = $conexion->prepare("
        UPDATE tbl_empleados
        SET 
            nombres = :nombre, 
            apellidos = :apellido, 
            idpuesto = :idpuesto,
            fechadeingreso = :fechadeingreso
        WHERE id = :id
    ");

    // Asigna los valores del formulario a los parámetros de la consulta
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellido", $apellido);
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Manejo de la carga de archivos (foto)
    $foto = (isset($_FILES["foto"]['name'])) ? $_FILES["foto"]['name'] : "";

    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto != '') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]["name"] : "";

    $tmp_foto =  $_FILES["foto"]["tmp_name"];

    if ($tmp_foto != '') {
        move_uploaded_file($tmp_foto, "./" . $nombreArchivo_foto);

        // Actualiza el nombre del archivo de la foto en la base de datos
        $sentencia = $conexion->prepare("SELECT foto from tbl_empleados WHERE id = :id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        // Elimina el archivo anterior si existe
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

        if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
            if (file_exists("./" . $registro_recuperado["foto"])) {
                unlink("./" . $registro_recuperado["foto"]);
            }
        }
        $sentencia = $conexion->prepare("UPDATE tbl_empleados SET foto = :foto WHERE id = :id");
        $sentencia->bindParam(":foto", $nombreArchivo_foto);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }

    // Manejo de la carga de archivos (cv)
    $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");

    $nombreArchivo_cv = ($cv != '') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : "";
    $tmp_cv = $_FILES["cv"]['tmp_name'];

    if ($tmp_cv != '') {
        move_uploaded_file($tmp_cv, "./" . $nombreArchivo_cv);

        $sentencia = $conexion->prepare("SELECT foto,cv FROM tbl_empleados WHERE id=:id" );
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_recuperado  = $sentencia -> fetch(PDO::FETCH_LAZY);

        if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "")
        {
            if(file_exists("./".$registro_recuperado["cv"])){
                unlink("./".$registro_recuperado["cv"]);
            }
        }

        $sentencia = $conexion->prepare("UPDATE tbl_empleados SET cv = :cv WHERE id = :id");
        $sentencia->bindParam(":cv", $nombreArchivo_cv);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }

    // Redirecciona a la página principal (debe descomentarse para redireccionar)
    $mensaje = "Registro editado";
    header("Location: index.php?mensaje=".$mensaje);

}
?>

<?php include("../../templates/header.php"); ?>
<br>

<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtId" class="form-label">ID:</label>
                <input type="text"
                value ="<?php echo $txtID;?>"
                    class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre/s</label>
              <input type="text"
              value ="<?php echo $nombre;?>"
                class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre/s">
            </div>

            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido/s</label>
              <input type="text"
              value ="<?php echo $apellido;?>"
                class="form-control" name="apellido" id="apellido" aria-describedby="apellido" placeholder="Apellido/s">
            </div>

            <div class="mb-3">
              <label for="foto" class="form-label">Foto:</label>
              
              <img width="100"
                             src="<?php echo $foto;?>"
                              class="rounded" alt="">        
                              <br><br>
              <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
            </div>

            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF)</label>
              <a href="<?php echo $cv;?>"><?php echo $cv;?></a>
              <input type="file" 
              class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                
                <select class="form-select form-select-sm" 
                name="idpuesto" id="idpuesto">
                  <?php foreach($lista_tbl_puestos as $registro){?>
                    <option <?php echo($idpuesto == $registro["id"]) ? "selected":"";?> value="<?php echo $registro['id']?>">
                      <?php echo $registro['nombredelpuesto'] ?>    
                    </option>
                  <?php } ?>
                </select>
            </div>

            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
              <input type="date" class="form-control" 
              value ="<?php echo $fechadeingreso;?>"
              name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
            </div>

            <button type="submit" class="btn btn-success">Actualizar registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>
