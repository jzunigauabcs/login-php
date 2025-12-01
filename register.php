<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <main class="d-flex bg-light min-vh-100 flex-column justify-content-center align-items-center">
    <?php if ($_SESSION["error"]) { ?>
      <div class="alert alert-danger px-4 py-3 my-4">
        <span class="block"><?php echo $_SESSION['error']; ?></span>
      </div>
    <?php } ?>
    <div class="login-container p-5 bg-white">
      <h2>Registro</h2>
      <form action="procesar_registro.php" method="post">
        <div class="mb-3">
          <label for="" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="mb-3">
          <label class="form-label" for="">Contraseña</label>
          <input type="password" class="form-control" name="password" placeholder="Contraseña">
        </div>
        <div class="mb-3 d-flex flex-column row-gap-2">
          <button class="btn btn-primary">Registrar</button>
          <a href="login.php">¿Ya tienes cuenta?. Inicia sesión</a>
        </div>
      </form>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
