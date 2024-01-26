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
    <title>PHP - Konto Anlegen</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- CustomCss -->
    <link href="assets/css/styles.css" rel="stylesheet" />

</head>

<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h4> Konto Anlegen</h4>
        </div>

        <?php
        // print_r($_POST);

        if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $con_password = $_POST['con_password'];

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($fullname) or empty($email) or empty($password) or empty($con_password)) {
                array_push($errors, 'Alle Felder sind Pflichtfelder!');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, 'eMail ist nicht gültig!');
            }

            if (strlen($password) < 13) {
                array_push($errors, 'Das Passwort muß mindestens 13 Zeichen lang sein!');
            }

            if ($password !== $con_password) {
                array_push($errors, 'Das Passwort und Passwort WH stimmen nicht überein!');
            }

            require_once 'db.php';
            $sql = "SELECT * FROM `users` WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $row_count = mysqli_num_rows($result);

            if ($row_count > 0) {
                array_push($errors, 'Die eMail existiert bereits!');
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {


                $sql = "INSERT INTO `users` (fullname, email, password) VALUES(?, ?, ?)";

                $stmt = mysqli_stmt_init($conn);

                $prepare_stmt = mysqli_stmt_prepare($stmt, $sql);

                if ($prepare_stmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $password_hash);

                    mysqli_stmt_execute($stmt);
                    echo
                    "<div class='alert alert-success'>Das Konto wurde erfolgreich angelegt</div>";
                } else {
                    die('Irgendwas lief schief...!');
                }
            }
        }
        ?>
        <form action="registration.php" method="POST">

            <div class="form-group mb-3">
                <label for="fullname" class="form-label">Name</label>
                <input type="text" class="form-control" name="fullname" />
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">eMail</label>
                <input type="email" class="form-control" name="email" />
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Passwort</label>
                <input type="password" class="form-control" name="password" />
            </div>

            <div class="form-group mb-4">
                <label for="con_password" class="form-label">Passwort WH</label>
                <input type="password" class="form-control" name="con_password" />
            </div>

            <div class="form-btn">
                <button type="submit" class="btn btn-outline-primary btn-sm" name="submit">Registrieren</button>
            </div>

        </form>

        <div class="py-3">
            <small>
                Bereits ein Konto?
                <a href="login.php" class="text-dark text-decoration-none fw-bolder">
                    Anmelden
                </a>
            </small>
        </div>

    </div>

    <!-- Scripts -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>