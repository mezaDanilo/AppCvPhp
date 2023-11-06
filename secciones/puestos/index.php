<?php

include("../../bd.php");

$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos  = $sentencia -> fetchAll(PDO::FETCH_ASSOC);


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
        <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del puesto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach($lista_tbl_puestos as $registro){?>
            
                <tr class="">
                    <td scope="row"><?php echo $registro['id'];?></td>
                    <td><?php echo $registro['nombredelpuesto'];?></td>
                    <td>
                        <input name="btneditar" id="btneditar" class="btn btn-info" type="button" value="Editar">
                        <input name="btnborrar" id="btnborrar" class="btn btn-danger" type="button" value="Borrar">
                    </td>
                </tr>
                
            <?php } ?>

            </tbody>
        </table>
</div>        
    </div>
</div>



    
<?php include("../../templates/footer.php"); ?>