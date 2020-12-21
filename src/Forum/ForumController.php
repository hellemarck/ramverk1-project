<?php

namespace Mh\Forum;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Mh\Forum\HTMLForm\CreateForm;
use Mh\Forum\HTMLForm\CreateReplyForm;
use Mh\Forum\HTMLForm\CreateCommentQuestionForm;
use Mh\Forum\HTMLForm\CreateCommentReplyForm;
use Anax\TextFilter\TextFilter;
use Mh\User\User;

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
        $filter = new TextFilter();

        $page->add("forum/crud/view-all", [
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
        $user = $_SESSION["user"];
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
    // public function deleteAction() : object
    // {
    //     $page = $this->di->get("page");
    //     $question = new DeleteForm($this->di);
    //     $question->check();
    //
    //     $page->add("forum/crud/delete", [
    //         "form" => $question->getHTML(),
    //     ]);
    //
    //     return $page->render([
    //         "title" => "Radera inlägg",
    //     ]);
    // }



    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    // public function updateAction(int $id) : object
    // {
    //     $page = $this->di->get("page");
    //     $form = new UpdateForm($this->di, $id);
    //     $form->check();
    //
    //     $page->add("forum/crud/update", [
    //         "form" => $form->getHTML(),
    //     ]);
    //
    //     return $page->render([
    //         "title" => "Update an item",
    //     ]);
    // }

    public function questionAction(int $id) : object
    {
        $page = $this->di->get("page");
        $this->di->get("session")->set("question", $id);
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $res = $question->find("questionid", $id);

        $user = new User();
        $user->setDb($this->di->get("dbqb"));

        $tags = new Tag2Question();
        $tags->setDb($this->di->get("dbqb"));

        $qComment = new Comment();
        $qComment->setDb($this->di->get("dbqb"));
        $qcomments = $qComment->findAllWhereJoin("comment.questionid = ?", $id);

        $reply = new Reply();
        $reply->setDb($this->di->get("dbqb"));
        $replies = $reply->findAllWhereJoin("reply.questionid = ?", $id);

        foreach ($replies as $reply) {
            $rComment = new Comment();
            $id = $reply->replyid;
            $rComment->setDb($this->di->get("dbqb"));
            $reply->comments = $rComment->findAllWhereJoin("Comment.replyid = ?", $id);
        }

        $replyForm = new CreateReplyForm($this->di, $id);
        $replyForm->check();

        $commentFormQuest = new CreateCommentQuestionForm($this->di, $id);
        $commentFormQuest->check();


        $data = [
            "question" => $res,
            "tags" => $tags->joinTags($id),
            "replyForm" => $replyForm->getHTML(),
            "commentFormQuest" => $commentFormQuest->getHTML(),
            "user" => $user->find("userid", $question->userid),
            "qComments" => $qcomments,
            "replies" => $replies,
            "filter" => new TextFilter()
        ];

        $page->add("forum/question", $data);

        return $page->render([
            "title" => "Inlägg"
        ]);
    }


    public function commentAction(int $id) : object
    {
        $page = $this->di->get("page");
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $reply = new Reply();
        $reply->setDb($this->di->get("dbqb"));

        $commentFormReply = new CreateCommentReplyForm($this->di, $id);
        $commentFormReply->check();

        $page->add("forum/comment", [
            "commentFormReply" => $commentFormReply->getHTML(),
            "reply" => $reply->findAllWhereJoin("reply.replyid = ?", $id),
            "filter" => new TextFilter()
        ]);

        return $page->render([
            "title" => "Kommentera fråga",
        ]);
    }
}
