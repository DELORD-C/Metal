<?php

include_once "php/head.php";

if (!isset($_SESSION['profil'])) {

    echo "
    <header>
    <a href='index.php' class='btn btn-default return-upload'>Retour</a>
    <a href='index.php'><img class='logo' src='src/logo.png' alt='Metal'></a>
    </header>
    <body class='wallpaper'>
    ";

    if(isset($_POST['password'])) {
        $_POST['password'] = md5($_POST['password']);
        $_SESSION['profil'] = new Profil ($_POST['gender'], $_POST['search'], $_POST['date'], $_POST['nick'], $_POST['firstname'], $_POST['lastname'], $_POST['town'], $_POST['email'], $_POST['password'], "pika.gif");
        $config->newUser($_POST['gender'], $_POST['search'], $_POST['date'], $_POST['nick'], $_POST['firstname'], $_POST['lastname'], $_POST['town'], $_POST['email'], $_POST['password'] ,$conn);
        echo "
        <div class='alert alert-success'>
        <div class='Connected.'>Le Compte à été correctement créé.</div>
        </div>
        <meta http-equiv=\"refresh\"  content=\"1;URL=home.php\">";
    }
    else {
        ?>

    <form id="register" class="background" action="signin.php" method="post">
        <div class="double-grid">
            <input type="hidden" name="gender" value='<?php echo $_POST["gender"];?>'>
            <input type="hidden" name="search" value='<?php echo $_POST["search"];?>'>
            <input type="hidden" name="date" value='<?php echo $_POST["date"];?>'>
            <p>Nom d'Utilisateur</p>
            <input required id='nick' type="text" name="nick" placeholder="ex : Tracteurstyx">
            <p>NOM</p>
            <input required id='firstname' type="text" name="firstname" placeholder="ex : MOULIN">
            <p>Prénom</p>
            <input required id='lastname' type="text" name="lastname" placeholder="ex : Billie">
            <p>Ville de Résidence</p>
            <input required id='town' type="text" name="town" placeholder="ex : Lyon">
            <p>E-mail</p>
            <input required id='email' type="text" name="email" placeholder="ex : xXb_moulinXx@gmail.com">
            <p>Confirmation E-mail</p>
            <input required id='emailconfirm' type="text" name="emailconfirm" placeholder="Confirmation">
            <p>Mot de Passe</p>
            <input required id='password' type="password" name="password" placeholder="**********">
            <p>Confirmation Mot de Passe</p>
            <input required id='passwordconfirm' type="password" name="passwordconfirm" placeholder="Confirmation">
        </div>
        <br/>
        <div class="center">
            <input id="submit" type="submit" value="Valider">
        </div>
    </form>
    <?php
    }

}
else {
    echo "<meta http-equiv=\"refresh\"  content=\"0;URL=home.php\">";
}
?>