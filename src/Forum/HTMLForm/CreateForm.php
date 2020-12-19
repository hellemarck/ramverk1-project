<?php

namespace Mh\Forum\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Mh\Forum\Question;
use Mh\Forum\Tag;
use Mh\Forum\Tag2Question;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, $user)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "questionid" => __CLASS__,
                "escape-values" => false
                // "legend" => "Nytt inlägg",
            ],
            [
                "userid" => [
                    "type" => "text", // "hidden"
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user,
                ],

                // "date" => [
                //     "type" => "text",
                //     "validation" => ["not_empty"],
                // ],

                "title" => [
                    "label" => "Rubrik",
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "text" => [
                    "label" => "Inlägg",
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],

                "tag" => [
                    "label" => "Taggar",
                    "placeholder" => "Exempel: groddar skott",
                    "type" => "text",
                ],

                "submit" => [
                    // "label" => "Skapa inlägg",
                    "type" => "submit",
                    "value" => "Skapa inlägg",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->userid   = $this->form->value("userid");
        $question->date     = date("Y-m-d H:i:s");
        $question->title    = $this->form->value("title");
        $question->text     = $this->form->value("text");
        $question->save();

        /**
         * Handle tags - save new ones and connect them to questions
         */
        $tags = explode(" ", $this->form->value("tag"));
        foreach ($tags as $item) {
            // Save tag if new
            $tag = new Tag();
            $tag->setDb($this->di->get("dbqb"));
            if ($tag->find("tag", $item) == null) {
                $tag->tag = $item;
                $tag->save();
            }
            // Save the question tags
            $tag2q = new Tag2Question();
            $tag2q->setDb($this->di->get("dbqb"));

            $newtag = $tag->find("tag", $item);
            $newquestion = $question->find("title", $question->title);
            $tag2q->questionid = $newquestion->questionid;
            $tag2q->tagid = $newtag->tagid;
            $tag2q->save();
        }
        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    // public function callbackSuccess()
    // {
    //     $this->di->get("response")->redirect("forum")->send();
    // }



    // /**
    //  * Callback what to do if the form was unsuccessfully submitted, this
    //  * happen when the submit callback method returns false or if validation
    //  * fails. This method can/should be implemented by the subclass for a
    //  * different behaviour.
    //  */
    // public function callbackFail()
    // {
    //     $this->di->get("response")->redirectSelf()->send();
    // }
}
