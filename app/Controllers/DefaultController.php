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

}
