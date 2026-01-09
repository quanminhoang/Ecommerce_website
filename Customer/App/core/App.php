<?php
class App
{
    protected $controller = 'HomeController';
    protected $action = 'sayHi';
    protected $params = [];

    function __construct()
    {
        $elementUrlBox = $this->handleUrl();

        // handle controller
        if (isset($elementUrlBox)) {
            if (file_exists('./App/controllers/' . $elementUrlBox[0] . 'Controller.php')) {
                $controller = ucfirst(strtolower($elementUrlBox[0])) . "Controller";   //handle str
                $this->controller = $controller;
                unset($elementUrlBox[0]); //remove elementUrlBox
            }
        }
        if (!empty($_SESSION['customer'])) {
            if ($this->controller == 'AuthController') {
                header('location:home');
            }
        }

        if (empty($_SESSION['customer'])) {
            if ($this->controller == 'OrderController') {
                header('location:/figure_store/customer/auth');
            }
        }
        require_once('./App/controllers/' . $this->controller . '.php');

        // handle action
        if (isset($elementUrlBox[1])) {
            if (method_exists($this->controller, $elementUrlBox[1])) {
                $this->action = $elementUrlBox[1];
            }
            unset($elementUrlBox[1]); //remove elementUrlBox
        }

        // handle param
        $this->params = $elementUrlBox ? array_values($elementUrlBox) : [];

        // Init Controller
        $controllerObject = new $this->controller;
        call_user_func_array([$controllerObject, $this->action], $this->params);
    }

    // handle Url
    function handleUrl()
    {
        if (isset($_REQUEST['url'])) {
            return explode('/', filter_var(trim($_REQUEST['url'], '/')));
        }
    }
}
