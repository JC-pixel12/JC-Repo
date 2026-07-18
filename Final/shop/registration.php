<?php 
session_start();
require('db.php');
require('register.php');
?>

<?php require('header.php'); ?>


    <div class="d-flex justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-2">Registration Form</h2>
            <?php 
            if($message): 
            ?>
                <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                    <?= $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php 
            endif; 
            ?>
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="registration.php" method="post">
                        <!-- Form fields will go here -->
                        <div class="mb-3"><label for="" class="form-label">First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" required>
                        </div>
                        
                        <div class="mb-3"><label for="" class="form-label">Middle Name</label>
                        <input type="text" name="mname" id="mname" class="form-control">
                        </div>

                        <div class="mb-3"><label for="" class="form-label">Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" required>
                        </div>

                        <div class="mb-3"><label for="" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3"><label for="" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3"><label for="" class="form-label">Confirm Password</label>
                        <input type="password" name="cpassword" id="cpassword" class="form-control" required>
                        </div>

                        <div class="mb-3"><label for="" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                        </div>

                        <div class="mb-3"><label for="" class="form-label">Contact Number</label>
                        <input type="number" name="contact" id="contact" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="login_page.php" class="btn btn-secondary">Log in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php require('../footer.php'); ?>
