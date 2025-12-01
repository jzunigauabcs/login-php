<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

require_once("database.php");
unset($_SESSION["error"]);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  //Validar que se envíen las variables
  //
  $nombre = $_POST['nombre_producto'];
  $precio = floatval($_POST['precio_producto']);
  $descripcion = $_POST['descripcion_producto'];

  try {
    $sql = "INSERT INTO productos(nombre, precio, descripcion) VALUE(?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $precio, $descripcion]);
    header("Location: index.php");
    exit;
  } catch (PDOException $e) {
    $_SESSION["error"] = "Ocurrió un error al almacenar los datos del producto: " . $e->getMessage();
    header("Location: index.php");
  }
} else {
  header("Location: index.php");
}
