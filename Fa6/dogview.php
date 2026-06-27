<?php
require('fetch_dogs.php');
?>

<?php require('header.php'); ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lists of Dogs</h2>
            <a href="registration.php" class="btn btn-success">+ Register New Dog</a>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Breed</td>
                            <td>Age (years)</td>
                            <td>Address</td>
                            <td>Color</td>
                            <td>Height (ft)</td>
                            <td>Weight (kilos)</td> 
                            <td>Registration Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter=1;
                            while($row = mysqli_fetch_assoc($result)):
                        ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['breed'] ?></td>
                            <td><?= $row['age'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><?= $row['color'] ?></td>
                            <td><?= $row['height'] ?></td>
                            <td><?= $row['weight'] ?></td>
                            <td><?= $row['date_created'] ?></td>
                        </tr>    
                        <?php
                            endwhile;

                            if(mysqli_num_rows($result) == 0):
                        ?>

                        <tr>
                            <td colspan="9" class="text-center text-muted">No Dogs Registered</td>
                        </tr>
                        <?php
                            endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
<?php require('footer.php'); ?>