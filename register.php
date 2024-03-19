<?php
include "./assets/services/connection.php";
include "./assets/services/format.php";
$database = connection();

$name = $_POST['name'];
$surname = $_POST['surname'];
$identity = format_identity($_POST['identity']);
$email = $_POST['email'];
$password = $_POST['password'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$role = "rol_usuario";

if(empty($name) || empty($surname) || empty($identity) || empty($email) || empty($password) || empty($question) || empty($answer)) {
  header('Location: http://localhost:80/crud/index.php?status=error');
  exit();
}

$pwd_crypt = password_hash($password, PASSWORD_BCRYPT);

$sentence = "INSERT INTO `usuarios` (nombre, apellido, cedula, correo, clave, pregunta, respuesta, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $database->prepare($sentence);
$stmt->bind_param('ssssssss', $name, $surname, $identity, $email, $pwd_crypt, $question, $answer, $role);
$result = $stmt->execute();
$stmt->close();
$database->close();

if(!$result) {
  header('Location: http://localhost:80/crud/index.php?status=error');
  exit();
}

header('Location: http://localhost:80/crud/index.php?status=success');
?>