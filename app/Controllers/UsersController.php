<?php

namespace Controllers;

class UsersController extends \Wee\Controller {

    public function index() {
        $this->render('users/user_register', array('user' => null));
    }

    public function addUser() {
        $user = new \Models\User();
        if (!empty($_POST['data'])) {
            $user->updateAttributes($_POST['data']);
            $user->setEducation_id($_POST['data']['education']);
            $user->setActivation_key();
            if ($user->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->addUser($user);
                $user->setId($userDao->getLastInsertedUserId());
                $mail = new \Models\Email();
                $mail->sendActivationEmail($user);
                $this->showUserForm();
            } else {
                $this->render('users/user_register', array('user' => $user));
            }
        } else {
            $this->render('users/user_register', array('user' => $user));
        }
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
            $user = $userDao->getUserForLogin($userLogin);
            $_SESSION['id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['is_admin'] = $user->getRole_id();
            
             $cartDao = \Wee\DaoFactory::getDao('Cart');
             $cartDao->deactivateCartByUserId($user->getId());

//             if (!$cartDao->getCartByUserId($user->getId())){
             $cartDao->assignCartToUser();
//             }
//             else{
//                 $cartDao->deleteCartById($_SESSION['cart_id']);
//             }
             
             
            if ($user->getRole_id() == 1) {
                $this->redirect('admin_products/');
            } else {
                $this->redirect('products/');
            }
        } else {
            $this->render('users/user_login', array('userLogin' => $userLogin));
        }
    }

    public function logout() {
        $_SESSION['id'] = null;
        $_SESSION['username'] = null;
        $_SESSION['cart_id'] = null;
//        session_destroy();
        $this->redirect('products/');
    }

    public function forgotPassword() {
        $this->render('users/forgot_password');
    }

    public function confirmActivation() {
        if (isset($_GET['activation_key']) && isset($_GET['user_id'])) {
            $activation_key = $_GET['activation_key'];
            $user_id = $_GET['user_id'];
            $userDao = \Wee\DaoFactory::getDao('User');
            $userDao->activateUserByActivationKey($activation_key, $user_id);
        }
        $this->redirect('users/show_login_form');
    }

    public function resetPassword() {
        $resetPasswod = new \Models\ResetPasswordEmail();
        $resetPasswod->setEmail($_POST['email']);
        if ($resetPasswod->isValid()) {
            $userDao = \Wee\DaoFactory::getDao('User');
            $user = $userDao->getUserByEmailAddress($_POST['email']);
            $user->setActivation_key();
            $userDao->updateActivationKey($user);
            $mail = new \Models\Email();
            $mail->sendResetPasswordEmail($user);
            
        }
        $this->render('users/forgot_password', array('resetPassword' => $resetPasswod));
    }

    public function changePassword() {
        if (!empty($_GET['activation_key']) && !empty($_GET['user_id'])) {
            $_SESSION['activation_key'] = $_GET['activation_key'];
            $_SESSION['user_id'] = $_GET['user_id'];
            $this->render('users/reset_password');
        }
        $resetPassword = new \Models\ResetPassword();
        if (!empty($_POST['password'])) {
            $resetPassword->setPassword($_POST['password']);
            $resetPassword->setPassword2($_POST['password2']);
            if ($resetPassword->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->updatePassword($_SESSION['activation_key'], $_SESSION['user_id'], $resetPassword->getPassword());
                unset($_SESSION['activation_key']);
                $this->render('users/user_login');
            } else {
                $this->render('users/reset_password', array('resetPassword' => $resetPassword));
            }
        }
    }

}
