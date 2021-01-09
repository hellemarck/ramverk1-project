<?php

namespace Mh\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Mh\User\User;

/**
 * Form to update an item.
 */
class UpdateUserForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
            ],
            [
                "userid" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->userid,
                ],

                "username" => [
                    "label" => "Användarnamn",
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->username,
                ],

                "email" => [
                    "label" => "E-post",
                    "type" => "text",
                    "value" => $user->email,
                ],

                "password-new" => [
                    "label" => "Nytt lösenord",
                    "type" => "password",
                ],

                "password-again" => [
                    "label"       => "Ange nytt lösenord igen",
                    "type"        => "password",
                    "validation" => [
                        "match" => "password-new"
                    ],
                ],

                "password-old" => [
                    "label" => "*Ange ditt nuvarande lösenord",
                    "validation" => ["not_empty"],
                    "type" => "password",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Spara",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "value"     => "Återställ",
                    "type"      => "reset",
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return User
     */
    public function getItemDetails($id) : object
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("userid", $id);
        return $user;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        // Get values from the submitted form
        $userid        = $this->form->value("userid");
        $username      = $this->form->value("username");
        $pwNew         = $this->form->value("password-new") ?? null;
        $pwAgain       = $this->form->value("password-again") ?? null;
        $pwOld         = $this->form->value("password-old");
        $email         = $this->form->value("email");

        // Check password matches
        if ($pwNew) {
            if ($pwNew !== $pwAgain) {
                $this->form->rememberValues();
                $this->form->addOutput("Lösenorden matchar inte, försök igen.");
                return false;
            }
        }

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("userid", $userid);
        $res = $user->verifyPassword($username, $pwOld);

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("Fel användarnamn eller lösenord.");
            return false;
        }

        // set new properties
        $user->username = $username;
        $user->email = $email;

        // if new password and given correctly - change
        if ($pwNew) {
            $user->setPassword($pwNew);
        }

        // save to database
        $user->save();
        return true;
    }


    // /**
    //  * Callback what to do if the form was successfully submitted, this
    //  * happen when the submit callback method returns true. This method
    //  * can/should be implemented by the subclass for a different behaviour.
    //  */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("user")->send();
    }



    // /**
    //  * Callback what to do if the form was unsuccessfully submitted, this
    //  * happen when the submit callback method returns false or if validation
    //  * fails. This method can/should be implemented by the subclass for a
    //  * different behaviour.
    //  */
    public function callbackFail()
    {
        $this->di->get("response")->redirectSelf()->send();
    }
}
