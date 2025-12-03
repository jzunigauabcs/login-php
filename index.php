<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

require_once("obtener_productos.php");

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light  container">
  <header class="pt-5">

    <h1 class="text-center">Inventario de productos</h1>
    <hr>
  </header>
  <main class="d-flex pt-5 flex-column">
    <?php if (isset($_SESSION["error"])) { ?>
      <div class="alert alert-danger px-4 py-3 my-4">
        <span class="block"><?php echo $_SESSION['error']; ?></span>
      </div>
    <?php } ?>
    <div class="d-flex mb-3 column-gap-3">
      <section class="d-flex align-items-center flex-column bg-white p-4 flex-grow-1">
        <h2>Agregar nuevo producto</h2>
        <form action="agregar_producto.php" class="" method="POST">
          <div class="row">
            <div class="col-6 mb-3">
              <input type="text" placeholder="Nombre producto" name="nombre_producto" class="form-control">
            </div>
            <div class="col-6 mb-3">
              <input type="number" class="form-control" placeholder="Precio" name="precio_producto">
            </div>
            <div class="col-12 mb-3">
              <textarea class="form-control" id="" name="descripcion_producto"></textarea>
            </div>
            <button class="btn btn-success" type="submit">Guardar</button>
          </div>
        </form>
      </section>
      <section class="d-flex flex-column bg-white p-4 row-gap-3">
        <button class="btn btn-primary" id="btnOllama">Generar producto IA</button>
        <a href="carga_masiva.php" class="btn btn-warning" id="btnMasiva">Carga Masiva</a>
      </section>
    </div>
    <section class="bg-white p-4">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripción</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
          foreach ($productos as $producto): ?>
            <tr>
              <?php
              echo "<td>{$producto['nombre']}";
              echo "<td>{$producto['precio']}";
              echo "<td>{$producto['descripcion']}";
              ?>
            </tr>

          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="assets/js/app.js"></script>
</body>

</html>
