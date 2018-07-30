<?php

class Config {

    function start () {

        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $database = "my_meetic";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return($conn);
        }

        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    function tryConnect ($mail, $pass, $conn) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bindParam(1, $mail);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) > 0) {
            $rows=$rows[0];
            if ($rows['password'] == $pass) {
                $_SESSION['profil'] = new Profil($rows['gender'], $rows['search'], $rows['birthdate'], $rows['nick'], $rows['firstname'], $rows['lastname'], $rows['town'], $rows['email'], $rows['password'], $rows['imgurl']);
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    function newUser ($gender, $search, $date, $nick, $first, $last, $town, $mail, $pass, $conn) {
        $stmt = $conn->prepare("INSERT INTO user (nick, lastname, firstname, email, gender, search, password, town, birthdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nick);
        $stmt->bindParam(2, $last);
        $stmt->bindParam(3, $first);
        $stmt->bindParam(4, $mail);
        $stmt->bindParam(5, $gender);
        $stmt->bindParam(6, $search);
        $stmt->bindParam(7, $pass);
        $stmt->bindParam(8, $town);
        $stmt->bindParam(9, $date);
        $stmt->execute();
    }

    function updateUser ($gender, $search, $date, $nick, $first, $last, $town, $mail, $pass, $conn) {
        $oldnick = $_SESSION['profil']->nick;
        $stmt = $conn->prepare("UPDATE user set nick = ?, lastname = ?, firstname = ?, email = ?, gender = ?, search = ?, password = ?, town = ?, birthdate = ? WHERE nick = ?");
        $stmt->bindParam(1, $nick);
        $stmt->bindParam(2, $last);
        $stmt->bindParam(3, $first);
        $stmt->bindParam(4, $mail);
        $stmt->bindParam(5, $gender);
        $stmt->bindParam(6, $search);
        $stmt->bindParam(7, $pass);
        $stmt->bindParam(8, $town);
        $stmt->bindParam(9, $date);
        $stmt->bindParam(10, $oldnick);
        $stmt->execute();
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bindParam(1, $mail);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rows=$rows[0];
        $_SESSION['profil'] = new Profil($rows['gender'], $rows['search'], $rows['birthdate'], $rows['nick'], $rows['firstname'], $rows['lastname'], $rows['town'], $rows['email'], $rows['password'], $rows['imgurl']);
    }

    function updateImg ($nick, $img, $conn) {
        $stmt = $conn->prepare("UPDATE user SET imgurl = '$img' WHERE nick = ?");
        $stmt->bindParam(1, $nick);
        $stmt->execute();
        $_SESSION['profil']->img = $img;
    }

    function deleteProfil ($pass, $nick ,$conn) {
        $stmt = $conn->prepare("UPDATE user set nick = '', email = '', password = '' WHERE nick = ?");
        $stmt->bindParam(1, $nick);
        $stmt->execute();
    }

    function carouselUsers ($nick, $town, $search, $age, $conn) {

        if ($search == 2) {
            $lf = "";
        }
        else {
            $lf = " AND gender = '$search'";
        }

        $gender = $_SESSION['profil']->gender;
        $stmt = $conn->prepare("SELECT * FROM user WHERE nick != ? AND town IN ($town) AND (search = ? OR search = 2)$age$lf");
        $stmt->bindParam(1, $nick);
        $stmt->bindParam(2, $gender);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $a => $row) {
                $this->htmlInput($row);
            }
        }
        else {
            echo "<li><div class='box'><b>Désolé !<br/></b>Il n'y a aucun utilisateur dans votre ville.<br/>Utilisez les filtres pour modifier la ville de recherche.</div></li>";
        }
    }

    function htmlInput($row) {
        $age = $this->toAge($row['birthdate']);
        echo "
        <li><div class='box'>
        <h1 class='profil-title'><b>" . $row['firstname'] . " " . $row['lastname'] . "</b></h1>
        <a href='profil.php?active=c&nick=" . $row['nick'] . "' data-theme='dark'>
        <img class='profil-img' src='src/upload/" . $row['imgurl'] . "'>
        </a>
        <p class='profil-allias'>
        (Allias : <b>" . $row['nick'] . "</b>)
        </p>
        <div class='description'>
        <p><b>Ville</b> : " . $row['town'] . "
        <p><b>Age</b> : " . $age . "
        </div>
        </div></li>
        ";
    }

    function toAge($birthdayDate) {
        $dob = strtotime(str_replace("/","-",$birthdayDate));
        $tdate = time();
        $age = 0;
        while( $tdate > $dob = strtotime('+1 year', $dob))
        {
            ++$age;
        }
        return $age;
    }

    function toDate($age) {
        $year = "20" . date('y');
        $year -= $age;
        return $year;
    }

    function getProfil($nick, $conn) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE nick = ?");
        $stmt->bindParam(1, $nick);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            $this->htmlInputProfil($rows[0]);
        }
        else {
            echo "
            <div class='alert alert-danger'>
            <div class='bold'>Erreur !</div> Cet Utilisateur n'existe pas !
            </div>
            ";
        }
    }

    function htmlInputProfil ($row) {
        $age = $this->toAge($row['birthdate']);
        switch ($row['gender']) {
            case '0':
            $genre = "Homme";
            break;

            case '1':
            $genre = "Femme";
            break;

            case '2':
            $genre = "Non Binaire";
            break;
        }

        switch ($row['search']) {
            case '0':
            $search = "Homme";
            break;

            case '1':
            $search = "Femme";
            break;

            case '2':
            $search = "Sans préférence";
            break;
        }

        $nick = $row['nick'];
        echo "
        <div class='box vingt justify'>
        <h1 class='profil-title'><b>" . $row['firstname'] . " " . $row['lastname'] . "</b></h1>
        <a href='profil.php?nick=" . $row['nick'] . "' data-theme='dark'>
        <img class='profil-img' src='src/upload/" . $row['imgurl'] . "'>
        </a>
        <p class='profil-allias'>
        (Allias : <b>" . $row['nick'] . "</b>)
        </p>
        <div class='description'>
        <p><b>Email</b> : " . $row['email'] . "
        <p><b>Ville</b> : " . $row['town'] . "
        <p><b>Age</b> : " . $age . "
        <p><b>Sexe</b> : " . $genre . "
        <p><b>Recherche</b> : " . $search . "
        <br/><br/><br/>
        <p>Envoyer un message :</p>
        <form action='profil.php?nick=" . $nick . "' method='post'>
        <textarea class='textarea' maxlength='255' name='message'></textarea><br/><br/>
        <input class='btn btn-default' type='submit' value='Envoyer'>
        </form>
        </div>
        </div>
        ";
    }
}

