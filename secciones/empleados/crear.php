<?php include("../../templates/header.php"); ?>

<br>

<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">

        <form action="nombre" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="nombr" class="form-label">Nombre/s</label>
              <input type="text"primerapellido
                class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre/s">
            </div>

            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido/s</label>
              <input type="text"
                class="form-control" name="apellido" id="apellido" aria-describedby="apellido" placeholder="Apellido/s">
            </div>

            <div class="mb-3">
              <label for="apellido" class="form-label">Foto:</label>
              <input type="file"
                class="form-control" name="foto" id="foo" aria-describedby="helpId" placeholder="Foto">
            </div>


        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>