<?php

session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP - Anmelden</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous" />
        <!-- CustomCss -->
        <link href="assets/css/styles.css" rel="stylesheet" />

    </head>

    <body>
        <div class="container mt-5">
            <div class="text-center mb-4">
                <h4>Anmelden</h4>
            </div>

            <?php

        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            require_once 'db.php';
            $sql = "SELECT * FROM `users` WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user'] = 'yes';
                    header('Location: index.php');
                    die();
                } else {
                    echo
                    "<div class='alert alert-danger'>Das Passwort passt nicht!</div>";
                }
            } else {
                echo
                "<div class='alert alert-danger'>Die eMail passt nicht!</div>";
            }
        }

        ?>

            <form action="login.php" method="POST">

                <div class="form-group mb-3">
                    <label for="email" class="form-label">eMail</label>
                    <input type="email" class="form-control" name="email" />
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Passwort</label>
                    <input type="password" class="form-control" name="password" />
                </div>

                <div class="form-btn">
                    <button type="submit" class="btn btn-outline-primary btn-sm" name="login">Anmelden</button>
                </div>

            </form>

            <div class="py-3">
                <small>
                    Noch kein Konto?
                    <a href="registration.php" class="text-dark text-decoration-none fw-bolder">
                        Registrieren
                    </a>
                </small>
            </div>

        </div>



        <!-- Scripts -->
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

    </body>

</html>