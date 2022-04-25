<?php require APPROOT . '/views/inc/header.php';?>
<?php flash('post_message');?>
<div class="row">
    <div class="col-md-6">
        <h1 class="mb-4">Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i>Add Post
        </a> 
    </div>

    <?php 
/*         echo "<pre>";
        print_r($data);
        echo "</pre>"; */
    ?>
    <div class="col-md-10 mx-auto">
        <?php foreach($data['posts'] as $post):?>
         <div class="card card-body bg-light mb-3">
            <h4 class="card-title"><?php echo $post->title; ?></h4>
            <div class="bg-light p-2 mb-3">
                Written by: <?php echo $post->name; ?> on <?php echo $post->post_created; ?>
            </div>
            <p class="card-body"><?php echo $post->body; ?></p>
            <a href="<?php echo URLROOT . "/posts/show/" . $post->post_id?>" class="btn btn-dark">More</a>

         </div>
         <?php endforeach; ?>
    </div>

</div>
 <?php require APPROOT . '/views/inc/footer.php';?>