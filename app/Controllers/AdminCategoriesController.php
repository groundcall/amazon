<?php

namespace Controllers;

/**
 * The default controller
 */
class AdminCategoriesController extends \Wee\Controller {

    /**
     * The default action
     */
    public function index() {
        $this->render('users/homepage');
    }
}
