<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Formularz </title>
</head>

<body>
<main>

    <article>
        <h1>Formularzyk: </h1>
        <form action="odbierz2.php" method="post">
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
            <input type="submit" value="Wyślij" />
            <input type="reset" value="Wyczyść" />

        </form>
    </article>
    <footer>&copy;CP</footer>
</main>
</body>

</html>