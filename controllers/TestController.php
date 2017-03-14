<?php
namespace mvc\controllers;

/**
 * Class BookController
 * @package mvc\controllers
 */
class TestController
{

    public function actionIndex()
    {
        include $this->viewFile;
    }

}
