<?php


class Baza {
    private $mysqli;
    public function __construct($serwer, $user, $pass, $baza) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączenie z serwerem: %s\n",
                $this->mysqli->connect_error);
            exit();
        }
        if ($this->mysqli->set_charset("utf8")) {

        }
    }
    function __destruct() {
        $this->mysqli->close();
    }
    public function select($sql, $pola) {

        $tresc = "";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola);
            $ile = $result->num_rows;

            $tresc.="<table  border='2px'><tbody>";
            while ($row = $result->fetch_object()) {
                $tresc.="<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc.="<td>" . $row->$p . "</td>";
                }
                $tresc.="</tr>";
            }
            $tresc.="</tbody></table>";
            $result->close();
        }
        return $tresc;
    }
    public function insert($sql) {
        echo $sql;
        if($this->mysqli->query($sql)) echo 'dodawane dane sa';
        else echo 'coś nie teges';
    }
    public function delete($sql) {
        $this->mysqli->query($sql);
    }

    public function protect_string($str) {
        return $this->mysqli->real_escape_string($str);
    }

    public function protect_int($nmb) {
        return (int)$nmb;
    }
}

