<?php
/*
 * Base controller
 * Loads model and view
*/
class Controller {
    //load model
    public function model($model){
        require_once '../app/models/' . $model . '.php'; //require model file
        return new $model(); //Instantiate model
    }
    //load view
    public function view($view, $data = []){
        if (file_exists('../app/views/' . $view . '.php')) { //check for view file
            require_once('../app/views/' . $view . '.php');
        } else { //view does not exist;
            die("View does not exist");
        }
    }
}