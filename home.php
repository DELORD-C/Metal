<?php

include_once "php/head.php";

if (isset($_POST['delete']) && $_POST['delete'] == $_SESSION['profil']->pass) {
    $pass = $_POST['delete'];
    $nick = $_SESSION['profil']->nick;
    $config->deleteProfil($pass, $nick, $conn);
    echo "<meta http-equiv=\"refresh\"  content=\"0;URL=connect.php?rm=true\">";
}

if (isset($_GET['dc'])) {
    if ($_GET['dc'] == true) {
        session_destroy();
        echo "<meta http-equiv=\"refresh\"  content=\"0;URL=connect.php\">";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $chat->deleteMessage($id, $conn);
    echo "<meta http-equiv=\"refresh\"  content=\"0;URL=home.php\">";
}

if (isset($_SESSION['profil'])) {
    include_once('php/unroll.php');
    ?>

    <body class="wallpaper">
        <div class='tab-bg'></div>
        <ul class="tab-list">
            <li class="tab-element <?php if(!isset($_GET['active']) || $_GET['active'] == 'a') {echo ' active';}?>" data-target="tab-messagerie">
                <a href="#">Messagerie</a>
            </li>
            <li class="tab-element <?php if(isset($_GET['active']) && $_GET['active'] == 'b') {echo ' active';}?>" data-target="tab-profil">
                <a href="#">Profil</a>
            </li>
            <li class="tab-element <?php if(isset($_GET['active']) && $_GET['active'] == 'c') {echo ' active';}?>" data-target="tab-recherche">
                <a href="#">Recherche</a>
            </li>
            <li class="tab-element <?php if(isset($_GET['active']) && $_GET['active'] == 'd') {echo ' active';}?>" data-target="tab-param">
                <a href="#">Paramètres</a>
            </li>
        </ul>

        <div class='tab-messagerie tab-content'>
            <div class="messagerie">
                <div class='box vingt'>
                    <h1 class='profil-title'>Bienvenue
                        <b>
                            <?php echo $_SESSION['profil']->lastname . ' ' . $_SESSION['profil']->firstname;?>
                        </b> !</h1>
                    <a href="upload.php" class='tooltip' data-theme="dark" title="Modifier l'image de profil">
                        <img class='profil-img' src="src/upload/<?php echo $_SESSION['profil']->img;?>">
                    </a>
                    <p class='profil-allias'>(Allias :
                        <b>
                            <?php echo $_SESSION['profil']->nick;?>
                        </b>)</p>
                </div>
                <div class="message soixante-dix">
                    <p>
                        <u>
                            <b>Derniers Messages :</b>
                        </u>
                    </p>
                    <?php $chat->getMessage($_SESSION['profil']->nick, $conn);?>
                </div>
            </div>
        </div>

        <div class='tab-profil tab-content'>

            <?php

            if (count($_POST) > 1 && isset($_POST['gender'])) {
                if ($_POST['password'] != "" && $_POST['password'] == $_POST['passwordconfirm']) {
                    $pass = md5($_POST['password']);
                }
                else {
                    $pass = $_SESSION['profil']->pass;
                }
                $config->updateUser($_POST['gender'], $_POST['search'], $_POST['date'], $_POST['nick'], $_POST['firstname'], $_POST['lastname'], $_POST['town'], $_POST['email'], $pass ,$conn);
            }


            ?>

                <div class='box quarante'>
                    <form action='home.php?active=b' method="post">
                        <div class="double-grid">
                            <input required type="hidden" name="active" value="b">
                            <p>Nom d'Utilisateur</p>
                            <input required id='znick' type="text" name="nick" value="<?php echo $_SESSION['profil']->nick;?>">
                            <p>NOM</p>
                            <input required id='firstname' type="text" name="firstname" value="<?php echo $_SESSION['profil']->firstname;?>">
                            <p>Prénom</p>
                            <input required id='lastname' type="text" name="lastname" value="<?php echo $_SESSION['profil']->lastname;?>">
                            <p>Ville de Résidence</p>
                            <input required id='town' type="text" name="town" value="<?php echo $_SESSION['profil']->town;?>">
                            <p>Date de naissance</p>
                            <input required type="date" name="date" min="1900-01-01" max="2000-01-01" value="<?php echo $_SESSION['profil']->date;?>">
                            <p>Sexe</p>
                            <select required name="gender">
                                <option value="0" <?php if ($_SESSION[ 'profil']->gender == 0) {echo"selected='selected'";};?>>Un Homme</option>
                                <option value="1" <?php if ($_SESSION[ 'profil']->gender == 1) {echo"selected='selected'";};?>>Une Femme</option>
                                <option value="2" <?php if ($_SESSION[ 'profil']->gender == 2) {echo"selected='selected'";};?>>Non Binaire</option>
                            </select>
                            <p>Sexe recherché</p>
                            <select required name="search">
                                <option value="0" <?php if ($_SESSION[ 'profil']->search == 0) {echo"selected='selected'";};?>>Un Homme</option>
                                <option value="1" <?php if ($_SESSION[ 'profil']->search == 1) {echo"selected='selected'";};?>>Une Femme</option>
                                <option value="2" <?php if ($_SESSION[ 'profil']->search == 2) {echo"selected='selected'";};?>>Sans Préférence</option>
                            </select>
                            <p>E-mail</p>
                            <input required id='zemail' type="text" name="email" readonly value="<?php echo $_SESSION['profil']->email;?>">
                            <p>Mot de Passe</p>
                            <input id='zpassword' type="password" name="password" readonly placeholder="**********">
                            <p>Confirmation Mot de Passe</p>
                            <input id='zpasswordconfirm' type="password" name="passwordconfirm" readonly placeholder="Confirmation">
                        </div>
                        <br/>
                        <input id='submit' class='btn btn-default' type="submit" value="Enregistrer !">
                    </form>
                </div>
        </div>

        <div class='tab-recherche tab-content'>
            <div class="carouselbox">
                <div class="buttons">
                    <button class="prev">
                        ◀
                        <span class="offscreen">Previous</span>
                    </button>
                    <button class="next">
                        <span class="offscreen">Next</span> ▶
                    </button>
                </div>
                <ol class="content">
                    <?php

            if (isset($_GET['min'])) {
                $min = $_GET['min'];
                $max = $_GET['max'];
                $mtown = $_GET['mtown'];
                $msearch = $_GET['msearch'];

                if ($min == $max) {
                    $minyear = $config->toDate($min) . "-01-01";
                    $maxyear = $config->toDate($max)+1 . "-01-01";
                    $_SESSION['mage'] = " AND birthdate > '$maxyear' AND birthdate < '$minyear'";
                }
                elseif ($min != "" && $max != "") {
                    $minyear = $config->toDate($min) . "-01-01";
                    $maxyear = $config->toDate($max) . "-01-01";
                    $_SESSION['mage'] = " AND birthdate > '$maxyear' AND birthdate < '$minyear'";
                }
                else {
                    $_SESSION['mage'] = "";
                }

                if (count(explode(' ', $mtown)) > 1) {
                    $arr = explode(' ', $mtown);
                    $mtown = "";
                    foreach ($arr as $key => $value) {
                        $mtown .= "'$value', ";
                    }
                    $mtown = rtrim($mtown, ', ');
                }
                else {
                    $mtown = "'$mtown'";
                }

                $_SESSION['msearch'] = $msearch;
                $_SESSION['mtown'] = $mtown;
                $config->carouselUsers($_SESSION['profil']->nick, $_SESSION['mtown'], $_SESSION['msearch'], $_SESSION['mage'], $conn);

            }
            else {
                $town = "'" . $_SESSION['profil']->town . "'";
                $config->carouselUsers($_SESSION['profil']->nick, $town, $_SESSION['profil']->search, "", $conn);
            }

            ?>
                </ol>
            </div>
            <div class="box vingt justify">
                <button class="btn btn-default filters-button">Filtres</button>
                <div class="filters">
                    <form class="doublegrid sform" action="home.php" method="get">
                        <input type="hidden" name='active' value='c'>
                        <p>Age minimum</p>
                        <div class='rangebox'>
                            <p class='frange-text'>
                                <?php if(isset($_GET['mtown'])) {echo $_GET['min'];}else{echo "18";}?>
                                <p>
                                    <input name='min' class='frange' type='range' min='18' max='100' value="<?php if(isset($_GET['mtown'])) {echo $_GET['min'];}else{echo "18";}?>">
                        </div>
                        <p>Age maximum</p>
                        <div class='rangebox'>
                            <p class='srange-text'>
                                <?php if(isset($_GET['mtown'])) {echo $_GET['max'];}else{echo "100";}?>
                                <p>
                                    <input name='max' class='srange' type='range' min='18' max='100' value="<?php if(isset($_GET['mtown'])) {echo $_GET['max'];}else{echo "100";}?>">
                        </div>
                        <p>Ville</p>
                        <input type='text' name='mtown' placeholder="ex : Lyon Paris Marseille" <?php if(isset($_GET[ 'mtown'])) {echo "value='"
                            . $_GET[ 'mtown'] . "'";}else{echo "value='" . $_SESSION[ 'profil']->town . "'";}?>>
                        <p>Sexe</p>
                        <select required name="msearch">
                            <option value="0" <?php if ($_SESSION[ 'profil']->search == 0) {echo"selected='selected'";};?>>Un Homme</option>
                            <option value="1" <?php if ($_SESSION[ 'profil']->search == 1) {echo"selected='selected'";};?>>Une Femme</option>
                            <option value="2" <?php if ($_SESSION[ 'profil']->search == 2) {echo"selected='selected'";};?>>Sans préférence</option>
                        </select>
                        <input class="btn btn-default" type="submit">
                    </form>
                </div>
            </div>
        </div>

        <div class='tab-param tab-content'>
            <a href="home.php?dc=true">
                <button class='disconnect btn btn-default'>Déconnection</button>
            </a>
            </br>
            <button class="disconnect modalShow btn btn-default" data-target="myModal">Supprimer le Compte</button>
            <div id="myModal" class="modal">
                <h1>Popin</h1>
                <div class="inner-wrapper">
                    <p>Voulez-vous vraiment supprimer votre compte ?</p>
                    <p>Cette action est définitive !</p>
                </div>
                <div class="buttons">
                    <form action="home.php" method="post">
                        <input type="hidden" name="delete" value="<?php echo $_SESSION['profil']->pass;?>">
                        <input class='delete btn btn-default' type="submit" value="Oui">
                        <button type="button" class="popin-dismiss btn btn-default">Non</button>
                    </form>
                </div>
            </div>
        </div>

    </body>

    </html>

    <?php
            }
            else
            {
                echo "<meta http-equiv=\"refresh\"  content=\"0;URL=index.php\">";
            }