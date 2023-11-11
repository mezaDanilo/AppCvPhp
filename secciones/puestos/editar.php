<?php

include("../../bd.php");

if(isset($_GET["txtId"])){

    //Recolectamos los datos del método GET
    $txtID = (isset($_GET["txtId"]))?$_GET["txtId"] :"";

    //Preparar la eliminacion de los datos
    $sentencia = $conexion -> prepare("SELECT * FROM tbl_puestos WHERE id =:id");
    //Asignando valores del GET
    $sentencia->bindParam(":id", $txtID);

    $sentencia -> execute();
    //Cargando dato del nombre de puesto
    $registro = $sentencia -> fetch(PDO::FETCH_LAZY);
    $nombredelpuesto = $registro["nombredelpuesto"];
      
}

if($_POST){
    //print_r($_POST);

    //Recolectamos los datos del método POST
    $txtID = (isset($_POST["txtId"]))?$_POST["txtId"] :"";
    $nombredelpuesto = (isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] :"");
    //Preparar la actuzalizacion de los datos
    $sentencia = $conexion -> prepare("UPDATE tbl_puestos 
    SET nombredelpuesto=:nombredelpuesto 
    WHERE tbl_puestos. id=:id");
    //Asignando los valores que vienen del método POST
    $sentencia -> bindParam(":nombredelpuesto", $nombredelpuesto);
    $sentencia->bindParam(":id", $txtID);
    $sentencia -> execute(); 

    $mensaje = "Registro actualizado";
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
      <label for="txtId" class="form-label">ID:</label>
      <input type="text"
       value ="<?php echo $txtID;?>"
        class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="ID">
    </div>


    <div class="mb-3">
        <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
        <input type="text"
        value ="<?php echo $nombredelpuesto;?>"
        class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>  
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    <div class="card-footer text-muted"></div>
</div>
    
<?php include("../../templates/footer.php"); ?>