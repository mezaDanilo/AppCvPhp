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


            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF)</label>
              <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                    <option selected>Select one</option>
                    <option value="">New Delhi</option>
                    <option value="">Istanbul</option>
                    <option value="">Jakarta</option>
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