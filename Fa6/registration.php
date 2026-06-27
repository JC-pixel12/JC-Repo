
<?php require('register.php'); ?>

<?php require('header.php'); ?>

    <div class="d-flex justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-2">Dog Registration Form</h2>
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
                    <form action="registration.php" method="post"  novalidate>
                        <div class="mb-3"><label for="" class="form-label">Dog Name</label>
                        <input type="text" name="dog_name" id="dog_name" class="form-control">
                        </div>
                        <div class="mb-3"><label for="" class="form-label">Breed</label>
                        <input type="text" name="breed" id="breed" class="form-control">
                        </div>
                        <div class="mb-3"><label for="" class="form-label">Age</label>
                        <input type="number" name="age" id="age" class="form-control">
                        </div>
                        <div class="mb-3"><label for="" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control">
                        </div>
                        <div class="mb-3"><label for="" class="form-label">Color</label>
                        <input type="text" name="color" id="color" class="form-control">
                        </div>
                        <div class="mb-3"><label for="" class="form-label">Height (ft)</label>
                        <input type="number" name="height" id="height" class="form-control">
                        </div>
                        <div class="mb-3"><label for="" class="form-label">Weight (kilos)</label>
                        <input type="number" name="weight" id="weight" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Register Dog</button>
                            <a href="dogview.php" class="btn btn-secondary">View Registered Dogs</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php require('footer.php'); ?>