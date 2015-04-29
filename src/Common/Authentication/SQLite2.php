<?php
namespace Common\Authentication;
use PDO;

class SQLite2
{
    protected $user;

    public function __construct($param_user)
    {

        $this->user = $param_user;


        if ($this->user->getPassword() !== NULL)


            try {
                $this->conn = new PDO('sqlite:../src/Common/Authentication/users_pdo.db');

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }


    }
    public function getProfileData()
    {

        $data = $this->conn->query('SELECT username,fname,lname,email,twitter,time From user Where username =' . $this->conn->quote($this->user->getUsername()));

        foreach ($data->fetchAll() as $i) {
            $S = array('username' => $i[0],
                'fname' => $i[1],
                'lname' => $i[2],
                'email' => $i[3],
                'twitter' => $i[4],
                'time' => $i[5]);

            return $S;

        }
    }
    public function registerNewUser()
    {
        $data=$this->conn->query('SELECT username FROM user WHERE username= '.$this->conn->quote($this->user->getUsername()));

        $result=$data->fetchAll();

        if(count($result)!==0)
        {
            return 0;
        }

        $this->conn->query('INSERT INTO user (username, password, fname, lname, email, twitter) VALUES ('
            .$this->conn->quote($this->user->getUsername()).','
            .$this->conn->quote($this->user->getPassword()).','
            .$this->conn->quote($this->user->getFirstName()).','
            .$this->conn->quote($this->user->getLastName()).','
            .$this->conn->quote($this->user->getEmail()).','
            .$this->conn->quote($this->user->getTwitterName()).')');

        $data=$this->conn->query('SELECT username FROM user WHERE username = '.$this->conn->quote($this->user->getUsername()));

        $result=$data->fetchAll();

        if (count($result)===1)
        {
            //false
            return 1;
        }
        else {
            //true
            return 0;
        }
    }
}