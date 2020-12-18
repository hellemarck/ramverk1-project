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
}
