<?php
//$nazwa='obraz1';
//print("<img src='obrazki/$nazwa.JPG' alt='$nazwa' />" );


 function galeria($rows, $cols)
 {
     $index = 1;
     for ($i = 0; $i < $rows; $i++){
         for ($j = 0; $j < $cols; $j++) {
             print("<img src='obrazki/obraz$index.JPG' alt='obraz$index' />" );

             $index ++;
         }
         echo "<br>";
     }


 }
 //wywołanie funkcji:
 galeria(3,3);
