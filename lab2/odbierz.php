
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Formularz </title>
</head>

<body>
    <?php
        echo '<h2>Dane odebrane z formularza:</h2>';
    if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) {
        $nazwisko = htmlspecialchars(trim($_REQUEST['nazwisko']));
        echo 'Nazwisko: '.$nazwisko.'<br />';
    }
    else echo 'Nie wpisano nazwiska <br />';
    if (isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) {
        $wiek = htmlspecialchars(trim($_REQUEST['wiek']));
        echo 'Wiek: '.$wiek.'<br />';
    }
    else echo 'Nie wpisano wieku <br />';
    if (isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) {
        $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
        echo 'Państwo: '.$panstwo.'<br />';
    }
    if (isset($_REQUEST['adres'])&&($_REQUEST['adres']!="")) {
        $adres = htmlspecialchars(trim($_REQUEST['adres']));
        echo 'E-mail: '.$adres.'<br />';
    }
    else echo 'Nie wpisano adresu e-mail<br />';
        foreach ($_REQUEST['tech'] as $kurs){
            echo $kurs.'<br />';
        }


    ?>
</body>

</html>

