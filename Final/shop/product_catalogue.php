<?php
require('db.php');
require('header.php');

// $host = 'localhost';
// $user = 'root';
// $password = '';
// $dbname = 'db_product';

// $conn = new mysqli($host, $user, $password, $dbname);
// if ($conn->connect_error) {
//     die('Connection failed: ' . $conn->connect_error);
// }

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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$sort = $_GET['sort'] ?? 'default';
$selectedCategoryId = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$selectedSubcategoryId = isset($_GET['subcategory']) ? (int)$_GET['subcategory'] : 0;
$selectedBrandId = isset($_GET['brand']) ? (int)$_GET['brand'] : 0;

$categoriesResult = mysqli_query($conn_product, 'SELECT id, name FROM tbl_category ORDER BY name');
$categories = [];
while ($row = mysqli_fetch_assoc($categoriesResult)) {
    $categories[] = $row;
}

$subcategoryOptions = [];
if ($selectedCategoryId > 0) {
    $subcategorySql = "SELECT DISTINCT s.id, s.name
        FROM tbl_product p
        LEFT JOIN tbl_subcategory s ON p.subcategory_id = s.id
        WHERE p.category_id = $selectedCategoryId AND s.id IS NOT NULL
        ORDER BY s.name";
} else {
    $subcategorySql = "SELECT DISTINCT s.id, s.name
        FROM tbl_product p
        LEFT JOIN tbl_subcategory s ON p.subcategory_id = s.id
        WHERE s.id IS NOT NULL
        ORDER BY s.name";
}
$subcategoryResult = mysqli_query($conn_product, $subcategorySql);
while ($row = mysqli_fetch_assoc($subcategoryResult)) {
    $subcategoryOptions[] = $row;
}

$brandOptions = [];
if ($selectedCategoryId > 0) {
    $brandSql = "SELECT DISTINCT b.id, b.name
        FROM tbl_product p
        LEFT JOIN tbl_brand b ON p.brand_id = b.id
        WHERE p.category_id = $selectedCategoryId AND b.id IS NOT NULL
        ORDER BY b.name";
} else {
    $brandSql = "SELECT DISTINCT b.id, b.name
        FROM tbl_product p
        LEFT JOIN tbl_brand b ON p.brand_id = b.id
        WHERE b.id IS NOT NULL
        ORDER BY b.name";
}
$brandResult = mysqli_query($conn_product, $brandSql);
while ($row = mysqli_fetch_assoc($brandResult)) {
    $brandOptions[] = $row;
}

$sql = "SELECT p.id, p.name, p.price, p.image, b.name AS brand_name, c.name AS category_name, s.name AS subcategory_name
    FROM tbl_product p
    LEFT JOIN tbl_brand b ON p.brand_id = b.id
    LEFT JOIN tbl_category c ON p.category_id = c.id
    LEFT JOIN tbl_subcategory s ON p.subcategory_id = s.id
    WHERE 1=1";

if ($selectedCategoryId > 0) {
    $sql .= " AND p.category_id = $selectedCategoryId";
}
if ($selectedSubcategoryId > 0) {
    $sql .= " AND p.subcategory_id = $selectedSubcategoryId";
}
if ($selectedBrandId > 0) {
    $sql .= " AND p.brand_id = $selectedBrandId";
}

switch ($sort) {
    case 'az':
        $sql .= ' ORDER BY p.name ASC';
        break;
    case 'za':
        $sql .= ' ORDER BY p.name DESC';
        break;
    case 'price_low':
        $sql .= ' ORDER BY p.price ASC';
        break;
    case 'price_high':
        $sql .= ' ORDER BY p.price DESC';
        break;
    default:
        $sql .= ' ORDER BY p.id DESC';
        break;
}

$productsResult = mysqli_query($conn_product, $sql);
$products = [];
while ($row = mysqli_fetch_assoc($productsResult)) {
    $products[] = $row;
}
?>
<div class="row g-4">
    <aside class="col-lg-3">
        <div class="card shadow-sm sticky-top">
            <div class="card-body">
                <h4 class="h5 mb-3">Filter Products</h4>
                <form method="get" class="d-grid gap-3">
                    <div>
                        <label class="form-label">Sort</label>
                        <select name="sort" class="form-select">
                            <option value="default" <?= $sort === 'default' ? 'selected' : ''; ?>>Default</option>
                            <option value="az" <?= $sort === 'az' ? 'selected' : ''; ?>>A to Z</option>
                            <option value="za" <?= $sort === 'za' ? 'selected' : ''; ?>>Z to A</option>
                            <option value="price_low" <?= $sort === 'price_low' ? 'selected' : ''; ?>>Lowest price first</option>
                            <option value="price_high" <?= $sort === 'price_high' ? 'selected' : ''; ?>>Highest price first</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= (int)$category['id']; ?>" <?= $selectedCategoryId === (int)$category['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Subcategory</label>
                        <select name="subcategory" class="form-select" onchange="this.form.submit()">
                            <option value="">All Subcategories</option>
                            <?php foreach ($subcategoryOptions as $subcategory): ?>
                                <option value="<?= (int)$subcategory['id']; ?>" <?= $selectedSubcategoryId === (int)$subcategory['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($subcategory['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Brand</label>
                        <select name="brand" class="form-select" onchange="this.form.submit()">
                            <option value="">All Brands</option>
                            <?php foreach ($brandOptions as $brand): ?>
                                <option value="<?= (int)$brand['id']; ?>" <?= $selectedBrandId === (int)$brand['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($brand['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                        <a href="product_catalogue.php" class="btn btn-outline-secondary btn-sm">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </aside>

    <section class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0">Product Catalogue</h2>
            <span class="text-muted">Showing <?= count($products); ?> product<?= count($products) === 1 ? '' : 's'; ?></span>
        </div>

        <?php if (empty($products)): ?>
            <div class="alert alert-info">No products are available for the selected filters.</div>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                <?php foreach ($products as $product): ?>
                    <div class="col">
                        <a href="product_showcase.php?id=<?= (int)$product['id']; ?>" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm">
                                <?php $imagePath = !empty($product['image']) ? '../images/products/' . $product['image'] : '../images/products/default.png'; ?>
                                <img src="<?= htmlspecialchars($imagePath); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>" style="height: 220px; object-fit: contain;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-2"><?= htmlspecialchars($product['name']); ?></h5>
                                    <p class="card-text text-muted mb-2">
                                        <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?>
                                        <?= !empty($product['subcategory_name']) ? ' / ' . htmlspecialchars($product['subcategory_name']) : ''; ?>
                                    </p>
                                    <div class="mt-auto">
                                        <p class="fw-bold mb-0">₱<?= number_format((float)$product['price'], 2); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php require('../footer.php'); ?>