<?php
include_once "classes/UserManager.php";
include_once "classes/Baza.php";
$UserManager = new UserManager();
$db = new Baza("localhost", "root", "test", "klienci");
if (filter_input(INPUT_GET, "action")=="logout") {
    echo $UserManager->logout($db);
}
session_start();
if($UserManager->getLoggedInUser($db, session_id()) >= 0) {
    header("location:testLogin.php");
}
if (filter_input(INPUT_POST, 'register', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    header("location:register.php");

}
if (filter_input(INPUT_POST, 'zaloguj', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $userId =  $UserManager->login($db);
    if($userId > 0){

        header("location:testLogin.php");
    }
    else{
        echo "<p>Błędna nazwa użytkownika lub hasło</p>";
        $UserManager->loginForm();
    }
}
else {
    $UserManager->loginForm();
}
