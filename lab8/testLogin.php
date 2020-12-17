<?php
include_once "classes/UserManager.php";
include_once "classes/Baza.php";
$UserManager = new UserManager();
$db = new Baza("localhost", "root", "test", "klienci");
session_start();

$userId = $UserManager->getLoggedInUser($db, session_id());
if($userId >= 0 ){
    echo "<p>Poprawne logowanie.<br />";
    echo "Zalogowany użytkownik o id=$userId <br />";
    $select = "SELECT id, userName, fullName, email FROM users WHERE id = '$userId'";
    echo $db->select($select,
        array("id", "userName", "fullName", "email"));
    echo "<a href='index.php?action=logout' >Wyloguj</a> </p>";
}
else header("location:index.php");