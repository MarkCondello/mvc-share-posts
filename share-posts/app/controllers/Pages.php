<?php //Controller included in Bootstrap file, Pages is called in Core.php as a default controller
class Pages extends Controller{
    public function __construct(){
        // echo "This is pages controller.";
    }
    //this must be included with all controller classes as it is a default method set in Core.php as currentMethod
    public function index(){
        if(isLoggedIn()):
            redirect("/posts");
        endif;
        $data = [
            "title"=> "Share Posts",
            "description" => "Simple social network built with MVC PHP framework...",
            "link" => "https://github.com/ncofre98/traversymvc/blob/master/public/index.php"
         ];
        $this->view("pages/index", $data); //call view method from Controller class
    }
    //this is called from call_user_func_array
    //if there are no params, the about method will run
    public function about( $params = null ){
        $data = [
            "title"=> "About Us",
            "description" => "Lorem ipsum solem delor",
        ];
        $this->view("pages/about", $data);
        echo " with the about action. Params passed are: " . $params;
    } 
}