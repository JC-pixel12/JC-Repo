<?php
require('login.php');
require('header.php'); 
?>

    <div class="d-flex justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-2">Log in Form</h2>
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
                    <form action="login_page.php" method="post">
                        <!-- Form fields will go here -->
                        <div class="mb-3"><label for="" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                                value="<?= htmlspecialchars($remembered_email); ?>" required>
                        </div>

                        <div class="mb-3"><label for="" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" 
                                value="<?= htmlspecialchars($remembered_password); ?>" required>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember_me" 
                                    id="remember_me" value="1" <?= $remember_checked ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="registration.php" class="btn btn-secondary">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>        
<?php require('../footer.php'); ?>