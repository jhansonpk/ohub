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
        $this->get_include_contents(__DIR__ ."/../views".$action.".php", $params);
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
            $content = ob_get_clean();
            require(__DIR__ . '/../views/layout/main.php');
        }
        return false;
    }

    protected function getIp()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        if($ipaddress != 'UNKNOWN')
        {
            return $ipaddress;
        }
        else return 0;
    }

}
