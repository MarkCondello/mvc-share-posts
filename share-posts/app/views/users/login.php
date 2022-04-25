<?php require APPROOT . '/views/inc/header.php';?>
<h1><?= $data['title']; ?></h1>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
        <?php flash('register_success');?>
            <h2>Login</h2>
            <p>Please fill your credentials to login.</p>
            <form action="<?php echo URLROOT?>/users/login" method="post">
                <div class="form-group">
                    <label for="email">Email <sup>*</sup></label>
                    <input type="text" id="email" name="email" class="form-control form-control-lg is-invalid <?php echo !empty($data["email_error"]) ? 'is_valid' : ''; ?>" value="<?php echo $data['email']; ?>"/>
                    <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password <sup>*</sup></label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg is-invalid <?php echo !empty($data["password_error"]) ? 'is_valid' : ''; ?>" value="<?php echo $data['password']; ?>"/>
                    <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                         <a class="btn btn-light btn-block" href="<?php echo URLROOT?>/users/register">No account? Register here.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>