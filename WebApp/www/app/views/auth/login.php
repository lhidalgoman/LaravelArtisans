<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</head>

<body>
    <div class="login">
        <h1>Login SIN ESTILO</h1>

        <form action="/utils/Auth.php" method="post">

            <label for="username"><i class="fas fa-user"></i></label>
            <input type="email" name="username" placeholder="Usuario" id="username" required>

            <label for="password"><i class="fas fa-lock"></i></label>
            <input type="password" name="password" placeholder="Contraseña" id="password" required>

            <input type="submit" value="Acceder">
        </form>
    </div>
</body>

</html>