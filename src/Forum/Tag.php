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
}
