<?php
session_start();
require_once('database.php');
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  if (!isset($_POST['username']) || !isset($_POST['password'])) {
    $_SESSION['error'] = "Todos los campos son obligatorios!";
    header("Location: register.php");
    exit;
  }
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if (empty($username) || empty($password)) {
    $_SESSION['error'] = "Todos los campos son obligatorios.!";
    header("Location: register.php");
    exit;
  }
  try {
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users(username, password) VALUES(?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $hashed]);

    header('Location: login.php');
    exit;
  } catch (Exception $e) {
    die("Ocurrió un error: " . $e->getMessage());
  }
} else {
  header("Location: register.php");
  exit;
}
