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

    // public function joinTagAndQuestions($value)
    // {
    //     $params = is_array($value) ? $value : [$value];
    //     $this->checkDb();
    //     return $this->db->connect()
    //                     ->select()
    //                     ->from($this->tableName)
    //                     ->where("Tag.tagid = ?")
    //                     ->execute($params)
    //                     ->fetchAllClass(get_class($this));
    // }

    // used in the HomeController to get the most popular tags
    public function countTags() {
        $this->checkDb();
        return $this->db->connect()
                        ->select("*, count(Tag2Question.tagid) as sum")
                        ->from($this->tableName)
                        ->join("Tag2Question", "Tag2Question.tagid = tag.tagid")
                        ->groupBy("Tag.tagid")
                        ->orderBy("sum DESC")
                        ->limit(3)
                        ->execute()
                        ->fetchAllClass(get_class($this));
    }
}
