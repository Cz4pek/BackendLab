<?php


class User
{
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;

    private $userName;
    private $passwd;
    private $fullName;
    private $email;
    private $date;
    private $status;

    /**
     * User constructor.
     * @param $userName
     * @param $passwd
     * @param $fullName
     * @param $email
     */
    public function __construct($userName, $passwd, $fullName, $email)
    {
        $this->userName = $userName;
        $this->passwd = password_hash($passwd,PASSWORD_BCRYPT);
        $this->fullName = $fullName;
        $this->email = $email;
        $this->date = (new DateTime())->format('Y-m-d');
        $this->status = self::STATUS_USER;
    }

    public function show(){
        echo "User name: ".$this->userName."<br>";
        echo "Password : ".$this->passwd."<br>";
        echo "Full name : ".$this->fullName."<br>";
        echo "Email : ".$this->email."<br>";
        echo "Registration date : ".$this->date."<br>";
        if($this->status == self::STATUS_USER){
            echo "Status : User <br>";
        }
        else echo "Status : Admin <br>";
    }

    static public function getAllUsers($plik){
        $allUsers = json_decode(file_get_contents($plik));
        foreach ($allUsers as $val){
            echo "<p>".$val->userName." ".$val->fullName." ".$val->date." </p>";
        }

    }

    public function toArray(){
        $users = [
            "userName" => $this->userName,
            "passwd" => $this->passwd,
            "fullName" => $this->fullName,
            "email" => $this->email,
            "date" => $this->date,
            "status" => $this->status
        ];
        return $users;
    }

    public function saveToJson($plik){
        $allUsers = json_decode(file_get_contents($plik), true);
        array_push($allUsers, $this->toArray());
        file_put_contents($plik, json_encode($allUsers));
    }

    public function saveToDB($db){
        $insert = "INSERT INTO `users` (`userName`, `fullName`, `email`, `passwd`, `status`, `date`) 
                    VALUES ('".$this->userName."', '".$this->fullName."', '".$this->email."', '".  $this->passwd."', '".$this->status."','". $this->date."')";
        $db->insert($insert);
    }

    static public function getAllUsersFromDB($db){
        echo $db->select("select * from users", array("id", "userName", "fullName"));
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUsername($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return false|string|null
     */
    public function getPassword()
    {
        return $this->passwd;
    }

    /**
     * @param false|string|null $passwd
     */
    public function setPassword($passwd)
    {
        $this->passwd = $passwd;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


}