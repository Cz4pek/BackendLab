<?php


class User
{
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;

    private $username;
    private $password;
    private $fullName;
    private $email;
    private $date;
    private $status;

    /**
     * User constructor.
     * @param $username
     * @param $password
     * @param $fullName
     * @param $email
     */
    public function __construct($username, $password, $fullName, $email)
    {
        $this->username = $username;
        $this->password = password_hash($password,PASSWORD_BCRYPT);
        $this->fullName = $fullName;
        $this->email = $email;
        $this->date = (new DateTime())->format('Y-m-d');
        $this->status = self::STATUS_USER;
    }

    public function show(){
        echo $this->username."<br>";
        echo $this->password."<br>";
        echo $this->fullName."<br>";
        echo $this->email."<br>";
        echo $this->date."<br>";
        echo $this->status."<br>";
    }

    static public function getAllUsers($plik){
        $allUsers = json_decode(file_get_contents($plik));
        foreach ($allUsers as $val){
            echo "<p>".$val->username." ".$val->fullName." ".$val->date." </p>";
        }

    }

    public function toArray(){
        $users = [
            "username" => $this->username,
            "password" => $this->password,
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
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return false|string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param false|string|null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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