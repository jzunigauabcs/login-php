<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}

require_once("database.php");
unset($_SESSION["error"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  //Validaciones
  $nombre = $_POST["nombre_producto"];
  $precio = floatval($_POST["precio_producto"]);
  $descripcion = $_POST["descripcion_producto"];

  try {
    $sql = "INSERT INTO productos(nombre, precio, descripcion) VALUE(?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $precio, $descripcion]);
    header("Location: index.php");
  } catch (PDOException $e) {
    $_SESSION["error"] = "Ocurrió un error al intentar almacenar los datos del producto: " . $e->getMessage();
  }
} else {
  header("Location: index.php");
}
