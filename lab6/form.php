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
include_once "Baza.php";
drukuj_form();

$bd = new Baza("localhost", "root", "test", "klienci");
if (filter_input(INPUT_POST, "submit")) {
    $akcja = filter_input(INPUT_POST, "submit");
    switch ($akcja) {
        case "dodaj" :
            dodajdoBD($bd);
            break;
        case "Pokaz" :
            echo '<h3>Pokazywane sa rekordy</h3>';
            echo $bd->select("select * from klienci",
                array("Id", "Nazwisko", "Zamowienie"));
            break;
        case "Delete" :
            $delete = "delete from klienci where Id = ".filter_input(INPUT_POST, "id");
            $bd->delete($delete);
//            echo $bd->select("select * from klienci",
//                array("Nazwisko", "Zamowienie"));
            break;
        default:
            $select = "select Nazwisko, Zamowienie from klienci where Zamowienie LIKE '%".$akcja."%';";
            echo $bd->select($select,
                array("Nazwisko", "Zamowienie"));
            break;
    }
}


?>
    </article>
    <footer>&copy;CP</footer>
</main>
</body>

</html>