<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>

<body class="bg-light">
    <?php require '../header.php'; ?>
    <div id="login-main" class="container mt-5">
        <form action="/app/controllers/AuthController.php" method="POST" class="col-md-6 offset-md-3">
            <h2 class="mb-4">Iniciar sesión</h2>

            <!-- Mostrar mensaje de error si existe -->
            <?php if (isset($_GET['error'])) : ?>
                <div class="alert alert-danger">Credenciales incorrectas.</div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <input type="submit" value="Iniciar sesión" class="btn btn-primary">
            </div>

            <p>
                ¿No tienes cuenta? <a href="/app/views/auth/register.php">Registrarse</a>
            </p>
        </form>
    </div>
</body>

</html>