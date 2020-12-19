<?php

namespace Mh\Forum;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Tag extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tag";
    protected $tableIdColumn = "tagid";



    /**
     * Columns in the table.
     *
     * @var integer $tagid primary key auto incremented.
     */
    public $tagid;
    public $tag;

    public function joinTagAndQuestions($value)
    {
        $params = is_array($value) ? $value : [$value];
        $this->checkDb();
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        // ->join("Tag2Question", "Tag.tagid = Tag2Question.tagid")
                        // ->joinLeft("Question", "Tag2Question.questionid = Question.questionid")
                        ->where("Tag.tagid = ?")
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }

    // public function findAllWhereJoin($where, $value)
    // {
    //     $params = is_array($value) ? $value : [$value];
    //     $this->checkDb();
    //     return $this->db->connect()
    //                     ->select()
    //                     ->from($this->tableName)
    //                     ->join("User", "User.userid = Reply.userid")
    //                     // ->leftJoin("Comment", "Comment.replyid = Reply.replyid")
    //                     ->where($where)
    //                     ->execute($params)
    //                     ->fetchAllClass(get_class($this));
    // }
}
