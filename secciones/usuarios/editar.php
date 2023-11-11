<?php

include("../../bd.php");

if(isset($_GET["txtId"])){

    //Recolectamos los datos del método GET
    $txtID = (isset($_GET["txtId"]))?$_GET["txtId"] :"";

    //Lectura de datos
    $sentencia = $conexion -> prepare("SELECT * FROM tbl_usuarios WHERE id =:id");
    //Asignando valores del GET
    $sentencia->bindParam(":id", $txtID);

    $sentencia -> execute();
    //Cargando dato del nombre de puesto
    $registro = $sentencia -> fetch(PDO::FETCH_LAZY);
    $nombredelusuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];

      
}

if($_POST){
    //print_r($_POST);

    //Recolectamos los datos del método POST
    $txtID = (isset($_POST["txtId"]))?$_POST["txtId"] :"";
    $nombredelusuario = (isset($_POST["nombredelusuario"]) ? $_POST["nombredelusuario"] :"");
    $password  = (isset($_POST["password"]) ? $_POST["password"] :"");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] :"");
    //Preparar la actuzalizacion de los datos
    $sentencia = $conexion -> prepare("UPDATE tbl_usuarios 
    SET usuario=:nombredelusuario, password=:password, correo=:correo
    WHERE tbl_usuarios. id=:id");
    //Asignando los valores que vienen del método POST
    $sentencia -> bindParam(":nombredelusuario", $nombredelusuario);
    $sentencia -> bindParam(":password", $password);
    $sentencia -> bindParam(":correo", $correo);
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
        <label for="nombredelusuario" class="form-label">Nombre del usuario:</label>
        <input type="text"
        value ="<?php echo $nombredelusuario;?>"
        class="form-control" name="nombredelusuario" id="nombredelusuario" aria-describedby="helpId" placeholder="Nombre del usuario">
    </div>

    
        <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password"
        value ="<?php echo $password;?>"
        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña">
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email"
        value ="<?php echo $correo;?>"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>  
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
    <div class="card-footer text-muted"></div>
</div>
    
<?php include("../../templates/footer.php"); ?>