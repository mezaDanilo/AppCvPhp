<?php

include("../../bd.php");

if($_POST){
    #print_r($_POST);
    #print_r($_FILES);

    //Recolectamos los datos del método POST
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] :"");
    $apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] :"");
    $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] :"");
    $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] :"");
    $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] :"");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] :"");
    //Preparar la insercción de los datos
    $sentencia = $conexion -> prepare("INSERT INTO tbl_empleados(id,nombres,apellidos,foto,cv,idpuesto,fechadeingreso)
                                    VALUES (null, :nombre, :apellido, :foto, :cv, :idpuesto, :fechadeingreso)
                                  "); 

    //Asignando los valores que vienen del método POST (los que vienen del formulario)
     $sentencia -> bindParam(":nombre", $nombre);
     $sentencia -> bindParam(":apellido", $apellido);


    //ADJUNTO LA FOTO
    $fecha_ = new DateTime();

    $nombreArchivo_foto = ($foto != '')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    $tmp_foto =  $_FILES["foto"]["tmp_name"];
    if($tmp_foto != ''){
      move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);
    }
     $sentencia -> bindParam(":foto", $nombreArchivo_foto);

     //PARA EL ARCHIVO
     $nombreArchivo_cv = ($cv != '')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:"";
     $tmp_cv =  $_FILES["cv"]["tmp_name"];
     if($tmp_cv != ''){
       move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
     }


     $sentencia -> bindParam(":cv", $nombreArchivo_cv);
     $sentencia -> bindParam(":idpuesto", $idpuesto);
     $sentencia -> bindParam(":fechadeingreso", $fechadeingreso);
     
    $sentencia -> execute(); 

    header("Location:index.php");
}



$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos  = $sentencia -> fetchAll(PDO::FETCH_ASSOC);


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
              <label for="nombre" class="form-label">Nombre/s</label>
              <input type="text"primerapellido
                class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre/s">
            </div>

            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido/s</label>
              <input type="text"
                class="form-control" name="apellido" id="apellido" aria-describedby="apellido" placeholder="Apellido/s">
            </div>

            <div class="mb-3">
              <label for="foto" class="form-label">Foto:</label>
              <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
            </div>


            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF)</label>
              <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                  <?php foreach($lista_tbl_puestos as $registro){?>
                    <option value="<?php echo $registro['id']?>">
                      <?php echo $registro['nombredelpuesto'] ?>
                    </option>
                  <?php } ?>
                </select>
            </div>

            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
              <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
              
            </div>

            <button type="submitn" class="btn btn-success">Agregar registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>