<?php require APPROOT . '/views/inc/header.php';?>
<a href="<?php echo URLROOT?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back to posts</a>
<br>
<h1 class="mb-4"><?php echo $data['post']->title;?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by: <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p><?php echo $data['post']->body; ?></p>

<?php if($data['post']->user_id == $_SESSION['user_id']):?>
<hr>
<a href="<?php echo URLROOT. "/posts/edit/" . $data['post']->id; ?>" class="btn btn-dark">Edit post</a>
<form action="<?php echo URLROOT . "/posts/delete/" . $data['post']->id; ?>" method="post" class="pull-right">
    <input type="submit" class="btn btn-danger" value="Delete post"/> 
</form>
<?php endif;?>

 <?php require APPROOT . '/views/inc/footer.php';?>