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
        $userPerPage = 2;
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $page = $_GET['page'];
        }
        else {
            $page = 1;
        }
        $start = ($page - 1) * $userPerPage;
        $limit = $userPerPage;
        $userDao = \Wee\DaoFactory::getDao('User');
        $users = $userDao->getAllUsers($start, $limit);
        $this->render('admin/list_users', array('users' => $users, 'page' => $page));
    }

    public function showUserForm() {
        $this->render('admin/add_user', array('user' => null));
    }

    public function addUser() {
        $user = null;
        if (!empty($_POST['data'])) {
            $user = new \Models\User();
            $user->updateAttributes($_POST['data']);

            $user->verifyPassword();
            $user->verifyPasswordsMatch();
            $user->emailNotExists();
            $user->userNotExists();

            if ($user->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->addUser($user);
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
        $user = $userDao->getUserById($_GET['user_id']);
        $this->render('admin/edit_user', array('user' => $user));
    }

    public function editUser() {
        $user = null;
        if (!empty($_POST['data'])) {
            $userDao = \Wee\DaoFactory::getDao('User');
            $old_user = $userDao->getUserById($_POST['data']['id']);
            $user = new \Models\User();
            $user->updateAttributes($_POST['data']);
            if ($user->getUsername() != $old_user->getUsername()) {
                $user->userNotExists();
            }
            if ($user->getEmail() != $old_user->getEmail()) {
                $user->emailNotExists();
            }
            if ($_POST['data']['password'] != '') {
                $user->verifyPassword();
                $user->verifyPasswordsMatch();
            }
            else {
                $user->setPassword($old_user->getPassword());
            }
            if ($user->isValid()) {
                $userDao = \Wee\DaoFactory::getDao('User');
                $userDao->updateUser($user);
                $this->redirect('admin_users');
            }
        }
        $this->render('admin/edit_user', array('user' => $user));
    }
    
    public function activateUser() {
        if (isset($_POST['activate'])) {
            $active = 1;
        }
        if (isset($_POST['deactivate'])) {
            $active = 0;
        }
        $userDao = \Wee\DaoFactory::getDao('User');
        $userDao->setUserActivity($_POST['user_id'], $active);
        $this->redirect('admin_users');
    }
}
