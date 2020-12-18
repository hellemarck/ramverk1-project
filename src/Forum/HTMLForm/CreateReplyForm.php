<?php

namespace Mh\Forum\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\TextFilter\TextFilter;
use Mh\Forum\Question;
use Mh\Forum\Reply;
use Mh\Forum\Tag;
use Mh\Forum\Tag2Question;

/**
 * Example of FormModel implementation.
 */
class CreateReplyForm extends FormModel
{
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
        $this->form->create(
            [
                "id" => __CLASS__,
                // "legend" => "Skapa användare",
                "escape-values" => false
            ],
            [
                "id" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "value" => $id,
                ],

                "text" => [
                    "label"       => "",
                    "type"        => "text",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Svara",
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
        $questionid    = $this->form->value("id");
        $text          = $this->form->value("text");
        $userid        = $_SESSION["user"] ?? null;

        if (!$userid) {
            $this->di->get("response")->redirect("user/login")->send();
        }

        $reply = new Reply();
        $reply->setDb($this->di->get("dbqb"));
        $reply->userid = $userid;
        $reply->questionid = $questionid;
        $reply->text = $text;
        $reply->date = date("Y-m-d H:i:s");
        $reply->save();

        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("forum/question/" . $this->questionid)->send();
    }
}
