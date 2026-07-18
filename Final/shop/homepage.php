<?php 
require('db.php');
require('header.php'); 

$conn_product->query("CREATE TABLE IF NOT EXISTS tbl_brand (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE)");
$conn_product->query("CREATE TABLE IF NOT EXISTS tbl_category (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE)");

$categoriesResult = mysqli_query($conn_product, 'SELECT id, name FROM tbl_category ORDER BY name');
$categories = [];
while ($row = mysqli_fetch_assoc($categoriesResult)) {
    $categories[] = $row;
}

$brandsResult = mysqli_query($conn_product, 'SELECT id, name FROM tbl_brand ORDER BY name');
$brands = [];
while ($row = mysqli_fetch_assoc($brandsResult)) {
    $brands[] = $row;
}
?>

<div class="container py-4">
    <section class="mb-4">
        <img src="../images/banner/Hero-banner-1.png" alt="TrailBlazer Music Hero Banner" 
            class="img-fluid w-90 rounded shadow-sm" 
            style="max-height: 500px; object-fit: cover; display: block; margin-left: auto; margin-right: auto;">
    </section>

    <section class="mb-5">
        <h2 class="fw-bold mb-3">Shop TrailBlazer Music</h2>
        <div class="d-flex flex-wrap gap-2">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <a href="shop/product_catalogue.php?category=<?= (int)$category['id']; ?>" class="btn btn-outline-dark">
                        <?= htmlspecialchars($category['name']); ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-muted">No categories are available yet.</div>
            <?php endif; ?>
        </div>
    </section>

    <section>
        <h2 class="fw-bold mb-3">Shop by Brand</h2>
        <div class="d-flex flex-wrap gap-2">
            <?php if (!empty($brands)): ?>
                <?php foreach ($brands as $brand): ?>
                    <a href="shop/product_catalogue.php?brand=<?= (int)$brand['id']; ?>" class="btn btn-outline-secondary">
                        <?= htmlspecialchars($brand['name']); ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-muted">No brands are available yet.</div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php require('../footer.php'); ?>
