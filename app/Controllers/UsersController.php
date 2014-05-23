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
            $user->setEducation_id($_POST['data']['education']);
            $user->setActivation_key();
            if ($user->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->addUser($user);
                $title = 'Activate your account';
                $message = "Hello, " . $_POST['data']['firstname'] . " " .  $_POST['data']['lastname'] . " !\n"
                        . "To activate your account please access the following link: \n"
                        . $_SERVER["SERVER_NAME"] . "/users/confirm_activation?activation_key=" . $user->getActivation_key() . "\n"
                        . "This link is available for 24 hours and can be used only once.";
                $user->sendMailTo($title, $message);
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
    
    public function confirmActivation() {
        if (isset($_GET['activation_key'])) {
            $activation_key = $_GET['activation_key'];
            $userDao = \Wee\DaoFactory::getDao('User');
            $userDao->activateUserByActivationKey($activation_key);
        }
        $this->redirect('users/show_login_form');
    }
}
