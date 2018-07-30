<?php

include_once "php/head.php";

$erreur="";

if (isset($_SESSION['profil'])) {

    if (count($_FILES) == 1) {
        $path = "src/upload/" . $_FILES['file']['name'];
        $name = $_FILES['file']['name'];
        $nick = $_SESSION['profil']->nick;
        if (is_file($path)) {
            $config->updateImg($nick, $name, $conn);
            $erreur = "
            <div class='alert alert-success'>
            <div class='bold'>Bravo !</div> Image de profil Correctement mise à jour !
            </div>
            ";
            echo "<meta http-equiv=\"refresh\"  content=\"0;URL=home.php\">";
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], $path);
            $config->updateImg($nick, $name, $conn);
            $erreur = "
            <div class='alert alert-success'>
            <div class='bold'>Bravo !</div> Image de profil Correctement mise à jour !
            </div>
            ";
            echo "<meta http-equiv=\"refresh\"  content=\"0;URL=home.php\">";
        }
        $head = "";
    }
    else {
        $head = "<h1 class='upload-title'>Selectionnez votre nouvelle image de profil</h1>";
    }

    ?>

    <body class="wallpaper">
        <a href="home.php">
            <button class='btn btn-default return-upload'>Retour</button>
        </a>

        <?php echo $erreur;echo $head;?>
        <form class='form-upload' action="upload.php" method="post" enctype="multipart/form-data" accept="image/*">
            <input required type="file" name="file">
            <input type="hidden" name="MAX_FILE_SIZE" value="4096">
            <input type="submit" value="Envoyer l'image">
        </form>
    </body>

    </html>

    <?php
}
else
{
    echo "<meta http-equiv=\"refresh\"  content=\"0;URL=index.php\">";
}