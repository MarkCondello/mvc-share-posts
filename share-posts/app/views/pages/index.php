<?php require APPROOT . '/views/inc/header.php';?>
<div class="jumbotron jumbotron-fluid">
   <div class="container text-center">
   <h1 class="display-3"><?= $data['title']; ?></h1>
   <p class="lead"><?= $data['description'];  ?></p>
   <small>
      <a href="<?= $data['link']; ?>" target="_blank">Code base reference</a>
   </small>
   </div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>