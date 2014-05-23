<?php

namespace Controllers;

/**
 * The default controller
 */
class AdminUsersController extends \Wee\Controller {

    /**
     * The default action
     */
    public function index() {
        if (!empty($_SESSION) && $_SESSION['is_admin'] == 1) {
            $paginator = new \Models\Paginator();
            $userDao = \Wee\DaoFactory::getDao('User');
            $paginator->setCount($userDao->getUserCount());
            $paginator->setPerpage();
            if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
                $paginator->setCurrent($_GET['page']);
            }
            else {
                $paginator->setCurrent(1);
            }
            $paginator->setPages();
            $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
            $limit = $paginator->getPerpage();
            $users = $userDao->getAllUsers($start, $limit);
            $this->render('admin/list_users', array('users' => $users, 'paginator' => $paginator));
        }
        else {
            $this->redirect('products/');
        }
    }

    public function showUserForm() {
        $this->render('admin/add_user', array('user' => null));
    }

    public function addUser() {
        $user = null;
        if (!empty($_POST['data'])) {
            $user = new \Models\User();
            $user->updateAttributes($_POST['data']);
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
        $this->render('admin/add_user', array('user' => $user));
    }

    public function deleteUser() {
        $userDao = \Wee\DaoFactory::getDao('User');
        $userDao->deleteUser($_POST['user_id']);
        $this->redirect('admin_users');
    }

    public function showEditUser() {
        $userDao = \Wee\DaoFactory::getDao('User');
        if (!$userDao->getUserById($_GET['user_id'])){
          $this->redirect('admin_users/index');
        }
        $user = $userDao->getUserById($_GET['user_id']);
        $this->render('admin/edit_user', array('user' => $user));
    }

    public function editUser() {
        $user = null;
        if (!empty($_POST['data'])) {
            $userDao = \Wee\DaoFactory::getDao('User');

            
            $user = $userDao->getUserById($_POST['data']['id']);
            $user->updateAttributes($_POST['data']);
            
            if ($user->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->updateUser($user);
                $this->redirect('admin_users');
            }
        }
        $this->render('admin/edit_user', array('user' => $user));
    }
    
    public function activateUser() {
        $userDao = \Wee\DaoFactory::getDao('User');
        $userDao->setUserActivity($_POST['user_id'], 1);
        $this->redirect('admin_users');
    }
    
    public function deactivateUser() {
        $userDao = \Wee\DaoFactory::getDao('User');
        $userDao->setUserActivity($_POST['user_id'], 0);
        $this->redirect('admin_users');
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
