<?php

namespace Mh\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
// use Anax\Models\IpValidator;
// use Anax\Models\GeoApi;
// use Anax\Models\CurrentIp;

/**
 * Controllerclass for user handling
 */
class UserController implements ContainerInjectableInterface
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
        $title = "Min sida";

        // ALT OM EJ INLOGGAD -> LOGIN

        $page->add("user/index");
        return $page->render([
            "title" => $title,
        ]);
    }
}
