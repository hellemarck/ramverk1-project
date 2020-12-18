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
}
