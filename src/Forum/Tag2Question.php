<?php

namespace Mh\Forum;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Tag2Question extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tag2Question";
    protected $tableIdColumn = "id";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $tagid;
    public $questionid;

    // find tags connected to the question
    public function joinTags($value)
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->where("Tag2Question.questionid = ?")
                        ->join("Question", "Tag2Question.questionid = Question.questionid")
                        ->join("Tag", "Tag2Question.tagid = Tag.tagid")
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }
}
