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

    <button type="button" class="btn btn-success">Agregar</button>  
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
    
<?php include("../../templates/footer.php"); ?>