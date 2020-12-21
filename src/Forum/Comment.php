<?php

namespace Mh\Forum;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Comment extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comment";
    protected $tableIdColumn = "commentid";



    /**
     * Columns in the table.
     *
     * @var integer $commentid primary key auto incremented.
     */
    public $commentid;
    public $replyid;
    public $questionid;
    public $userid;
    public $date;
    public $text;

    // function to get username w comment
    // public function joinCommentUser($id)
    // {
    //     $this->checkDb();
    //     return $this->db->connect()
    //                     ->select()
    //                     ->from("User")
    //                     ->join("Comment", "User.userid = Comment.userid")
    //                     ->execute()
    //                     ->fetchAllClass(get_class($this));
    // }

    public function findAllWhereJoin($where, $value)
    {
        $params = is_array($value) ? $value : [$value];
        $this->checkDb();
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->join("User", "User.userid = Comment.userid")
                        ->where($where)
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }
}
