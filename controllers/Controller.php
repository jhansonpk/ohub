<?php
namespace mvc\controllers;

/**
 * Class BookController
 * @package mvc\controllers
 */
class Controller
{

    /**
     * @param $action
     * @param $params
     */
    public function render($action, $params = [])
    {
        $content = $this->get_include_contents(__DIR__ ."/../views".$action.".php", $params);
        require(__DIR__ . '/../views/layout/main.php');
    }

    /**
     * @param $filename
     * @param $params
     * @return bool|string
     */
    private function get_include_contents($filename, $params) {
        if (is_file($filename)) {
            ob_start();

            foreach ($params as $key => $value)
            {
                $$key = $value;
            }

            include $filename;
            return ob_get_clean();
        }
        return false;
    }

}
