<?php

namespace Mh\Forum;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Question extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Question";
    protected $tableIdColumn = "questionid";

    /**
     * Columns in the table.
     *
     * @var integer $questionid primary key auto incremented.
     */
    public $questionid;
    public $userid;
    public $date;
    public $title;
    public $text;

    // join user with their questions
    public function joinTwoTables($joinTable, $where, $orderBy = null)
    {
        $this->checkDb();
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->join($joinTable, $where)
                        ->orderBy($orderBy)
                        ->execute()
                        ->fetchAllClass(get_class($this));
    }

    // join question with its tags
    public function joinTagAndQuestion()
    {
        $this->checkDb();
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->join("Tag2Question", "Question.questionid = Tag2Question.questionid")
                        ->join("Tag", "Tag2Question.tagid = Tag.tagid")
                        ->execute()
                        ->fetchAllClass(get_class($this));
    }

    // join every questions with its comments
    public function joinQuestionComments($id)
    {
        $this->checkDb();
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->where("Question.questionid = ?", $id)
                        ->join("Comment", "Question.questionid = Comment.questionid")
                        ->execute()
                        ->fetchAllClass(get_class($this));
    }

    // generate a gravatar based on email
    public function gravatar($email)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "&s=" . 40;
    }
}
