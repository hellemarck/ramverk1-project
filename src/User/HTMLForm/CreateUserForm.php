<?php

namespace Mh\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\TextFilter\TextFilter;
use Mh\User\User;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
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
                "legend" => "Skapa användare",
                "escape-values" => false
            ],
            [
                "username" => [
                    "label"       => "Användarnamn",
                    "type"        => "text",
                ],

                "password" => [
                    "label"       => "Lösenord",
                    "type"        => "password",
                ],

                "password-again" => [
                    "label"       => "Ange lösenord igen",
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Skapa användare",
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
        $username      = $this->form->value("username");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");

        // Check password matches
        if ($password !== $passwordAgain) {
            $this->form->rememberValues();
            $this->form->addOutput("Lösenorden matchar inte, försök igen.");
            return false;
        }

        // Save to database
        // $db = $this->di->get("dbqb");
        // $password = password_hash($password, PASSWORD_DEFAULT);
        // $db->connect()
        //    ->insert("User", ["username", "pw", "activity"])
        //    ->execute([$username, $password, 0]);

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->username = $username;
        $user->setPassword($password);
        $user->activity = 0;
        $user->save();

        // $this->form->addOutput("Användare skapad.");
        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("user/login")->send();
    }
}
