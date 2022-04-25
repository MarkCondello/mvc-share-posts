<?php require APPROOT . '/views/inc/header.php';?>
<?php flash('post_updated'); ?>
<a href="<?php echo URLROOT?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back to posts</a>
<br>

<h1 class="mb-4">Edit Post</h1>
 
 <?php 
/*  echo "<pre>";
    print_r($data);
    echo "</pre>"; */
 ?>
<form action="<?php echo URLROOT . "/posts/edit/" . $data['post']['post_id']; ?>" method="post"  >

    <div class="form-group">
        <label for="title">Title <sup>*</sup></label>
        <input type="text" id="title" name="title" class="form-control form-control-lg is-invalid <?php echo !empty($data["title_error"]) ? 'is_valid' : ''; ?>"  value="<?php echo $data['post']['title'];?>" />
        <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
    </div>
    <div class="form-group">
        <label for="body">Body <sup>*</sup></label>
        <textarea id="body" name="body" class="form-control form-control-lg is-invalid <?php echo !empty($data["body_error"]) ? 'is_valid' : ''; ?>" ><?php echo $data['post']['body'];?></textarea>
        <span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
    </div>

     <input type="submit" class="btn btn-primary" value="Update post"/> 
</form>
 
 <?php require APPROOT . '/views/inc/footer.php';?>