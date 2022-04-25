<?php require APPROOT . '/views/inc/header.php';?>
<a href="<?php echo URLROOT?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back 
</a>
<div class="card card-body bg-light mt-5">
    <h2>Add Post</h2>
    <p>Create a post with this form</p>
    <form action="<?php echo URLROOT ?>/posts/add" method="post">
        <div class="form-group">
            <label for="title">Title <sup>*</sup></label>
            <input type="text" id="title" name="title" class="form-control form-control-lg is-invalid <?php echo !empty($data["title_error"]) ? 'is_valid' : ''; ?>" />
            <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
        </div>
        <div class="form-group">
            <label for="body">Content <sup>*</sup></label>
            <textarea id="body" name="body" class="form-control form-control-lg is-invalid <?php echo !empty($data["body_error"]) ? 'is_valid' : ''; ?>" ></textarea>
            <span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
        </div>
        <input type="submit" value="Add Post" class="btn btn-success btn-block">
 
     </form>
</div>

 <?php require APPROOT . '/views/inc/footer.php';?>