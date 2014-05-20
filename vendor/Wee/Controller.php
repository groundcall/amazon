<?php

namespace Wee;

/**
 * Controller base class
 */
class Controller {

    protected $currentUser;

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

    protected function getDefaultViewParameters() {
        return array('current_user' => $this->currentUser);
    }

    /**
     * Renders a view
     *
     * @param string $view a valid directory/file.php pair in app/views/
     * @param mixed $params an array of variables to pass to the template
     */
    public function render($view, $params = array()) {
        echo $this->getViewContent($view, $params);
    }

    public function getViewContent($view, $params = array()) {
        $view = new \Wee\View($view, $params, $this->getDefaultViewParameters());

        return $view->getContent();
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
     * Redirects to url
     *
     * @param string $url a valid url
     * @note this method will send a HTTP Location header and end the execution of the current request
     */
    public function redirectToUrl($url) {
        header("Location: $url");
        exit();
    }

    /**
     * Override this if you need custom processing before all the actions in this controller
     */
    protected function initialize() {
    }

}
