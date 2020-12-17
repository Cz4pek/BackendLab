<?php
include_once('classes/User.php');

session_start();
//$_SESSION['userName'] = 'kubus';
//$_SESSION['fullName'] = 'Kubus Puchatek';
//$_SESSION['email'] = 'kubus@stumilowylas.pl';
//$_SESSION['status'] = 'ADMIN';
echo "Id sesji: ".session_id()."</br>";
//echo "Zmienne sesji:"."</br>";
//foreach ($_SESSION as $key => $val){
//    echo $key.": ".$val."</br>";
//}
//pierwsza wersja
$user = new User('kubus', '123', 'Kubus Puchatek', 'kubus@stumilowylas.pl');
$user->setStatus($user::STATUS_ADMIN);
$user->show();
$_SESSION['user'] = serialize($user);
if ( isset($_COOKIE[session_name()]) ) {
    echo session_name() . " - " . $_COOKIE[session_name()] . "</br>";
}
echo '<a href="http://localhost/lab7/test2.php">test2</a>';
