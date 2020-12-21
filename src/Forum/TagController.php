<?php

namespace Mh\Forum;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Mh\Forum\Tag;

// use Anax\Models\IpValidator;
// use Anax\Models\GeoApi;
// use Anax\Models\CurrentIp;

/**
 * Controllerclass for IP validation
 */
class TagController implements ContainerInjectableInterface
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
        $title = "Taggar";

        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));


        $page->add("tag/index", [
            "tags" => $tag->findAll(),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function tagAction(int $id) : object
    {
        $page = $this->di->get("page");
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $tag->find("tagid", $id);

        $t2q = new Tag2Question();
        $t2q->setDb($this->di->get("dbqb"));
        $result = $t2q->findAllWhere("Tag2Question.tagid = ?", $id);

        foreach ($result as $res) {
            $quest = new Question();
            $quest->setDb($this->di->get("dbqb"));
            $res->question = $quest->find("questionid", $res->questionid);
        }

        $data = [
            "tag" => $tag->tag,
            "res" => $result
        ];

        $page->add("tag/tag", $data);

        return $page->render([
            "title" => "Tagg"
        ]);
    }
}
