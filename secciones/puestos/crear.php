<?php

include("../../bd.php");

if($_POST){
    print_r($_POST);

    //Recolectamos los datos del método POST
    $nombredelpuesto = (isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] :"");
    //Preparar la insercción de los datos
    $sentencia = $conexion -> prepare("INSERT INTO tbl_puestos(id,nombredelpuesto)
                                VALUES (null, :nombredelpuesto)"); 
    //Asignando los valores que vienen del método POST (los que vienen del formulario)
    $sentencia -> bindParam(":nombredelpuesto", $nombredelpuesto);
    $sentencia -> execute(); 
    $mensaje = "Registro agregado";
    header("Location: index.php?mensaje=".$mensaje);


}


?>
<?php include("../../templates/header.php"); ?>

<br>

<div class="card">
    <div class="card-header">
        Puestos
    </div>
    <div class="card-body">
        
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
          <input type="text"
            class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
        </div>

    <button type="submit" class="btn btn-success">Agregar</button>  
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
    
<?php include("../../templates/footer.php"); ?>