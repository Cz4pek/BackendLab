<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ankieta </title>
</head>

<body>
<h1>Wybierz technologie które znasz:</h1>
<form action="ankieta.php" method="post">
<?php
$tech = ["C", "Cpp", "Java", "C#", "HTML", "CSS", "XML", "PHP",  "JavaScript"];
foreach ($tech as $value){
    echo '<input type="checkbox" name="tech[]" value='.$value.' />'.$value."<br>";
}
?>
<input type="submit" name="submit" value="wyślij" />
</form>
<br>
<br>
<?php

if(filter_input(INPUT_POST, "submit")){
    $input = filter_input(INPUT_POST, 'tech', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $path = "ankieta.txt";
    if(!file_exists($path)){
        $file = fopen($path, "a");
        foreach ($tech as $val){
            $temp = "0\n";
            fwrite($file, $temp);
        }
        fclose($file);
    }
    $file = fopen($path,"r");
    $arr = file($path, FILE_SKIP_EMPTY_LINES);
    fclose($file);
    $i = 0;
    foreach ($arr as $key => $val){
        $arr[$tech[$i]] = $val;
        unset($arr[$key]);
        $i++;
    }
    foreach ($input as $key => $val){
        $arr[$val] = strval(intval($arr[$val])+1)."\n";
    }

    foreach ($arr as $key => $val){
        echo $key." => ".$val."<br>";
    }

    $file = fopen($path, "w");
    foreach ($arr as $val){
        $temp = $val;
        fwrite($file, $temp);
    }
    fclose($file);


}
?>

<br>
<footer>&copy;CP</footer>
</body>

</html>

