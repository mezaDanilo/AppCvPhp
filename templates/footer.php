</main>
  <footer>
    <br>
    <!-- place footer here -->
    <center>Copyright @ <?php $Date = date("Y"); echo date("Y")?> Meza Danilo </center>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
  $(document).ready(function(){
    $("#tabla_id").DataTable({
      "pageLength": 3,
      lengthMenu:[
        [1,2,25,50],
        [1,2,25,50]
      ],
  "language":{
    "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
  }      
    });

});
  </script>
  <script>
    function borrar(id){
        //index.php?txtId=
        Swal.fire({
        title: "¿Deseas borrar el registro?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Si, borrar",
        
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            window.location = "index.php?txtId="+id;
            Swal.fire("Guardado!", "", "Éxito");
        } else if (result.isDenied) {
            Swal.fire("Cambios no guardados", "", "info");
        }
        });
    }

</script>

</body>

</html>