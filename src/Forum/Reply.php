<?php

namespace Mh\Forum;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Reply extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Reply";
    protected $tableIdColumn = "replyid";

    /**
     * Columns in the table.
     *
     * @var integer $replyid primary key auto incremented.
     */
    public $replyid;
    public $questionid;
    public $userid;
    public $date;
    public $text;

    // method to match replies w user
    public function findAllWhereJoin($where, $value)
    {
        $params = is_array($value) ? $value : [$value];
        $this->checkDb();
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->join("User", "User.userid = Reply.userid")
                        ->where($where)
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }

    // used in the UserController to get the questionid for comments
    public function findQuestionIdWhere($where, $value) : object
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        $this->db->connect()
                 ->select("Reply.Questionid")
                 ->from($this ->tableName)
                 ->where($where)
                 ->execute($params)
                 ->fetchInto($this);
        return $this;
    }

    // generate a gravatar based on email
    public function gravatar($email)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "&s=" . 40;
    }
}
