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
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
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
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $this->render('admin/add_user', array('user' => null));
        }
        else {
            $this->redirect('products/');
        }
    }

    public function addUser() {
        $user = null;
        if (!empty($_POST['data']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $user = new \Models\User();
            $user->updateAttributes($_POST['data']);
            $user->setActivation_key();
            
            if ($user->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->addUser($user);
                $user->setId($userDao->getLastInsertedUserId());
                $mail = new \Models\Email();
                $mail->sendActivationEmail($user);
                $this->showUserForm();
            }
            else {
                $this->render('admin/add_user', array('user' => $user));
            }
        }
        else {
            $this->redirect('products/');
        }
    }

    public function deleteUser() {
        if (!empty($_POST['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $userDao = \Wee\DaoFactory::getDao('User');
            $userDao->deleteUser($_POST['user_id']);
            $this->redirect('admin_users');
        }
        else {
            $this->redirect('products/');
        }
    }

    public function showEditUser() {
        if (!empty($_GET['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $userDao = \Wee\DaoFactory::getDao('User');
            if (!$userDao->getUserById($_GET['user_id'])) {
                $this->redirect('admin_users/index');
            }
            $user = $userDao->getUserById($_GET['user_id']);
            $this->render('admin/edit_user', array('user' => $user));
        }
        else {
            $this->redirect('products/');
        }
    }

    public function editUser() {
        $user = null;
        if (!empty($_POST['data']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $userDao = \Wee\DaoFactory::getDao('User');

            
            $user = $userDao->getUserById($_POST['data']['id']);
            $user->updateAttributes($_POST['data']);
            
            if ($user->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->updateUser($user);
                $this->redirect('admin_users');
            }
            else {
                $this->render('admin/edit_user', array('user' => $user));
            }
        }
        else {
            $this->redirect('products/');
        }
    }
    
    public function activateUser() {
        if (!empty($_POST['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $userDao = \Wee\DaoFactory::getDao('User');
            $userDao->setUserActivity($_POST['user_id'], 1);
            $this->redirect('admin_users');
        }
        else {
            $this->redirect('products/');
        }
    }
    
    public function deactivateUser() {
        if (!empty($_POST['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $userDao = \Wee\DaoFactory::getDao('User');
            $userDao->setUserActivity($_POST['user_id'], 0);
            $this->redirect('admin_users');
        }
        else {
            $this->redirect('products/');
        }
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
}
