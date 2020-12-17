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
                            placeholder="Kowalski" /> </td>
            </tr>
            <tr>
                <td>Wiek : </td>
                <td><input type="number" name="wiek" placeholder="18" /></td>
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
                             /> </td>
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
        <input type="submit" name="submit" value="Statystyki" />
        <input type="submit" name="submit" value="dodaj" />
        <input type="submit" name="submit" value="Pokaz" />
        <input type="submit" name="submit" value="Java" />
        <input type="submit" name="submit" value="PHP" />
        <input type="submit" name="submit" value="Cpp" />


    </form>
    <?php
}
function dodajlab3(){
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
    if(filter_input(INPUT_POST, "tech"))
    {
        foreach ($_REQUEST['tech'] as $kurs){
            $daneDoZapisania .= $kurs.', ';
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

function dodaj(){
    //echo "<h3>Dodawanie do pliku:</h3>";
    walidacja();
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
function walidacja(){
    $args = array(
            "nazwisko" =>['filter' => FILTER_VALIDATE_REGEXP,
                          'options' => ['regexp'=>  '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']
            ],
            "wiek"=> ['filter' => FILTER_VALIDATE_INT,
                      'options' => ['min_range' => 0,
                                    'max_range'=> 120]
            ],
            "panstwo" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            "adres" => FILTER_VALIDATE_EMAIL,
            "tech" => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                       'flags' => FILTER_REQUIRE_ARRAY],
            "zaplata" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );

    $dane = filter_input_array(INPUT_POST, $args);
    //var_dump($dane);
    $path = $_SERVER['DOCUMENT_ROOT']."/../Mojepliki/dane.txt";
    $errors = "";
    foreach ($dane as $key => $val){
        if($val === false or $val === NULL){
            $errors .= $key." ";
        }
    }
    if($errors === ""){
        dopliku($path, $dane);
    }
    else{
        echo "<br> Nie poprawne dane: ". $errors;
    }
}

function dopliku($path, $tablicaDanych){

    $daneDoZapisu = "";
    foreach ($tablicaDanych as $key => $val){
        if (is_array($val)){
            $daneDoZapisu .= join($val, ", ")." ";
        }
        else
            $daneDoZapisu .= $val." ";
    }
    $daneDoZapisu .= PHP_EOL;
    $file = fopen($path, "a");
    fwrite($file, $daneDoZapisu);
    fclose($file);
}

function statystyka(){
    $count = -1;
    $count18 = 0;
    $count50 = 0;
    $path = $_SERVER['DOCUMENT_ROOT']."/../Mojepliki/dane.txt";
    $file = fopen($path,"r");
    while(!feof($file)) {
        $count ++;
        $arr = explode(" ", fgets($file));
//        var_dump($arr);
//        echo "<br>";
        if($arr[0] != ""){
            if($arr[1] < 18) $count18++;
            else if($arr[1] > 50) $count50++;
        }

    }
    echo "Suma zamówień: ".$count.", Suma zamówień z wiekiem poniżej 18 lat: ".$count18.", Suma zamówień z wiekiem powyżej 50 lat: ".$count50;
}