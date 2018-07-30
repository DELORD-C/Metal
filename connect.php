<?php

include_once "php/head.php";



if (!isset($_SESSION['profil'])) {

    $error = "";
    echo "
    <header>
    <a href='index.php' class='btn btn-default return'>Inscription</a>
    <a href='index.php'><img class='logo' src='src/logo.png' alt='Metal'></a>
    </header>
    <body class='wallpaper'>
    ";

    if (isset($_GET['rm']) && $_GET['rm'] == true) {
        $error = "
        <div class='alert alert-success'>
        <div class='Connected.'>Le Compte à été correctement supprimé</div>
        </div>";
    }

    if (isset($_POST['pass'])) {
        if ($_POST['pass'] != "" && $_POST['mail'] != "") {
            $pass = md5($_POST['pass']);
            $result = $config->tryConnect($_POST['mail'], $pass, $conn);
            if ($result == true) {
                $error = "
                <div class='alert alert-success'>
                <div class='Connected.'>Connecté</div>
                </div>";
                echo "<meta http-equiv=\"refresh\"  content=\"0.5;URL=home.php\">";
            }
            else {
                $error = "
                <div class='alert alert-danger'>
                <div class='bold'>Erreur !</div> Email et/ou Mot de passe erroné.
                </div>
                ";
            }
        }
    }
    if (isset($_POST['submit']) && isset($result)) {
        if ($_POST['submit'] == 1 && $result == false) {
            $error = "
            <div class='alert alert-danger'>
            <div class='bold'>Erreur !</div> Email et/ou Mot de passe erroné.
            </div>
            ";
        }
    }
    echo $error;
    if (!isset($result) || $result == false) {
        ?>
    <form class='background' action="connect.php" method="post">
        <div class="connect">
            Email
            <input type="text" name="mail"> Mot de Passe
            <input type="password" name="pass">
        </div>
        <input type='hidden' name='submit' value='1'>
        <input class="btn btn-default center" type="submit" value="Connection">
    </form>

    </body>

    </html>

    <?php
    }
}
else
{
    echo "<meta http-equiv=\"refresh\"  content=\"0;URL=index.php\">";
}