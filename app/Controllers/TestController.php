<?php

namespace Controllers;

class TestController extends \Wee\Controller {

    public function index() {
        $users = \Models\User::findAll();

        echo render('test/index', array('users'=> $users));
    }

    public function create() {
        $user = new \Models\User();
        $user->setUsername($_POST['username']);
        $user->setCreatedAt(new \DateTime());
        $user->insert();

        $this->redirect('test/index');
    }

    public function edit() {
        $user = \Models\User::findById($_GET["id"]);

        echo render('test/edit', array('user' => $user));
    }

    public function update() {
        $user = \Models\User::findById($_GET["id"]);
        $user->setUsername($_POST['username']);
        $user->update();

        echo render('test/edit', array('user' => $user));
    }
}

