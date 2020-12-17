<?php
include_once('classes/User.php');
include_once('classes/RegistrationForm.php');
include_once ('classes/Baza.php');
$rf = new RegistrationForm();
$db = new Baza("localhost", "root", "test", "klienci");
if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $user = $rf->checkUser();
    if ($user === NULL)
        echo "<p>Niepoprawne dane rejestracji.</p>";
    else{
        echo "<p>Poprawne dane rejestracji:</p>";
        $user->show();
        $user->saveToDB($db);
        header("location:index.php");
    }
}
User::getAllUsersFromDB($db);
