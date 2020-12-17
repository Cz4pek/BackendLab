<?php
include_once('classes/User.php');

session_start();
echo "Id sesji: ".session_id()."</br>";
echo "Zmienne sesji:"."</br>";
//foreach ($_SESSION as $key => $val){
//    echo $key.": ".$val."</br>";
//}
$user = unserialize($_SESSION['user']);
$user->show();
if ( isset($_COOKIE[session_name()]) ) {
    setcookie(session_name(),'', time() - 42000, '/');
}
session_destroy();

echo '<a href="http://localhost/lab7/test1.php">test1</a>';