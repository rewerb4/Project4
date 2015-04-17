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
    public function authenticate($username, $password)
    {

// TODO: Implement authenticate() method.
//open database


        $db = new PDO('sqlite:../src/Common/Authentication/Users_PDO');


        if(!$db)
        {
        return 1;
        }
        /*
        else
        {
        echo "Opened database successfully\n";
        }

        $db->exec("CREATE TABLE user (Id INTEGER PRIMARY KEY, username VARCHAR, password VARCHAR, fname TEXT, lname TEXT, email VARCHAR, twitter VARCHAR, time TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP)");


        $db->exec("INSERT INTO user (username,password,fname,lname,email,twitter) VALUES ('mat', 'hi','mathew','brewer','yourmail@gmail.com','twitterDude');");

        if (!$ret)
        {
        echo $db->lastErrorMsg();
        }
        else
        {
        echo "Records created successfully\n";
        }
        */

        $rows = $db->query("SELECT count(*) as count FROM user WHERE username = '$username' AND password= '$password'");
        $numRows = $rows->fetchColumn();

        if ($numRows == 1) {

            return 1;
        } else {

            return 0;
        }
//close database
        $db = NULL;

    }

    public function create($username, $password, $fname, $lname, $email, $twitter)
    {

        if ($username == '')
        {
            return 1;
        }
        if ($password == '')
        {
            return 1;
        }
        else
        {

            $db = new PDO('sqlite:../src/Common/Authentication/Users_PDO');

            $rows = $db->query("SELECT count(*) as count FROM user WHERE username = '$username' AND password= '$password'");
            $numRows = $rows->fetchColumn();

            if ($numRows == 1)
            {
                echo "username and password already used";
                return 1;
            }
            else
            {
                $db->exec("INSERT INTO user (username,password,fname,lname,email,twitter) VALUES ('$username', '$password','$fname','$lname','$email','$twitter');");
                echo json_encode(array('success' => true, 'message' => 'Account created.'));
                return 0;

            }
        }
    }
}
