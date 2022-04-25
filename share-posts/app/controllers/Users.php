<?php
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('user');
    }
    public function register(){
        //check if form is submitting a post request
        if($_SERVER['REQUEST_METHOD'] == 'POST'):
            //serialise data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => $_POST,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];

            if(empty($data['name'])):
                $data['name_error'] = "Please enter your name.";
            endif;

            if(empty($data['email'])):
                $data['email_error'] = "Please enter an email address.";
            elseif($this->userModel->findUserByEmail($data['email'])):
                    $data['email_error'] = "Email is already taken...";
            endif;

            if(empty($data['password'])):
                $data['password_error'] = "Please enter a password.";
            elseif(strlen($data['password']) < 6):
                $data['password_error'] = "Password must be more than 6 characters.";
            endif;

            if(empty($data['confirm_password'])):
                $data['confirm_password_error'] = "Please confirm the password.";
            elseif($data['password'] != $data['confirm_password']):
                $data['confirm_password_error'] = "Passwords do not match.";
            endif;

            //make sure there are no errors
            if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])):
                //die("Form Validated");
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->register($data)):
                    flash('register_success', 'You are registered and can log in.');
                    redirect('users/login');
                else:
                    die("something went wrong.");
                endif;
            else:
                //load the view with errors
                $this->view('users/register', $data);
            endif;
        else:
            //load the form
            //create options for the form
            $data = [
                'title' => 'Registration form',
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];
            // load view
            $this->view('users/register', $data);
        endif;
    }

    public function login(){
        //check if form is submitting a post request
        if($_SERVER['REQUEST_METHOD'] == 'POST'):
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => "Login",
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            if(empty($data['email'])):
                $data['email_error'] = "Please enter an email address.";
            endif;

            if(empty($data['password'])):
                $data['password_error'] = "Please enter a password.";
            endif;

            //check for user/email
            if($this->userModel->findUserByEmail($data['email'])):
            //user found
            else:
                $data['email_error'] = "No user found";
            endif;
         
            //make sure there are no errors
            if(empty($data['email_error']) && empty($data['password_error'])):
                //check and set login user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser):
                    //create sessions for the logged in user
                    $this->createUserSession($loggedInUser);
                     
                else:
                    $data['password_error'] = "Password is incorrect";
                    $this->view('users/login', $data);

                endif;
             else:
                //load the view with errors
                $this->view('users/login', $data);
            endif;
        else:
            //load the form
            //create options for the form
            $data = [
                'title' => 'Login',
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
             ];
            // load view
        $this->view('users/login', $data);
        endif;
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        redirect('posts');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

}