class Chat {
    function sendMessage ($sender, $receiver, $message, $conn) {
        $stmt = $conn->prepare("INSERT INTO chat (sender, receiver, message) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $sender);
        $stmt->bindParam(2, $receiver);
        $stmt->bindParam(3, $message);
        $stmt->execute();
    }

    function getMessage ($nick, $conn) {
        $stmt = $conn->prepare("SELECT * FROM chat WHERE receiver = ? OR sender = ? ORDER BY date DESC LIMIT 5");
        $stmt->bindParam(1, $nick);
        $stmt->bindParam(2, $nick);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->writeMessage($rows);
    }

    function writeMessage ($rows) {
        foreach ($rows as $key => $row) {
            $date = $this->formatDate($row['date']);
            if ($row['sender'] == $_SESSION['profil']->nick) {
                $sender = "Vous</b> à <b>";
                $complete = $row['receiver'];
                $target = $row['receiver'];
            }
            else {
                $sender = "";
                $complete = $row['sender'];
                $target = $row['sender'];
            }
            echo "
            <div class='message'>
            <p>De : <b>" . $sender . $complete . "</b></p>
            <p><u>" . $date . " :</u> " . $row['message'] . "</p>
            <a class='btn btn-default mini' href='profil.php?nick=" . $complete . "'>Répondre</a>
            <a class='btn btn-default mini' href='home.php?delete=" . $row['ID'] . "'>Supprimer</a>
            </div>";
        }
    }

    function formatDate($date) {
        $arr = explode('-', explode(' ', $date)[0]);
        $heure = explode(':', explode(' ', $date)[1]);
        $newdate = "Le $arr[2]/$arr[1]/$arr[0] à $heure[0]h$heure[1]min";
        return $newdate;
    }

    function deleteMessage ($id, $conn) {
        $stmt = $conn->prepare("DELETE FROM chat WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}

class Profil {

    public $gender;
    public $search;
    public $date;
    public $nick;
    public $firstname;
    public $lastname;
    public $town;
    public $email;
    public $pass;
    public $img;

    function __construct($gender, $search, $date, $nick, $firstname, $lastname, $town, $email, $pass, $img)
    {
        $this->gender = $gender;
        $this->search = $search;
        $this->date = $date;
        $this->nick = $nick;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->town = $town;
        $this->email = $email;
        $this->pass = $pass;
        $this->img = $img;
    }

}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

$config = new Config;
$chat = new Chat;

$conn=$config->start();



?>