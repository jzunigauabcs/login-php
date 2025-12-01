<?php
session_start();
require_once("database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!isset($_POST['username']) || !isset($_POST['password'])) {
    $_SESSION['error'] = "Todos los campos son obligatorios!";
    header("Location: login.php");
    exit;
  }
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if (empty($username) || empty($password)) {
    $_SESSION['error'] = "Todos los campos son obligatorios.!";
    header("Location: login.php");
    exit;
  }
  try {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION["user_id"] = $user['id'];
      $_SESSION["username"] = $user["username"];
      header("Location: index.php");
      exit;
    } else {

      $_SESSION['error'] = "Todos los campos son obligatorios.!";
      header("Location: login.php");
      exit;
    }
    die($user["password"]);
    exit;
  } catch (Exception $e) {

    die("Ocurrió un error " . $e->getMessage());
    exit;
  }
} else {
  header("Location: login.php");
  exit;
}