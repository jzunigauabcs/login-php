<?php
if (session_status() === PHP_SESSION_NONE)
  session_start();
require_once("database.php");


if (empty($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}
try {
  $sql = "SELECT * from productos";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Ocurrió un error " . $e->getMessage());
}
