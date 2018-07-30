<?php

include_once "php/head.php";

$alert="";

if (isset($_SESSION['profil'])) {

    if (isset($_POST['message']) && $_POST['message'] != "") {
        $chat->sendMessage($_SESSION['profil']->nick, $_GET['nick'], $_POST['message'], $conn);
        $alert = "
        <div class='alert alert-success'>
        <div class='Connected.'><b>Bravo !</b> Message envoyé !</div>
        </div><br/>
        ";
    }

    ?>

    <body class="wallpaper">
        <a href='home.php?active=<?php if (isset($_GET['active'])){echo $_GET['active'];}else{echo 'a';}?>'' class='btn btn-default return'>Retour</a>
        <?php
    echo $alert;
    $config->getProfil($_GET['nick'], $conn);
    ?>
    </body>

    </html>

    <?php
}
else
{
    echo "<meta http-equiv=\"refresh\"  content=\"0;URL=index.php\">";
}