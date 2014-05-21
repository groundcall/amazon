<?php

namespace Controllers;

class UsersController extends \Wee\Controller {
 
    public function index() {
         $this->render('users/user_register', array('user' => null));
    }
    
    public function addUser() {
        $user = null;
        if (!empty($_POST['data'])) {
            $user = new \Models\User();
            $user->updateAttributes($_POST['data']);

            if ($user->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->addUser($user);
                $this->showUserForm();
            }
        }
        $this->render('users/user_register', array('user' => $user));
    }
    
    public function showUserForm() {
        $this->render('users/user_register', array('user' => null));
    }
}
