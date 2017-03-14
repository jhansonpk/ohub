<?php
namespace mvc\controllers;

/**
 * Class BookController
 * @package mvc\controllers
 */
class TestController extends Controller
{

    public function actionIndex()
    {
        return $this->render('/test/index', []);
    }

}
