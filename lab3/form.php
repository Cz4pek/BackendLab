<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Formularz </title>
</head>

<body>
<?php
include_once "funkcje.php";

        drukuj_form();
        echo '<br>';
        $key = htmlspecialchars(trim($_REQUEST['submit']));
        switch ($key) {
            case "dodaj":
                dodaj();
                break;
            case "Pokaz":
                pokaz();
                break;
            default:
                pokaz_zamowienie($key);
                break;
        }

        foreach ($_SERVER as $key => $value){
            echo $key. " => ".$value."<br>";
        }
?>
    </article>
    <footer>&copy;CP</footer>
</main>
</body>

</html>