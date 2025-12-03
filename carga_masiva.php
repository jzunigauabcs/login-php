<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}
require_once("database.php");
require_once "proxy.php";

set_time_limit(300);
unset($_SESSION["error"]);
if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $prompt = "Genera un arreglo con 3 productos, donde cada uno tenga las propiedades nombre, precio y descripción. Estos productos son de caracter tecnológico. Escoge de una tablet, laptop o smartphone y puede ser de la marca apple, samsung, xiaomi entre otros. Genera valores aleatorios para no repetir";
  try {
    $response = call_ollama($prompt);
    $data = json_decode($response, true);
    $value = [];
    $params = [];
    foreach ($data['productos'] as $row) {
      $value[] = "(?, ?, ?)";
      $params[] = $row["nombre"];
      $params[] = $row["precio"];
      $params[] = $row["descripcion"];
    }
    $sql = "INSERT INTO productos(nombre, precio, descripcion) VALUES " . implode(", ", $value);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    header("Location: index.php");
  } catch (Exception $e) {
    $_SESSION["error"] = "Ocurrió un error al realizar la carga masiva: " . $e->getMessage();
    header("Location: index.php");
  }
}
