<?php
require('db.php');
require('header.php');

$conn_product->query("CREATE TABLE IF NOT EXISTS tbl_brand (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE)");
$conn_product->query("CREATE TABLE IF NOT EXISTS tbl_category (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE)");
$conn_product->query("CREATE TABLE IF NOT EXISTS tbl_subcategory (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE)");
$conn_product->query("CREATE TABLE IF NOT EXISTS tbl_product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand_id INT NOT NULL,
    category_id INT NOT NULL,
    subcategory_id INT DEFAULT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    image VARCHAR(255) NOT NULL,
    description TEXT NULL,
    specification TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;

if ($productId > 0) {
    $sql = "SELECT p.*, b.name AS brand_name, c.name AS category_name, s.name AS subcategory_name
        FROM tbl_product p
        LEFT JOIN tbl_brand b ON p.brand_id = b.id
        LEFT JOIN tbl_category c ON p.category_id = c.id
        LEFT JOIN tbl_subcategory s ON p.subcategory_id = s.id
        WHERE p.id = $productId LIMIT 1";
    $result = mysqli_query($conn_product, $sql);
    $product = mysqli_fetch_assoc($result);
}
?>

<div class="row g-4">
    <?php if (!$product): ?>
        <div class="col-12">
            <div class="alert alert-warning">The requested product could not be found.</div>
        </div>
    <?php else: ?>
        <div class="col-lg-5">
            <?php 
                $imagePath = !empty($product['image']) ? '../images/products/' . $product['image'] : '../images/products/default.png'; 
            ?>
            <img src="<?= htmlspecialchars($imagePath); ?>" class="img-fluid rounded shadow-sm w-100" alt="<?= htmlspecialchars($product['name']); ?>" style="max-height: 480px; object-fit: contain;">
        </div>
        <div class="col-lg-7">
            <h2 class="mb-3"><?= htmlspecialchars($product['name']); ?></h2>
            <div class="mb-3">
                <span class="badge bg-secondary me-2">Brand: <?= htmlspecialchars($product['brand_name'] ?? 'Unknown'); ?></span>
                <span class="badge bg-secondary me-2">Category: <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?></span>
                <span class="badge bg-secondary">Subcategory: <?= htmlspecialchars($product['subcategory_name'] ?? 'Uncategorized'); ?></span>
            </div>
            
            <p class="display-6 text-primary fw-bold">₱<?= number_format((float)$product['price'], 2); ?></p>
            
            <form action="cart.php" method="post" class="d-flex align-items-center gap-2 flex-wrap">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?= (int)$product['id']; ?>">
                <label class="form-label mb-0">Qty</label>
                <input type="number" name="quantity" class="form-control" style="max-width: 90px;" min="1" value="1">
                <button type="submit" class="btn btn-dark">Add to Cart</button>
            </form>            
            
            <br><br><br>

            <p class="lead"><?= nl2br(htmlspecialchars($product['description'] ?? 'No description available.')); ?></p>

            <div class="card border-0 bg-light p-3 mb-4">
                <h5 class="mb-3">Specifications</h5>
                <div class="text-muted">
                    <?= nl2br(htmlspecialchars($product['specification'] ?? 'No specifications available.')); ?>
                </div>
            </div>


        </div>
    <?php endif; ?>
</div>

<?php require('../footer.php'); ?>