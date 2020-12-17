<?php
function drukuj_form(){
    ?>
    <main>

    <article>
    <h1>Formularzyk: </h1>
    <form action="form.php" method="post">
        <table>
            <tbody>
            <tr>
                <td>Nazwisko : </td>
                <td> <input type="text" name="nazwisko"
                            title="Nazwisko musi zaczynać się Wielką literą, po niej musi nastąpić co najwyżej 25 liter małych"
                            pattern="^[A-ZŁĄŹŻĆĄŚ][a-zążśźćł]{1,25}$" placeholder="Kowalski" /> </td>
            </tr>
            <tr>
                <td>Wiek : </td>
                <td><input type="number" name="wiek" min="0" max="120" placeholder="18" /></td>
            </tr>
            <tr>
                <td>Państwo :</td>
                <td> <select name="panstwo">
                        <option value="polska">Polska</option>
                        <option value="inne">Inne</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Adres email :</td>
                <td> <input type="email" name="adres" placeholder="example@hosting.com"
                            title="Przykładowy email : example@hosting.com"
                            pattern=".{1,25}@\w{1,25}\.\w+$" /> </td>
            </tr>
            </tbody>
        </table>

        <h3>Zamawaim kurs z języla</h3>
        <?php
        $tech = ["Java", "PHP", "Cpp", "HLA"];
        foreach ($tech as $value){
            echo '<input type="checkbox" name="tech[]" value='.$value.' />'.$value;
        }
        ?>

        <br>
        <h3>Sposób zapłaty</h3>
        <input type="radio" name="zaplata" value="eurocard" /> Eurocard <br>
        <input type="radio" name="zaplata" value="visa" /> Visa <br>
        <input type="radio" name="zaplata" value="przelew" /> Przelew bankowy <br><br>
        <input type="reset" value="Wyczyść" />
        <input type="submit" name="submit" value="dodaj" />
        <input type="submit" name="submit" value="Pokaz" />
        <input type="submit" name="submit" value="Java" />
        <input type="submit" name="submit" value="PHP" />
        <input type="submit" name="submit" value="Cpp" />


    </form>
    <?php
}
function dodaj(){
    $daneDoZapisania ="";
    if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) {
        $daneDoZapisania .= htmlspecialchars(trim($_REQUEST['nazwisko'])).' ';
    }
    if (isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) {
        $daneDoZapisania .= htmlspecialchars(trim($_REQUEST['wiek'])).' ';
    }
    if (isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) {
        $daneDoZapisania .= htmlspecialchars(trim($_REQUEST['panstwo'])).' ';
    }
    if (isset($_REQUEST['adres'])&&($_REQUEST['adres']!="")) {
        $daneDoZapisania .= htmlspecialchars(trim($_REQUEST['adres'])).' ';
    }
    //$kursy = $_REQUEST['tech'];
    if(filter_input(INPUT_POST, "tech")) {
        foreach ($_REQUEST['tech'] as $kurs) {
            $daneDoZapisania .= $kurs . ', ';
        }
    }
    $daneDoZapisania = rtrim($daneDoZapisania, ", ")." ";
    if (isset($_REQUEST['zaplata'])&&($_REQUEST['zaplata']!="")) {
        $daneDoZapisania .= htmlspecialchars(trim($_REQUEST['zaplata'])).' ';
    }
    $daneDoZapisania .= "\n";

    $path = $_SERVER['DOCUMENT_ROOT']."/../Mojepliki/dane.txt";

    $file = fopen($path, "a");
    fwrite($file, $daneDoZapisania);
    fclose($file);
}
function pokaz(){
    $path = $_SERVER['DOCUMENT_ROOT']."/../Mojepliki/dane.txt";
    $file = fopen($path,"r");
    while(!feof($file)) {
        echo fgets($file). "<br />";
    }
    fclose($file);
}
function pokaz_zamowienie($key){
    $path = $_SERVER['DOCUMENT_ROOT']."/../Mojepliki/dane.txt";
    $zamowienia=file($path);
    foreach ($zamowienia as $zamowienie){
        if(strpos($zamowienie, $key) !== false) echo $zamowienie. "<br>";
    }
}