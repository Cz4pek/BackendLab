<?php
include_once('classes/User.php');
include_once('classes/RegistrationForm.php');
$rf = new RegistrationForm();
if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $user = $rf->checkUser();
    if ($user === NULL)
        echo "<p>Niepoprawne dane rejestracji.</p>";
    else{
        echo "<p>Poprawne dane rejestracji:</p>";
        $user->show();
        $user->saveToJson("users.json");
    }
}
User::getAllUsers("users.json");
