<?php

namespace Mh\Forum\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\TextFilter\TextFilter;
use Mh\Forum\Question;
use Mh\Forum\Reply;
use Mh\Forum\Comment;
use Mh\Forum\Tag;
use Mh\Forum\Tag2Question;

/**
 * Example of FormModel implementation.
 */
class CreateCommentQuestionForm extends FormModel
{
    // public $replyid;
    public $questionid;
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $this->questionid = $id;
        // $this->replyid = $replyid;
        $this->form->create(
            [
                "id" => __CLASS__,
                "escape-values" => false
            ],
            [

                "text" => [
                    "label"       => "Kommentera",
                    "type"        => "text",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Skicka kommentar",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        // $id            = $this->form->value("id");
        $text          = $this->form->value("text");
        $userid        = $_SESSION["user"] ?? null;

        if (!$userid) {
            $this->di->get("response")->redirect("user/login")->send();
        }

        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->userid = $userid;
        $comment->text = $text;
        $comment->date = date("Y-m-d H:i:s");

        // if ($this->replyid) {
        //     $comment->replyid = $replyid;
        // } else {
        $comment->questionid = $this->questionid;
        // }

        $comment->save();

        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("forum/question/" . $this->questionid)->send();
    }
}
