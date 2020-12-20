<?php

namespace Mh\Home;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Mh\User\User;
use Mh\Forum\Tag;
use Mh\Forum\Question;
// use Anax\Models\CurrentIp;

/**
 * Controllerclass for IP validation
 */
class HomeController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * rendering index page for user to type ip address
     * with current ip as default value
     */
    public function indexAction()
    {
        // var_dump($this->di);
        $page = $this->di->get("page");
        $title = "Hem";

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $tags = $tag->countTags();

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $mostQActive = $user->findMostActiveUsers("Question", "Question.userid = User.userid");
        $mostRActive = $user->findMostActiveUsers("Reply", "Reply.userid = User.userid");
        $mostCActive = $user->findMostActiveUsers("Comment", "Comment.userid = User.userid");


        $page->add("home/index", [
            "latestQuestions" => $question->joinTwoTables("User", "Question.userid = User.userid", "Question.questionid DESC LIMIT 3"),
            "popularTags" => $tags,
            "mostActiveQuestion" => $mostQActive,
            "mostActiveReply" => $mostRActive,
            "mostActiveComment" => $mostCActive
        ]);
        // $page->add("home/index");
        return $page->render([
            "title" => $title,
        ]);
    }
}
