<?php
    $zmienna1 = 134;
    $zmienna2 = 67.67;
    $zmienna3 = 1;
    $zmienna4 = 0;
    $zmienna5 = true;
    $zmienna6 = "0";
    $zmienna7 = "Typy w PHP";
    $zmienna8 = date("Y/m/d");
    $zmienna9 = [1, 2, 3, 4];
    $zmienna10 = [];
    $zmienna11 = ["zielony", "czerwony", "niebieski"];

    $data = new DateTime("now");

    echo $zmienna1;
    echo '<br>';
    echo $zmienna2;
    echo '<br>';
    echo $zmienna3;
    echo '<br>';
    echo $zmienna4;
    echo '<br>';
    echo $zmienna5;
    echo '<br>';
    echo $zmienna6;
    echo '<br>';
    echo $zmienna7;
    echo '<br>';
    echo $zmienna8;
    echo '<br>';
    echo '<br>';

    for ($i = 0; $i < count($zmienna9); $i++){
        echo $zmienna9[$i];
        echo '<br>';
    }
    for ($i = 0; $i < count($zmienna10); $i++){
        echo $zmienna10[$i];
        echo '<br>';
    }

    for ($i = 0; $i < count($zmienna11); $i++){
        echo $zmienna11[$i];
        echo '<br>';
    }

    echo is_numeric($zmienna1);
    echo '<br>';
    echo is_numeric($zmienna6);
    echo '<br>';
    echo is_bool($zmienna5);
    echo '<br>';
    echo is_bool($zmienna1);
    echo '<br>';
    echo is_object($zmienna1);
    echo '<br>';
    echo is_object($zmienna9);
    echo '<br>';
    echo '<br>';
    var_dump($zmienna9);
    echo '<br>';
    echo "po var dumpie";
    echo '<br>';
for ($i = 0; $i < count($zmienna9); $i++){
    echo $zmienna9[$i];
    echo '<br>';
}
    echo '<br>';

print_r($zmienna9);
echo '<br>';
echo '<br>';
echo '<br>';

 echo (false == 0)?"true":"false";
echo '<br>';
echo (false === 0)?"true":"false";
