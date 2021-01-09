<?php

namespace Mh\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Mh\User\User;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
            ],
            [
                "user" => [
                    "type"        => "text",
                    "label"       => "Användarnamn",
                ],

                "password" => [
                    "type"        => "password",
                    "label"       => "Lösenord",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Logga in",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "register" => [
                    "type" => "submit",
                    "value" => "Skapa användare",
                    "callback" => [$this, "callbackRegister"]
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
        $username      = $this->form->value("user");
        $password      = $this->form->value("password");

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->verifyPassword($username, $password);

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("Fel användarnamn eller lösenord.");
            return false;
        }

        $this->di->get("session")->set("user", $user->userid);
        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("user")->send();
    }

    public function callbackRegister()
    {
        $this->di->get("response")->redirect("user/create");
    }
}
