<?php

namespace Controllers;

class TestController extends \Wee\Controller {

    public function index() {
        echo render('test/index', array('hello'=> 'some variable'));
    }
}
