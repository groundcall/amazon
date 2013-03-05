<?php

namespace Controllers;

class HelloController extends \Wee\Controller {

    protected function initialize() {

    }

    public function index() {
        $this->render('hello/index');
    }

    public function sayHello() {
        $this->render('hello/say', array('name' => $_POST['name']));
    }

    public function showRegistration() {
        $user = new \Models\User();
        $this->render('hello/registration', array('user' => $user));
    }

    public function register() {
        $user = new \Models\User();
        $user->updateAttributes($_POST['user']);

        if ($user->isValid()) {
            $this->render('hello/success', array('user' => $user));
        } else {
            $this->render('hello/register', array('user' => $user));
        }
    }
}

