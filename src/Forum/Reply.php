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
                        // ->leftJoin("Comment", "Comment.replyid = Reply.replyid")
                        ->where($where)
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }

    // public function findAllJoinComments
}
