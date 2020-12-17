<?php
include 'classes/User.php';
$user1 = new User ('kp', 'nielubietygryska',
    'Kubus Puchatek', 'kubus@stumilowylas.pl');
$user1->show();

$user1->setUsername('Admin');
$user1->setStatus(User::STATUS_ADMIN);

$user1->show();

?>
