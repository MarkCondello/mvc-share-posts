<?php
/*
* App Core Class
* Creates URL & loads core controller
* URL FORMAT - /controller/method/params
*/

class Core {
    protected $currentController = 'Pages'; //default controller
    protected $currentMethod = 'index'; //default method
    protected $params = [];

    public function __construct()
    {
        // print_r($this->getUrl());
        $url = $this->getUrl();
        //look in controllers for first index value from the index.php file
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')):
            //if the controller file exits set it as this->currentController
            $this->currentController = ucwords($url[0]);
            //Unset 0 index
            unset($url[0]);
        endif;

        //Require the contoller
        require_once '../app/controllers/'. $this->currentController . '.php';
        //Instantiate the contoller
        $this->currentController = new $this->currentController;
        //Check for second part of the url
        if(isset($url[1])):
            //check if method exists in controller
            if(method_exists($this->currentController, $url[1])):
                $this->currentMethod = $url[1];
                unset($url[1]);
             endif;
        endif;
        //https://www.php.net/manual/en/function.array-values.php
        //ternary to set params prop using array values
        $this->params = $url ? array_values($url) : [];
          //call a controller method with an array of params
        //https://www.php.net/manual/en/function.call-user-func-array.php
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])):
            //remove the last /
            $url = rtrim($_GET['url'], '/');
            //sanitize the url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //break the url into an array
            $url = explode('/', $url);
            return $url;
        endif;
    }
}