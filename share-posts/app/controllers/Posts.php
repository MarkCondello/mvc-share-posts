<?php
class Posts extends Controller {
    public function __construct(){

        if(isLoggedIn()):
            $this->postModel = $this->model('post');
            $this->userModel = $this->model('user');

        else:
         //redirect if not logged in
            redirect("users/login");
        endif;
    }

    public function index(){
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts,
        ];
        $this->view('posts/index', $data);
    }

    public function add(){
         //check if form is submitting a post request
        if($_SERVER['REQUEST_METHOD'] == 'POST'):
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => '',
            ];

            if(empty($data['title'])):
                $data['title_error'] = "Please enter a title.";
            endif;

            if(empty($data['body'])):
                $data['body_error'] = "Please enter content for the post.";
            endif;
 
            //make sure there are no errors
            if(empty($data['title_error']) && empty($data['body_error']) && !empty($data['user_id'])):
                //add the title and body content and user if to the db
                 //$postAdded = $this->postModel->addPost($data['title'], $data['user_id'], $data['body']);
                if($this->postModel->addPost($data)):
                    flash('post_message', 'Post added');
                    redirect("posts/index");
                else:
                    die("There was a problem saving your post...");
                endif;
            else:
                //load the view with errors
 
                $this->view('posts/add', $data);
            endif;
        else:
            $data = [
                'title_error' => '',
                'body_error' => '',
            ];
            // load view
            $this->view('posts/add', $data);
        endif;
     }

    public function show($postId){
        $post = $this->postModel->getPostById($postId);
        $user = $this->userModel->getUserById($post->user_id);
        //not sure about the format to pass the data 
        $data = [
            'post' => $post,
            'user' => $user
        ];
        if($data['post']):
            $this->view('posts/show', $data);
        else:
            die("There were issues retrieving that post item.");
        endif;
    }

    public function delete($postId){
        if($_SERVER['REQUEST_METHOD'] == 'POST'):

            $post = $this->postModel->getPostById($postId);
            if($post->user_id != $_SESSION['user_id']):
                redirect('posts');
            endif;

            if($this->postModel->deletePost($postId)): 
                flash('post_message', 'Post removed');
                redirect("posts/index");
            else:
                die("Something went wrong");
            endif;
        else:
            redirect("posts/index");
        endif;
    }

    public function edit($postId){
        if($_SERVER['REQUEST_METHOD'] == 'POST'):
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //values need to be added to the $post index om $data array
            $data = [
                'post' => [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'post_id' => $postId,
                ],
          
                'title_error' => '',
                'body_error' => '',
            ];

            $post = $this->postModel->getPostById($postId);

            if($data['post']['title'] == $post->title):
                $data['title_error'] = "Please update the title.";
            endif;

            if( $data['post']['body'] == $post->body):
                $data['body_error'] = "Please update the content for the post.";
            endif;
 
            //make sure there are no errors
            if(empty($data['title_error']) && empty($data['body_error']) && !empty($data['post']['user_id'])):
                //add the title and body content and user if to the db
                 //$postAdded = $this->postModel->addPost($data['post']['title'], $data['post']['user_id'], $data['post']['body']);
                if($this->postModel->updatePost($data['post'])):
                     flash('post_updated', 'Post udpated...');
                    //redirect("posts/index");
                    $this->view('posts/edit', $data);

                else:
                    die("There were problems saving your post...");
                endif;
            else:
                //load the view with errors\
                $this->view('posts/edit', $data);
            endif;
        else:
            $post = $this->postModel->getPostById($postId);

            if($post->user_id != $_SESSION['user_id']):
                redirect('posts');
            endif;

            $data = [
                'post' => [
                    'title' => $post->title,
                    'body' => $post->body,
                    'user_id' => $post->user_id,
                    'post_id' => $postId,

                ],
                'title_error' => '',
                'body_error' => ''
            ];
    
            $this->view('posts/edit', $data);
        endif; 
    } 
}