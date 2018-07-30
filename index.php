<?php

include_once "php/head.php";

if (!isset($_SESSION['profil'])) {

    ?>

    <body class="wallpaper">

        <header>
            <p>Déjà un compte ?</p>
            <a href="connect.php">
                <button class="btn btn-default connection">Connexion</button>
            </a>
            <a href="index.php">
                <img class="logo" src="src/logo.png" alt="Metal">
            </a>
        </header>

        <form class="form" action="signin.php" method="post">
            <div class="first">
                <p>Je suis</p>
                <select name="gender" required>
                    <option value="">Choisissez</option>
                    <option value="0">Un Homme</option>
                    <option value="1">Une Femme</option>
                    <option value="2">Non Binaire</option>
                </select>
                <p>Je cherche</p>
                <select name="search" required>
                    <option value="">Choisissez</option>
                    <option value="0">Un Homme</option>
                    <option value="1">Une Femme</option>
                    <option value="2">Sans préférence</option>
                </select>
            </div>
            <div class="second">
                <p>Je suis né le</p>
                <input type="date" name="date" min="1900-01-01" max="2000-01-01" required>
                <input type="submit" value="Je m'inscrit !">
            </div>
        </form>

    </body>

    </html>

    <?php
}
else {
    echo "<meta http-equiv=\"refresh\"  content=\"0;URL=home.php\">";
}