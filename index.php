<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP - Anmelden - Konto Anlegen</title>

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
                <h4>Willkommen zu Ihrem Profil Überblick</h4>
            </div>


            <div class="text-center">
                <img src="assets/images/party(harryarts-freepik).jpg" class="m-5" width="250" />
            </div>

            <a href="logout.php" class="btn btn-outline-warning btn-sm">Ausloggen</a>
        </div>



        <!-- Scripts -->
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

    </body>

</html>