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
        <table>
            <tr>
                <td>Id do usunięcia : </td>
                <td> <input type="number" name="id"/> </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Delete" />



    </form>
    <?php
}
function pokaz(){
    $path = $_SERVER['DOCUMENT_ROOT']."/../Mojepliki/dane.txt";
    $file = fopen($path,"r");
    while(!feof($file)) {
        echo fgets($file). "<br />";
    }
    fclose($file);
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
    $errors = "";
    foreach ($dane as $key => $val){
        if($val === false or $val === NULL){
            $errors .= $key." ";
        }
    }
    if($errors === ""){
        return $dane;
    }
    else{
        return null;
    }
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

function dodajdoBD($bd){
    $dane = walidacja();
    if ($dane == null) echo 'Niepoprawne dane';
    else{
        $insert = "INSERT INTO `klienci` (`Nazwisko`, `Wiek`, `Panstwo`, `Email`, `Zamowienie`, `Platnosc`) VALUES (";
        foreach ($dane as $key => $val){
            if (is_array($val)){
                $insert.="'";
                $insert .= join($val, ",");
                $insert.="', ";
            }
            else
                $insert .= "'".$val."'".", ";
        }
        $insert = rtrim($insert, ", ");
        $insert .= ");";
        $bd->insert($insert);
    }
}