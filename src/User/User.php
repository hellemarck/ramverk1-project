<?php

namespace Mh\User;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class User extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "User";
    protected $tableIdColumn = "userid";

    /**
    * Columns in the table.
    *
    * @var integer $userid primary key auto incremented.
    * @var string  $username not null.
    * @var string  $pw not null.
    * @var string  $email.
    * @var integer $activity.
    */
    public $userid;
    public $username;
    public $pw;
    public $email;
    public $activity;

    /**
     * Set the password.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->pw = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verify the acronym and the password, if successful the object contains
     * all details from the database row.
     *
     * @param string $acronym  acronym to check.
     * @param string $password the password to use.
     *
     * @return boolean true if acronym and password matches, else false.
     */
    public function verifyPassword($username, $password)
    {
        $this->find("username", $username);
        return password_verify($password, $this->pw);
    }

    // generate a gravatar based on email
    public function gravatar($email)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "&s=" . 40;
    }

    // find the three most active users for home pages
    // in question, reply and comment tables
    public function findMostActiveUsers($join, $where)
    {
        $this->checkDb();
        return $this->db->connect()
        // , count(Question.userid) as sumQ, count(Reply.userid) as sumR, count(Comment.userid) as sumC
                        ->select("*, count(user.userid) as sum")
                        ->from($this->tableName)
                        ->join($join, $where)
                        ->groupBy("User.userid")
                        ->orderBy("sum DESC")
                        ->limit("3")
                        ->execute()
                        ->fetchAllClass(get_class($this));
    }
}
