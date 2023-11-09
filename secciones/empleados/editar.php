<?php
include("../../bd.php");


$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos  = $sentencia -> fetchAll(PDO::FETCH_ASSOC);



//TRAIGO DATOS PARA MOSTRAR

if(isset($_GET["txtId"])){

    //Recolectamos los datos del método GET
    $txtID = (isset($_GET["txtId"]))?$_GET["txtId"] :"";

    //Preparar la eliminacion de los datos
    $sentencia = $conexion -> prepare("SELECT * FROM tbl_empleados WHERE id =:id");
    //Asignando valores del GET
    $sentencia->bindParam(":id", $txtID);

    $sentencia -> execute();
    //Cargando dato del nombre de puesto
    $registro = $sentencia -> fetch(PDO::FETCH_LAZY);
    //print_r($registro);

    $nombre = $registro["nombres"];
    $apellido = $registro["apellidos"];

    $foto = $registro["foto"];
    $cv = $registro["cv"];

    $idpuesto = $registro["idpuesto"];
    $fechadeingreso = $registro["fechadeingreso"];


      
}

// ACTUALIZAR BD
if($_POST){
    print_r($_POST);

    //Recolectamos los datos del método POST
    $txtID = (isset($_POST["txtId"]))?$_POST["txtId"] :"";
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] :"");
    $apellido  = (isset($_POST["apellido"]) ? $_POST["apellido"] :"");
    $foto = (isset($__FILES["foto"]) ? $_POST["foto"] :"");
    $cv = (isset($__FILES["cv"]) ? $_POST["cv"] :"");
    $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] :"");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] :"");
    //Preparar la actuzalizacion de los datos
    $sentencia = $conexion -> prepare("UPDATE tbl_empleados
    SET nombres=:nombre, apellidos=:apellido, foto=:foto, cv=:cv, idpuesto=:idpuesto, fechadeingreso=:fechadeingreso
    WHERE tbl_empleados.id=:id");
    //Asignando los valores que vienen del método POST
    
    $sentencia->bindParam(":id", $txtID);
    $sentencia -> bindParam(":nombre", $nombre);
    $sentencia -> bindParam(":apellido", $apellido);

    $fecha_ = new DateTime();



    $sentencia -> bindParam("foto", $foto);
    $sentencia -> bindParam(":cv", $cv);
    $sentencia -> bindParam(":idpuesto", $idpuesto);
    $sentencia -> bindParam(":fechadeingreso", $fechadeingreso);


    $sentencia -> execute(); 

    header("Location:index.php");
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
              <input type="text"primerapellido 
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
              <br>
              CV: <a href="<?php echo $cv;?>"><?php echo $cv;?></a>
              <input type="file" 
              class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                
                <select class="form-select form-select-sm" 
                name="idpuesto" id="idpuesto">
                  <?php foreach($lista_tbl_puestos as $registro){?>
                    <option <?php echo($idpuesto == $registro["id"])? "selected":"";?> value="<?php echo $registro['id']?>">
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

            <button type="submitn" class="btn btn-success">Actualizar registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
    
<?php include("../../templates/footer.php"); ?>