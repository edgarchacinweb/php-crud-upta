<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <main class="main">
        <section class="form__container">
            <h2 class="form__title">Registro de usuarios</h2>
            <form class="form" action="./register.php" method="POST">
                <section class="form__item">
                    <input type="text" name="name" id="name" class="form__input" placeholder="nombre" required />
                    <label for="name" class="form__label">Nombre</label>
                </section>
                <section class="form__item">
                    <input type="text" name="surname" id="surname" class="form__input" placeholder="apellido" required />
                    <label for="surname" class="form__label">Apellido</label>
                </section>
                <section class="form__item">
                    <input type="number" name="identity" id="identity" class="form__input" placeholder="Cédula" required />
                    <label for="identity" class="form__label">Cédula de identidad</label>
                </section>
                <section class="form__item">
                    <input type="email" name="email" id="email" class="form__input" placeholder="Correo" autocomplete="false" required />
                    <label for="email" class="form__label">Correo electrónico</label>
                </section>
                <section class="form__item">
                    <input type="password" name="password" id="password" class="form__input" placeholder="password" autocomplete="new-password" required />
                    <label for="password" class="form__label">Contraseña</label>
                </section>
                <section class="form__item">
                    <input type="text" name="question" id="question" class="form__input" placeholder="pregunta" required />
                    <label for="question" class="form__label">Pregunta de seguridad</label>
                </section>
                <section class="form__item">
                    <input type="text" name="answer" id="answer" class="form__input" placeholder="respuesta" required />
                    <label for="answer" class="form__label">Respuesta</label>
                </section>
                <button type="submit" class="form__btn">Registrar</button>
            </form>
            <?php
                if(!empty($_GET['status'])) {
                    $status = $_GET['status'];
                    if(!strcmp($status, "success")) {
                        echo "<p class=\"form__message form__message--success\">Operación realizada correctamente</p>";
                    } else {
                        echo "<p class=\"form__message form__message--error\">Ocurrió un error inesperado</p>";
                    }
                }
            ?>
        </section>
        <section class="table__container">
            <h2 class="table__title">Usuarios registrados</h2>
            <table class="table">
                <tr class="table__row">
                    <th class="table__header">ID</th>
                    <th class="table__header">Nombre</th>
                    <th class="table__header">Apellido</th>
                    <th class="table__header">Identificación</th>
                    <th class="table__header">Correo electrónico</th>
                    <th class="table__header">Opciones</th>
                </tr>
                <?php
                    include "./assets/services/connection.php";
                    $database = connection();
                    $sentence = "SELECT * FROM `usuarios`";
                    $result = $database->query($sentence);

                    if($result->num_rows > 0) {
                        while($data = $result->fetch_object()) { ?>
                            <tr class="table__row">
                                <td class="table__item"><?= $data->id ?></td>
                                <td class="table__item"><?= $data->nombre ?></td>
                                <td class="table__item"><?= $data->apellido ?></td>
                                <td class="table__item"><?= $data->cedula ?></td>
                                <td class="table__item"><?= $data->correo ?></td>
                                <td class="table__item table__buttons">
                                    <a href="./edit.php?id=<?= $data->id ?>" class="table__btn table__btn--edit">
                                        <img src="./assets/img/pencil.svg" class="table__icon" />
                                    </button>
                                    <a href="./remove.php?id=<?= $data->id ?>" class="table__btn table__btn--remove">
                                        <img src="./assets/img/trash.svg" class="table__icon" />
                                    </a>
                                </td>
                            </tr>
                    <?php }} $database->close(); ?>
            </table>
        </section>
    </main>

    <hr>
    <footer class="footer">
        <p class="footer__student">
            Sitio web desarrollado por el estudiante Edgar Chacín V-31.116.796
            <strong>Primer trayecto de TSU en informática, sección 1</strong>
        </p>
        <p class="footer__teacher">
            <strong>Profesor:</strong> Adrián González
            <strong class="footer__subject">Algorítmica 1, fase 3</strong>
        </p>
    </footer>
</body>
</html>