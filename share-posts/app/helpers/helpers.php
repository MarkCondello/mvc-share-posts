<?php  
function isLoggedIn(){
    if (isset($_SESSION['user_id'])):
        return true;
    else:
        return false;
    endif;
}

function redirect($page){
    header("location: ".URLROOT.'/'.$page);
}

//displays a message on redirect
// example - flash("Register error", 'You are not registered', 'alert alert-danger' );
session_start();
function flash($name = '', $message= '', $class = 'alert alert-success'){
    if (!empty($name)):
        //these settings for the message are defined in the controller
        //if a message is not included and is not in the current session
        if (!empty($message) && empty($_SESSION[$name])):
            if(!empty($_SESSION[$name]) ):
                unset($_SESSION[$name]);
            endif;
            if(!empty($_SESSION[$name . '_class']) ):
                unset($_SESSION[$name . '_class']);
            endif;
            //the name session value is set to the message value passed in param 2
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        //the output is defined in the view
        elseif (empty($message) && !empty($_SESSION[$name])) :
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">'. $_SESSION[$name] .'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . 'class']);
         endif;
    endif;
}