<?php

namespace Controllers;

/**
 * The default controller
 */
class DefaultController extends \Wee\Controller {

    /**
     * The default action
     */
    public function index() {
        $this->render('default/index');
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('products/'); 
    }
}
