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
    
    public function showLoginForm() {
        $this->render('users/user_login', array('user' => null));
    }
    
    public function login() {
        $userDao = \Wee\DaoFactory::getDao('User');
        $userLogin = new \Models\UserLogin();
        $userLogin->setEmail($_POST['email']);
        $userLogin->setPassword($_POST['password']);
        if ($userLogin->isValid()) {
            $user = $userDao->getUserByEmailAndPassword($userLogin->getEmail(), $userLogin->getPassword());
            $_SESSION['id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['is_admin'] = $user->getRole_id();
            if ($user->getRole_id() == 1) {
                $this->redirect('admin_products/');
            }
            else {
                $this->redirect('products/');
            }
        }
        else {
            $this->render('users/user_login', array('userLogin' => $userLogin));
        }
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('products/');
    }
    
    public function forgotPassword() {
        $this->render('users/forgot_password');
    }
}
