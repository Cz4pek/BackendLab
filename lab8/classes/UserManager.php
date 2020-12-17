<?php

class UserManager
{
    public function loginForm()
    {
        ?>
        <h1>Formularzyk: </h1>
        <form action="index.php" method="post">
            <table>
                <tbody>
                <tr>
                    <td>Nazwa użytkownika : </td>
                    <td> <input type="text" name="userName"/> </td>
                </tr>
                <tr>
                    <td>Hasło :</td>
                    <td><input type="password" name="passwd" /></td>
                </tr>
                </tbody>
            </table>

            <input type="reset" value="Wyczyść" />
            <input type="submit" name="zaloguj" value="Zaloguj" />
            <input type="submit" name="register" value="Zarejestruj"/>
        </form>

        <?php
    }

    public function login($db){
        $args = [
            'userName' => FILTER_SANITIZE_MAGIC_QUOTES,
            'passwd' => FILTER_SANITIZE_MAGIC_QUOTES
        ];
        $data = filter_input_array(INPUT_POST, $args);
       // var_dump($data);
        $userId = $db->selectUser($data['userName'], $data['passwd'], "users");
        if($userId >= 0){
            session_start();
            $db->delete("DELETE FROM logged_in_users WHERE userId = '$userId'");
            $date = (new DateTime())->format("Y-m-d H:i:s");
            $this->addToDb(session_id(), $userId, $date, $db);
        }
        return $userId;
    }
    public function addToDb($sessionId, $userId, $date, $db){
        $sql = "INSERT INTO logged_in_users (`sessionId`, `userId`, `lastUpdate`) VALUES ('$sessionId', '$userId', '$date')";
        $db->insert($sql);
    }
    public function logout($db){
        session_start();
        $sessionId = session_id();
        //echo "wylogowywane jest </br>";
        $sql = "DELETE FROM logged_in_users WHERE sessionId = '$sessionId'";
        //echo $sql;
        $db->delete($sql);
        if ( isset($_COOKIE[session_name()]) ) {
            setcookie(session_name(),'', time() - 42000, '/');
        }
        session_destroy();
    }

    public function getLoggedInUser($db, $sessionId){
        $result = $db->selectAndReturn("SELECT userId FROM logged_in_users WHERE sessionId = '$sessionId'");
        $count = $result->num_rows;
        if($count == 1){
            $row = $result->fetch_object();
            return $row->userId;
        }
        else return -1;
    }
}