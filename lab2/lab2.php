<?php
function show ($astab){
    echo "<table>
                        <tr>
                            <th>Indeks</th>
                            <th>Student</th>
                        </tr>";
    foreach ($astab as $index => $student) {
        echo '<tr>
                <td>'.$index.'</td>
                <td>'.$student.'</td>
              </tr>';
    }
    echo '</table>
           <br>';
}


    $astab = [91000 => "Adam Mickiewicz", 91004 => "Juliusz Słowacki",
    91003 => "Aleksander Fredro", 91002 => "Cyprian Kamil Norwid", 91001 => "Bolesław Leśmian"];

    show($astab);
    ksort($astab);
    show($astab);
    asort($astab);
    show($astab);
    array_push($astab, "Przerwa Tetmajer");
    show($astab);
    $astab = array_merge($astab, [91010 => "Kamil Baczyński"]);
    show($astab);
    shuffle($astab);
    show($astab);


    $studentsWithGrades = [91000 => [2,3,4,5], 91001 =>[5,5,5,5]];

    foreach ($studentsWithGrades as $index => $grades){
        echo $index." ".array_sum($grades)/count($grades).'<br>' ;
    }
