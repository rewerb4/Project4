<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 4/9/2015
 * Time: 12:25 PM
 */

namespace Common\Authentication;

use SQLite3;

class TwitterAuth
{
    private $conn;
    private $twitter;

    public function __construct($twitter)
    {
        $this->twitter = $twitter;
        $this->conn = new SQLite3('../src/Common/Authentication/users_pdo.db');
    }

    public function authenticate()
    {
        $statement = $this->conn->prepare("SELECT * FROM user WHERE twitter = :twitter;");
        $statement->bindValue(':twitter', $this->twitter);
        $result = $statement->execute();
        $rows = $result->fetchArray(SQLITE3_ASSOC);

        if ($rows !== false && count($rows) > 0)
        {
            echo json_encode($rows);
        }
        else
        {
            echo json_encode(array('error' => 'Invalid twitter username.'));
        }
    }
}