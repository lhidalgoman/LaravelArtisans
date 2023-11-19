<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <?php require '../header.php'; ?>
    <div class="container mt-5">
        <form action="/app/controllers/RegisterController.php" method="POST" class="col-md-6 offset-md-3">
            <h1>Registro</h1>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellido1" class="form-label">Primer Apellido</label>
                <input type="text" name="apellido1" id="apellido1" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo Apellido</label>
                <input type="text" name="apellido2" id="apellido2" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" name="usuario" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <input type="submit" value="Registrarse" class="btn btn-primary">
            </div>
            <p>
                ¿Tienes una cuenta? <a href="/app/views/auth/login.php">Iniciar sesión</a>
            </p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>