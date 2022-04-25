<?php 
class Post {
    public function __construct(){
        $this->db = new Database();
    }

    public function getPosts(){
        $this->db->query("SELECT *,
        posts.id as post_id,
        users.id as user_id,
        posts.created_at as post_created,
        users.created_at as user_created
        FROM posts
        INNER JOIN users
        ON posts.user_id = users.id
        ORDER BY posts.created_at DESC");
        $results = $this->db->resultset();
        return $results;
    }

    public function addPost($data){
        $this->db->query("INSERT INTO posts(title, user_id, body) VALUES(:title, :user_id, :body )");
        $this->db->bind(":title", $data['title']);
        $this->db->bind(":user_id", $data['user_id']);
        $this->db->bind(":body", $data['body']);
        if($this->db->execute()):
            return true;
        else:
            return false;
        endif;
    }

    public function getPostById($postId){
        $this->db->query("SELECT *
        FROM posts
        WHERE posts.id = :post_id");
        $this->db->bind(":post_id", $postId);
        //not sure if this is what to do
        if($this->db->single()):
            return $this->db->single();
        else:
            return false;
        endif;
    }

    public function deletePost($postId){
        $this->db->query("DELETE FROM posts WHERE posts.id = :post_id");
        $this->db->bind(":post_id", $postId);
        $this->db->execute();
    }

    public function updatePost($post){
        $this->db->query("UPDATE posts SET title = :title, body = :body WHERE id = :post_id AND user_id = :user_id");
        $this->db->bind(":title", $post['title']);
        $this->db->bind(":body", $post['body']);
        $this->db->bind(":post_id", $post['post_id']);
        $this->db->bind(":user_id", $post['user_id']);

        if($this->db->execute()):
           return $this->db->execute();
        else:
            return false;
        endif;
    }
}