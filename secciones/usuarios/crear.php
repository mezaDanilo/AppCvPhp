<?php

include("../../bd.php");

if($_POST){
    print_r($_POST);

    //Recolectamos los datos del método POST
    $nombredelusuario = (isset($_POST["nombredelusuario"]) ? $_POST["nombredelusuario"] :"");
    $password = (isset($_POST["password"]) ? $_POST["password"] :"");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] :"");
    //Preparar la insercción de los datos
    $sentencia = $conexion -> prepare("INSERT INTO tbl_usuarios(id,usuario,password,correo)
                                    VALUES (null, :nombredelusuario, :password,:correo)"); 
    //Asignando los valores que vienen del método POST (los que vienen del formulario)
     $sentencia -> bindParam(":nombredelusuario", $nombredelusuario);
     $sentencia -> bindParam(":password", $password);
     $sentencia -> bindParam(":correo", $correo);
     

    $sentencia -> execute(); 
    $mensaje = "Registro agregado";
    header("Location: index.php?mensaje=".$mensaje);

}


?>

<?php include("../../templates/header.php"); ?>

<br>

<div class="card">
    <div class="card-header">
        Datos del usuarios 
    </div>
    <div class="card-body">
        
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="nombredelusuario" class="form-label">Nombre del usuario:</label>
          <input type="text"
            class="form-control" name="nombredelusuario" id="nombredelusuario" aria-describedby="helpId" placeholder="Nombre del usuario">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password"
            class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="email"
            class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su Correo">
        </div>

    <button type="submit" class="btn btn-success">Agregar</button>  
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
    
<?php include("../../templates/footer.php"); ?>