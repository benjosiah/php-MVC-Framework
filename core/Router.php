<?php
namespace app\core; 

class Router 
{
    protected array $routes = array();
    public Request $request;

    public function __construct($request) {
        $this->request = $request;
    }



    public function get($path, $callback){
        $this->routes['get'][$path]=$callback;
    }
    public function post($path, $callback){
        $this->routes['post'][$path]=$callback;
    }

    public function resolve(){
        $path= $this->request->getPath();
        $method= $this->request->getMethod();
        $callback= $this->routes[$method][$path] ?? null;
        if($callback === null){
            Application::$app->response->setStatusCode(404);
            return $this->renderView('404');

        }
        if (is_string($callback)){
            return $this->renderView($callback);
        }
        if (is_array($callback)){
            $callback[0]= new $callback[0]();
        }
       return call_user_func($callback);
    }

    public function renderView(string $callback, $params=[])
    {
        $layout=$this->layoutContent();
        $view= $this->viewContent($callback, $params);
        return str_replace('{{content}}', $view, $layout);

    }

    public function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR."/view/layout/main.php";
        return ob_get_clean();
    }
    public function viewContent($view, $params){
        foreach ($params as $key=>$value){
            $$key= $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/view/$view.php";
        return ob_get_clean();
    }




}