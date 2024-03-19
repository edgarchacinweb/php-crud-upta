<?php
include "./assets/services/connection.php";
  $database = connection();

  if(empty($_GET['id'])) {
    header('Location: http://localhost:80/crud/index.php?status=error');
    exit();
  }

  $id = $_GET['id'];
  $sentence = "DELETE FROM `usuarios` WHERE id=?";
  $stmt = $database->prepare($sentence);
  $stmt->bind_param('s', $id);
  $result = $stmt->execute();

  $stmt->close();
  $database->close();

  if(!$result) {
    header('Location: http://localhost:80/crud/index.php?status=error');
    exit();
  }
  
  header('Location: http://localhost:80/crud/index.php?status=success');
?>