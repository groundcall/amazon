<?php

namespace Wee;

class View {

    use \Helpers\ApplicationHelper;

    protected $extendedTemplate;
    protected $extendedVars;
    protected $template;
    protected $vars;

    public function __construct($template, $vars = array()) {
        $vars['view'] = $this;

        $this->template = $template;
        $this->vars = $vars;
    }

    public function extend($extendedTemplate, $vars = array()) {
        $vars['view'] = $this;

        $this->extendedTemplate = $extendedTemplate;
        $this->extendedVars = $vars;
    }

    public function render($template, $vars = array()) {
        $view = new View($template, $vars);
        echo $view->getContent();
    }

    public function getContent() {
        $content = $this->renderFile($this->template, $this->vars);
        return $this->getContentExtends($content);
    }

    private function getContentExtends($content) {
        if (isset($this->extendedTemplate)) {
            $this->extendedVars['content'] = $content;
            return $this->renderFile($this->extendedTemplate, $this->extendedVars);
        }

        return $content;
    }

    /**
     * Renders a view
     *
     * @param string $file a valid directory/file.php pair in app/views/
     * @param mixed $params an array of variables to pass to the template
     * @return string the rendered HTML
     */
    private function renderFile($file, $params = array(), $path = 'views') {
        $file .= '.php';

        $module = dirname($file);
        if (!strlen($module)) {
            throw new \Exception("$file needs a module name");
        }

        $dir = APP_DIR . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $module;

        $fileName = $dir . DIRECTORY_SEPARATOR . basename($file);
        if (!file_exists($fileName)) {
            throw new \Exception("Can't read file $fileName");
        }

        extract($params, EXTR_SKIP);
        ob_start();
        include $fileName;
        return ob_get_clean();
    }

}
