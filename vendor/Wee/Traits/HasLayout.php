<?php

namespace Wee\Traits;

/**
 * Template rendering with a master page
 */
trait HasLayout {

    protected $currentUser;

    /**
     * Renders a view
     *
     * @param string $view a valid directory/file.php pair in app/views/
     * @param mixed $params an array of variables to pass to the template
     */
    public function render($view, $params = array()) {
        $defaults = array('current_user' => $this->currentUser);
        $view = new \Wee\View($view, $params, $defaults);

        echo $view->getContent();
    }

}

