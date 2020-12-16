<?php

namespace Mh\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
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

        // $userIP = $this->di->get("currentip");

        $page->add("tag/index");
        return $page->render([
            "title" => $title,
        ]);
    }
}
