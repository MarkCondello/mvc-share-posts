<?php require APPROOT . '/views/inc/header.php';?>
<div class="row">
    <h1><?= $data['title']; ?></h1>
</div>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create an account</h2>
            <p>Please fill out this form to register with us</p>
            <form action="<?php echo URLROOT?>/users/register" method="post">
                <div class="form-group">
                    <label for="name">Name <sup>*</sup></label>
                    <input type="text" id="name" name="name" class="form-control form-control-lg is-invalid <?php echo !empty($data["name_error"]) ? 'is_valid' : ''; ?>" value="<?php echo $data['name']; ?>"/>
                    <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
                </div>
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
                <div class="form-group">
                    <label for="confirm_password">Confirm Password <sup>*</sup></label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg is-invalid <?php echo !empty($data["confirm_password_error"]) ? 'is_valid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>"/>
                    <span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                         <a class="btn btn-light btn-block" href="<?php echo URLROOT?>/users/login">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>