<?php

namespace Mh\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Mh\User\HTMLForm\UserLoginForm;
use Mh\User\HTMLForm\CreateUserForm;
use Mh\User\HTMLForm\UpdateUserForm;
use Mh\Forum\Question;
use Mh\Forum\Reply;
use Mh\Forum\Comment;
use Anax\TextFilter\TextFilter;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
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
    //     ;
    // }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexActionGet() //: object
    {
        $page = $this->di->get("page");
        $userid = $_SESSION["user"] ?? null;

        if ($userid) {
            $title = "Min sida";

            $user = new User();
            $user->setDb($this->di->get("dbqb"));
            $user->find("userid", $userid);

            $data = [
                "user" => $user
            ];

            $page->add("user/index", $data);

            return $page->render([
                "title" => $title,
            ]);
        } else {
            $this->loginAction();
        };
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $form = new UserLoginForm($this->di);
        $form->check();

        // var_dump($_SESSION);

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Logga in",
        ]);
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Skapa användare",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function editAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateUserForm($this->di, $id);
        $form->check();

        $page->add("user/edit", [
            "form" => $form->getHTML()
        ]);

        return $page->render([
            "title" => "Redigera användare",
        ]);
    }

    // log out user
    public function logOutAction() : object
    {
        // $this->di->get("request")->getPost("logOut");
        $this->di->get("session")->delete("user");
        $this->di->get("response")->redirect("user/login");
    }


    // view any user page
    public function profileAction(int $id) : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("userid", $id);

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        // $quest =
        // var_dump($question);

        $reply = new Reply();
        $reply->setDb($this->di->get("dbqb"));
        // $reply->find("userid", $id);

        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comments = $comment->findAllWhere("comment.userid = ?", $id);

        foreach ($comments as $com) {
            if ($com->questionid == null) {
                $temp = new Reply();
                $temp->setDb($this->di->get("dbqb"));

                $tempQId = $temp->findQuestionIdWhere("reply.replyid = ?", $com->replyid);
                $com->questionid = $tempQId->questionid;
            }
        }

        if ($user->userid == null) {
            $this->di->get("response")->redirect("/");
        }

        $data = [
            "user" => $user,
            "questions" => $question->findAllWhere("question.userid = ?", $id),
            "replies" => $reply->findAllWhere("reply.userid = ?", $id),
            "comments" => $comments,
            "filter" => New TextFilter()
        ];

        $page->add("user/profile", $data);
        return $page->render([
            "title" => "Användarprofil"
        ]);
    }
}
