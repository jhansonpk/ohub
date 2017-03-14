<?php
namespace mvc;

/**
 * Class Application
 * @package mvc
 */
class Application
{
    // Rotas que são permitidas, key => controller, values => actions
    const ROUTE = [
        'test' => [
            'index',
        ]
    ];

    // arquivo da view que será carregado
    // /views/NOME_DO_CONTROLLER/NOME_DA_ACTION
    public $viewFile;

    // controle da action
    private function route()
    {
        $uri = explode("/", $_SERVER['REQUEST_URI']);

        $controllerRoute = $uri[1] ?? '';
        $actionRoute = $uri[2] ?? 'index';
        $idRoute = $uri[3] ?? NULL;

        if(array_key_exists($controllerRoute, $this::ROUTE) && in_array($actionRoute, $this::ROUTE[$controllerRoute]))
        {
            $class = "\\mvc\\controllers\\".ucwords(strtolower($controllerRoute))."Controller";
            $controller = new $class;
            $controller->viewFile = "../views/$controllerRoute/$actionRoute.php";
            $controller->{'action'.ucwords(strtolower($actionRoute))}($idRoute);
        }
        else
        {
            // caso a requisição não esteja em ROUTE, 404.
            header("HTTP/1.1 404 Not Found");
            include("../views/error/404.php");
        }

    }

    // inicia a aplicação
    public function run()
    {

        if ($_SERVER['REQUEST_URI'] != '/')
        {
            $this->route();
        }
        else
        {
            // chamada default
            $controller = new \mvc\controllers\TestController;
            $controller->viewFile = "../views/test/index.php";
            $controller->actionIndex();
        }
    }
}
