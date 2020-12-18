<?php

namespace Mh\Forum;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Mh\Forum\HTMLForm\CreateForm;
use Mh\Forum\HTMLForm\EditForm;
use Mh\Forum\HTMLForm\DeleteForm;
use Mh\Forum\HTMLForm\UpdateForm;
use Mh\Forum\HTMLForm\CreateReplyForm;
use Mh\Forum\HTMLForm\CreateCommentForm;
use Anax\TextFilter\TextFilter;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class ForumController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     public $userid = $_SESSION["user"] ?? null;
    // }



    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $filter = New TextFilter();

        $page->add("forum/crud/view-all", [
            // "items" => $question->findAll(),
            "q2u" => $question->joinTwoTables("User", "Question.userid = User.userid", "Question.questionid DESC"),
            "q2t" => $question->joinTagAndQuestion(),
            "filter" => $filter
        ]);

        return $page->render([
            "title" => "Foruminlägg",
        ]);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $user = $_SESSION["user"]; // ?? null;
        $question = new CreateForm($this->di, $user);
        $question->check();

        $page->add("forum/crud/create", [
            "form" => $question->getHTML(),
        ]);

        return $page->render([
            "title" => "Skapa inlägg",
        ]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return object as a response object
     */
    public function deleteAction() : object
    {
        $page = $this->di->get("page");
        $question = new DeleteForm($this->di);
        $question->check();

        $page->add("forum/crud/delete", [
            "form" => $question->getHTML(),
        ]);

        return $page->render([
            "title" => "Radera inlägg",
        ]);
    }



    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("forum/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }

    public function questionAction(int $id) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $res = $question->find("questionid", $id);
        // $res = $question->joinQuestionComments($id);

        $tags = new Tag2Question();
        $tags->setDb($this->di->get("dbqb"));

        $qComment = new Comment();
        $qComment->setDb($this->di->get("dbqb"));
        $qcomments = $qComment->findAllWhere("comment.questionid = ?", $id);


        $reply = new Reply();
        $reply->setDb($this->di->get("dbqb"));
        $replies = $reply->findAllWhere("reply.questionid = ?", $id);


        // set if comment is to answer or reply
        $replyid = null;
        // $type = "replyid";

        $replyForm = new CreateReplyForm($this->di, $id);
        $replyForm->check();

        $commentForm = new CreateCommentForm($this->di, $id, $replyid);
        $commentForm->check();

        $data = [
            "question" => $res,
            "tags" => $tags->joinTags($id),
            "replyForm" => $replyForm->getHTML(),
            "commentForm" => $commentForm->getHTML(),
            "qComments" => $qcomments
        ];

        $page->add("forum/question", $data);

        return $page->render([
            "title" => "Inlägg"
        ]);
    }
    //
    // public function replyPostAction()
    // {
    //     var_dump("SVAR");
    // }
    //
    // public function commentPostAction()
    // {
    //     var_dump("KOMMENTAR");
    // }
}
