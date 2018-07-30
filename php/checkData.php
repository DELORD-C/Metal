<?php

include_once 'config.php';

class checkData {
    public function checkUser($conn, $nick) {
        $request = $conn->prepare("SELECT nick FROM user WHERE nick = '$nick'");
        $request->execute();
        $result = $request->fetch(PDO::FETCH_BOTH);
        if($result == true) {
            echo json_encode(0);
        }
        else {
            echo json_encode(1);
        }

    }
    public function checkEmail($conn, $email) {
        $request = $conn->prepare("SELECT email FROM user WHERE email = '$email'");
        $request->execute();
        $result = $request->fetch(PDO::FETCH_BOTH);
        if($result == true) {
            echo json_encode(0);
        }
        else {
            echo json_encode(1);
        }

    }

    public function changeNick($conn, $nick) {
        $email = $_SESSION['profil']->email;
        $request = $conn->prepare("SELECT nick FROM user WHERE nick = '$nick' AND email != '$email'");
        $request->execute();
        $result = $request->fetch(PDO::FETCH_BOTH);
        if($result == true) {
            echo json_encode(0);
        }
        else {
            echo json_encode(1);
        }
    }

    public function changeEmail($conn, $email) {
        $nick = $_SESSION['profil']->nick;
        $request = $conn->prepare("SELECT email FROM user WHERE email = '$email' AND nick != '$nick'");
        $request->execute();
        $result = $request->fetch(PDO::FETCH_BOTH);
        if($result == true) {
            echo json_encode(0);
        }
        else {
            echo json_encode(1);
        }
    }
}

$check = new checkData;
if (isset($_GET['nick'])) {
    $nick = $_GET['nick'];
    $check->checkUser($conn, $nick);
}
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $check->checkEmail($conn, $email);
}
if (isset($_GET['znick'])) {
    $nick = $_GET['znick'];
    $check->changeNick($conn, $nick);
}
if (isset($_GET['zemail'])) {
    $email = $_GET['zemail'];
    $check->changeEmail($conn, $email);
}