<?php
  include "./assets/services/connection.php";
  include "./assets/services/format.php";
  $database = connection();
  $id = $_GET['id'];

  if(empty($id)) {
    header('Location: http://localhost:80/crud/index.php?status=error');
    exit();
  }

  if(!empty($_GET['edit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $identity = format_identity($_POST['identity']);
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Funcion disponible a partir de PHP 8
    $answer = $_POST['answer'];
    $sentence = "UPDATE `usuarios` SET nombre=?, apellido=?, cedula=?, correo=? WHERE id=? and respuesta=?";
    $stmt = $database->prepare($sentence);
    $stmt->bind_param('ssssss', $name, $surname, $identity, $email, $id, $answer);
    
    if (strlen($password) > 0) {
      $sentence = $sentence = "UPDATE `usuarios` SET nombre=?, apellido=?, cedula=?, correo=?, clave=? WHERE id=? and respuesta=?";
      $stmt = $database->prepare($sentence);
      $stmt->bind_param('sssssss', $name, $surname, $identity, $email, $password, $id, $answer);
    }
    
    $result = $stmt->execute();

    if($stmt->affected_rows <= 0) {
      header('Location: http://localhost:80/crud/index.php?status=error');
      exit();
    }
    
    header('Location: http://localhost:80/crud/index.php?status=success');
    exit();
  } 

  $sentence = "SELECT * FROM `usuarios` WHERE id=$id";
  $result = $database->query($sentence);
  $data = $result->fetch_object();

  $database->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar usuario</title>
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="./assets/css/edit.css">
</head>
<body>
  <main class="main">
    <section class="form__container">
        <h2 class="form__title">Editar usuario</h2>
        <form class="form" action="./edit.php?id=<?= $data->id ?>&edit=true" method="POST">
            <section class="form__item">
                <input type="text" value="<?= $data->nombre ?>" name="name" id="name" class="form__input" placeholder="nombre" />
                <label for="name" class="form__label">Nombre</label>
            </section>
            <section class="form__item">
                <input type="text" value="<?= $data->apellido ?>" name="surname" id="surname" class="form__input" placeholder="apellido" />
                <label for="surname" class="form__label">Apellido</label>
            </section>
            <section class="form__item">
                <input type="text" value="<?= $data->cedula ?>" name="identity" id="identity" class="form__input" placeholder="Cédula" />
                <label for="identity" class="form__label">Cédula de identidad</label>
            </section>
            <section class="form__item">
                <input type="email" value="<?= $data->correo ?>" name="email" id="email" class="form__input" placeholder="Correo" />
                <label for="email" class="form__label">Correo electrónico</label>
            </section>
            <section class="form__item">
                <input type="password" name="password" id="password" class="form__input" placeholder="password" autocomplete="off" />
                <label for="password" class="form__label">Contraseña</label>
            </section>
            <section class="form__item">
                <input type="text" value="<?= $data->pregunta ?>" name="question" id="question" class="form__input" placeholder="pregunta" disabled />
                <label for="question" class="form__label">Pregunta de seguridad</label>
            </section>
            <section class="form__item">
                <input type="text" name="answer" id="answer" class="form__input" placeholder="respuesta" autocomplete="nope" required />
                <label for="answer" class="form__label">Respuesta</label>
            </section>
            <button type="submit" class="form__btn">Editar usuario</button>
        </form>
    </section>
  </main>
</body>
</html>

<!-- <?php

  // $sentence = "UPDATE `usuarios` SET nombre=?, apellido=?, cedula=?, correo=? WHERE id=?";
  // $stmt = $database->prepare($sentence);
  // $stmt->bind_param('sssss', $name, $surname, $identity, $email, $id);
  // $result = $stmt->execute();

  // $stmt->close();
  // $database->close();

  // if(!$result) {
  //   header('Location: http://localhost:80/crud/index.php?status=error');
  //   exit();
  // }
  
  // header('Location: http://localhost:80/crud/index.php?status=success');
?> -->