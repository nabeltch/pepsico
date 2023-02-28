<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details</title>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:ital@0;1&display=swap" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/detail.css">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

</head>

<body>

  <div class="container">

    <?php include_once('layouts/header.php'); ?>

    <div class="row justify-content-between">
      <div class="col-lg-4 filter px-4 py-2 ">
        <div class="form-group">
          <label for="usr">Filtrar por fecha:</label>
          <input type="date" class="form-control" id="date">

        </div>
       
      </div>
      <div class="col-lg-5">

        <div class="recipe filter text-center" id="recipeSection">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddRecipe" id="setRecipeBtn">Colocar receta</button>
        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalNewRecipe" id="btnNewRecipe" onclick="feedback.innerHTML=''">Nuevo</button>


   

        </div>



        <div class="modal fade" id="ModalAddRecipe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recetas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="row">
                  <input type="hidden" id="idRecipe">
                  <div class="col-8">
                    <label class="mr-sm-2" for="inlineFormCustomSelect">Recetas disponibles</label>
                    <select class="form-select mr-sm-2" aria-label="Default select example" id="recipesList">
                      <option selected>Selecciona una receta</option>

                    </select>
                  </div>
                  <div class="col">
                    <label for="usr">Objetivo (ppm):</label>
                    <input type="text" class="form-control" placeholder="PPM" id="ppm">
                  </div>
                </div>
                <div id="feedback1"></div>
              
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnSetRecipe">Agregar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="ModalNewRecipe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nueva receta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="usr">Nombre de receta:</label>
                  <input type="text" class="form-control" placeholder="Receta" id="recipe">
                  <div id="feedback"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnAddRecipe">Guardar</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 turn1 py-2">
        <h3>Turno 1 - 7:00 a 19:00</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Hora</th>
              <th scope="col">Porcentage</th>
              <th scope="col">Total bags</th>
              <th scope="col">Total teorico</th>
            </tr>

          </thead>
          <tbody id="turn1">


          </tbody>

        </table>
        <div class="feeback" id="feeback">

        </div>


      </div>

      <div class="col-lg-6 turn1 py-2">
        <h3>Turno 2 - 19:00 a 7:00</h3>

        <table class="table turn2">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Hora</th>
              <th scope="col">Porcentaje</th>
              <th scope="col">Total bags</th>
              <th scope="col">Total teórico</th>
            </tr>

          </thead>
          <tbody id="turn2">

          </tbody>
        </table>
        <div class="feeback" id="feeback1">

        </div>
      </div>
    </div>

  </div>
  <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/machine.js"></script>
</body>

</html>