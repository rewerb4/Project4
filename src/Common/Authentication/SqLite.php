<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 3/17/2015
 * Time: 8:26 PM
 */

namespace Common\Authentication;


use PDO;


class SqLite implements IAuthentication
{
    /**
     * Function authenticate
     *
     * @param string $username
     * @param string $password
     * @return mixed
     *
     * @access public
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        try
        {
            $this->conn = new PDO('sqlite:../src/Common/Authentication/users_pdo.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo 'ERROR: ' . $e->getMessage();
        }
    }


    public function authenticate()
    {
        $data=$this->conn->query('SELECT username FROM user WHERE username = '.$this->conn->quote($this->username).'AND password = '.$this->conn->quote($this->password));

        $result=$data->fetchAll();
        if (count($result)!=1)
        {
            //echo "Authentication failed";
            return 0;
        }
        //echo "Authentication success";
        return 1;
    }





}
