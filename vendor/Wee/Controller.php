<?php

namespace Wee;

/**
 * Controller base class
 */
class Controller {

    use \Wee\Traits\HasLayout;

    public function __construct() {
        $this->setup();
        $this->initialize();
    }

    /**
     * initialize session management
     *
     * @internal
     */
    private function setup() {
        session_start();
        date_default_timezone_set("UTC");
    }

    /**
     * Redirects to another action
     *
     * @param string $action a valid internal url
     * @param mexed $params an array of extra parameters to include in the url
     * @see url
     * @note this method will send a HTTP Location header and end the execution of the current request
     */
    public function redirect($action, $params = array()) {
        $url = url($action, $params);

        header("Location: $url");
        exit();
    }

    /**
     * Override this if you need custom processing before all the actions in this controller
     */
    protected function initialize() {
        
    }

}
