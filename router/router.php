<?php
namespace App;

class Router{
    /**
     * Роутер маршрутов к контроллерам, 
     * которые хранятся в /routes.php
     */
    public function __construct() {
        $this->find_path();
        $this->create_path();
        $this->findRoute();

    }
    private function find_path(){
        /**
         * Функция, разбивающая маршрут к веб-ресурсу 
         * на путь и гет-параметры.
         */
        $this->path = explode('?',strtolower(($_SERVER['REQUEST_URI'])))[0];
    }
    private function create_path()
    {
        /**
         * Функция создания пути до контроллера-обработчика
         */
        
        $this->type = explode('/',explode('?',$this->path)[0])[1];
        $this->routes = ['web'=>Routes::WEB,'api'=>Routes::API];
        if($this->type != 'api') $this->type = 'web';
    }
    protected function findRoute()
    {
        /**
         * Функция для определения маршрута 
         * и вызова контроллера-обработчика
         */
        if(!isset($this->routes[$this->type][$this->path])){
            http_response_code(404);
            die("Not found");
        }
        $route = $this->routes[$this->type][$this->path];
        $class = new $route['class']();
        $eval = $route['function'];
        $class->$eval();
        //call_user_func([$class,$eval]);
    }

}


?>
