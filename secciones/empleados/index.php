<?php

include("../../bd.php");

$sentencia = $conexion->prepare("SELECT *,
#subconsulta para sacar el valor del puesto
(SELECT nombredelpuesto 
FROM tbl_puestos 
WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto

FROM tbl_empleados");
$sentencia->execute();
$lista_tbl_empleados  = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

//TRAIGO LOS DATOS PARA MOSTRAR EN EL FORMULARIO

if(isset($_GET["txtId"])){

    //BUSCAR EL ARCH RELACIONADO CON EL EMPLEADO
    $txtId = (isset($_GET["txtId"]))?$_GET["txtId"] :"";
    $sentencia = $conexion->prepare("SELECT foto,cv FROM tbl_empleados WHERE id=:id" );
    $sentencia->bindParam(":id", $txtId);

    $sentencia->execute();
    //FETCH LAZY TRAE SOLO UN REGISTRO
    $registro_recuperado  = $sentencia -> fetch(PDO::FETCH_LAZY);

        print_r($registro_recuperado);
    
        if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "")
        {
            if(file_exists("./".$registro_recuperado["foto"])){
                unlink("./".$registro_recuperado["foto"]);
            }
        }

        if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "")
        {
            if(file_exists("./".$registro_recuperado["cv"])){
                unlink("./".$registro_recuperado["cv"]);
            }
        }


    $txtID = (isset($_GET["txtId"]))?$_GET["txtId"] :"";
      //Preparar la eliminacion de los datos
      $sentencia = $conexion -> prepare("DELETE FROM tbl_empleados WHERE id =:id");
      
      $sentencia->bindParam(":id", $txtID);
      $sentencia -> execute();
      header("Location: index.php");
      
}
?>


<?php include("../../templates/header.php"); ?>

<br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar registro</a>
    </div>
    
    <div class="card-body">
        <div class="table">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_tbl_empleados as $registro){?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id'];?></td>
                        <td><?php echo $registro['nombres']; echo " ".$registro['apellidos'];?></td>      

                        <td>
                            <img width="50"
                             src="<?php echo $registro['foto'];?>"
                              class="img-fluid rounded" alt="">   
                                                       
                        </td>

                        <td>
                            
                            
                            <a href="<?php echo $registro['cv'];?>" target="new_tab"><?php echo $registro['cv'];?></a>
              
                        </td>

                        <td><?php echo $registro['puesto'];?></td>
                        <td><?php echo $registro['fechadeingreso'];?></td>
                        <td>
                            <a name="" id="" class="btn btn-success" href="carta_recomendacion.php?txtId=<?php echo $registro['id'];?>"  role="button">Carta</a>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $registro['id'];?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtId=<?php echo $registro['id'];?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
    
<?php include("../../templates/footer.php"); ?>