<?php

namespace Wee;

class Controller {

    public function __construct() {
        $this->setup();
        $this->initialize();
    }

    private function setup() {
        session_start();
        date_default_timezone_set("UTC");
    }

    public function redirect($string) {
        $url = url($string);

        header( "Location: $url" ) ;
    }

    protected function initialize() { }
}
