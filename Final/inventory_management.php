<?php
session_start();
require('audit.php');

if (!isset($_SESSION['seller_logged_in']) || $_SESSION['seller_logged_in'] !== true) {
    header('Location: seller_login.php');
    exit;
}

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'db_product';

$conn = @new mysqli($host, $user, $password);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$conn->query('CREATE DATABASE IF NOT EXISTS db_product');
$conn->close();

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$conn->query("CREATE TABLE IF NOT EXISTS tbl_brand (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE)");
$conn->query("CREATE TABLE IF NOT EXISTS tbl_category (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE)");
$conn->query("CREATE TABLE IF NOT EXISTS tbl_subcategory (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE)");
$conn->query("CREATE TABLE IF NOT EXISTS tbl_product (
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

$ensureProductColumn = function($columnName, $definition) use ($conn) {
    $check = $conn->query("SHOW COLUMNS FROM tbl_product LIKE '$columnName'");
    if ($check && $check->num_rows === 0) {
        $conn->query("ALTER TABLE tbl_product ADD COLUMN $definition");
    }
};

$ensureProductColumn('description', 'description TEXT NULL');
$ensureProductColumn('specification', 'specification TEXT NULL');

$message = '';
$type = '';
$editProductId = isset($_POST['edit_product_id']) ? (int)$_POST['edit_product_id'] : (isset($_GET['edit']) ? (int)$_GET['edit'] : 0);
$editProduct = null;

if ($editProductId > 0) {
    $editResult = mysqli_query($conn, "SELECT * FROM tbl_product WHERE id = $editProductId LIMIT 1");
    if ($editResult && mysqli_num_rows($editResult) > 0) {
        $editProduct = mysqli_fetch_assoc($editResult);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'delete') {
        $productId = (int)($_POST['product_id'] ?? 0);
        if ($productId > 0) {
            $deleteSql = "DELETE FROM tbl_product WHERE id = $productId LIMIT 1";
            if (mysqli_query($conn, $deleteSql)) {
                logAuditAction($conn, $_SESSION['seller_id'] ?? 0, 'Remove Product');
                $message = 'Product deleted successfully.';
                $type = 'success';
            } else {
                $message = 'Unable to delete the product.';
                $type = 'danger';
            }
        } else {
            $message = 'Invalid product selection.';
            $type = 'danger';
        }
    } else {
        $metadataAction = $_POST['metadata_action'] ?? '';
        $metadataName = trim($_POST['metadata_name'] ?? '');

        if ($metadataAction !== '' && $metadataName !== '') {
            $table = '';
            $label = '';
            switch ($metadataAction) {
                case 'add_brand':
                    $table = 'tbl_brand';
                    $label = 'Brand';
                    break;
                case 'add_category':
                    $table = 'tbl_category';
                    $label = 'Category';
                    break;
                case 'add_subcategory':
                    $table = 'tbl_subcategory';
                    $label = 'Subcategory';
                    break;
            }

            if ($table !== '') {
                $nameEsc = mysqli_real_escape_string($conn, $metadataName);
                $insertSql = "INSERT IGNORE INTO $table (name) VALUES ('$nameEsc')";
                if (mysqli_query($conn, $insertSql)) {
                    logAuditAction($conn, $_SESSION['seller_id'] ?? 0, 'Add Product Metadata');
                    $message = $label . ' added successfully.';
                    $type = 'success';
                } else {
                    $message = 'Unable to add ' . strtolower($label) . '.';
                    $type = 'danger';
                }
            }
        } else {
            $action = $_POST['action'] ?? 'add';
            $productId = (int)($_POST['product_id'] ?? 0);
            $brandId = (int)($_POST['brand_id'] ?? 0);
            $categoryId = (int)($_POST['category_id'] ?? 0);
            $subcategoryId = (int)($_POST['subcategory_id'] ?? 0);
            $productName = trim($_POST['product_name'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $quantity = trim($_POST['quantity'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $specification = trim($_POST['specification'] ?? '');
            $productImage = $_FILES['product_image'] ?? null;

        if ($action === 'edit' && $productId > 0) {
            $existing = mysqli_query($conn, "SELECT * FROM tbl_product WHERE id = $productId LIMIT 1");
            $existingProduct = mysqli_fetch_assoc($existing);
            $newName = $productName;
            $newPrice = $price;
            $newQuantity = $quantity;
            $newDescription = $description;
            $newSpecification = $specification;

            $resolvedBrandId = $brandId > 0 ? $brandId : (int)($existingProduct['brand_id'] ?? 0);
            $resolvedCategoryId = $categoryId > 0 ? $categoryId : (int)($existingProduct['category_id'] ?? 0);
            $resolvedSubcategoryId = $subcategoryId > 0 ? $subcategoryId : (int)($existingProduct['subcategory_id'] ?? 0);

            $updates = [];
            if ($newName !== '' && $newName !== ($existingProduct['name'] ?? '')) { $updates[] = "name = '" . mysqli_real_escape_string($conn, $newName) . "'"; }
            if ($newPrice !== '' && $newPrice !== (string)($existingProduct['price'] ?? '')) { $updates[] = "price = '" . mysqli_real_escape_string($conn, $newPrice) . "'"; }
            if ($newQuantity !== '' && $newQuantity !== (string)($existingProduct['quantity'] ?? '')) { $updates[] = "quantity = " . (int)$newQuantity; }
            if (($newDescription !== ($existingProduct['description'] ?? '')) || ($newSpecification !== ($existingProduct['specification'] ?? ''))) {
                $updates[] = "description = '" . mysqli_real_escape_string($conn, $newDescription) . "'";
                $updates[] = "specification = '" . mysqli_real_escape_string($conn, $newSpecification) . "'";
            }
            if ($resolvedBrandId > 0 && $resolvedBrandId !== (int)($existingProduct['brand_id'] ?? 0)) { $updates[] = "brand_id = $resolvedBrandId"; }
            if ($resolvedCategoryId > 0 && $resolvedCategoryId !== (int)($existingProduct['category_id'] ?? 0)) { $updates[] = "category_id = $resolvedCategoryId"; }
            if ($resolvedSubcategoryId > 0 && $resolvedSubcategoryId !== (int)($existingProduct['subcategory_id'] ?? 0)) { $updates[] = "subcategory_id = $resolvedSubcategoryId"; }

            if ($productImage && $productImage['error'] === UPLOAD_ERR_OK) {
                $allowed = ['png', 'jpg', 'jpeg'];
                $ext = strtolower(pathinfo($productImage['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, $allowed, true)) {
                    $message = 'Only PNG, JPG, or JPEG files are allowed.';
                    $type = 'danger';
                } else {
                    $newImageName = $productId . '.' . $ext;
                    move_uploaded_file($productImage['tmp_name'], __DIR__ . '/images/products/' . $newImageName);
                    $updates[] = "image = '$newImageName'";
                }
            }

            if (!empty($updates)) {
                $sql = "UPDATE tbl_product SET " . implode(', ', $updates) . " WHERE id = $productId";
                mysqli_query($conn, $sql);
                logAuditAction($conn, $_SESSION['seller_id'] ?? 0, 'Modify Product');
                $message = 'Product updated successfully.';
                $type = 'success';
            } else {
                $message = 'No changes were made.';
                $type = 'info';
            }
        } else {
            $missingFields = [];
            if ($productName === '') $missingFields[] = 'Product Name';
            if ($price === '') $missingFields[] = 'Price';
            if ($quantity === '') $missingFields[] = 'Quantity';
            if ($brandId <= 0) $missingFields[] = 'Brand';
            if ($categoryId <= 0) $missingFields[] = 'Category';
            if (!isset($_FILES['product_image']) || $_FILES['product_image']['error'] !== UPLOAD_ERR_OK) $missingFields[] = 'Picture';

            if (!empty($missingFields)) {
                $message = 'Please fill in the following required fields: ' . implode(', ', $missingFields) . '.';
                $type = 'danger';
            } else {
                if (!preg_match('/^(?:\d+\.?\d*|\.\d+)$/', $price) || (float)$price < 0) {
                    $message = 'Price must be a non-negative number.';
                    $type = 'danger';
                } elseif (!preg_match('/^\d+$/', $quantity) || (int)$quantity < 0) {
                    $message = 'Quantity must be a non-negative whole number.';
                    $type = 'danger';
                } else {
                    $allowed = ['png', 'jpg', 'jpeg'];
                    $imageName = $_FILES['product_image']['name'];
                    $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
                    if (!in_array($ext, $allowed, true)) {
                        $message = 'Only PNG, JPG, or JPEG files are allowed.';
                        $type = 'danger';
                    } else {
                        $resolvedBrandId = $brandId > 0 ? $brandId : 0;
                        $resolvedCategoryId = $categoryId > 0 ? $categoryId : 0;
                        $resolvedSubcategoryId = $subcategoryId > 0 ? $subcategoryId : null;

                        $productNameEsc = mysqli_real_escape_string($conn, $productName);
                        $priceEsc = mysqli_real_escape_string($conn, $price);
                        $quantityEsc = (int)$quantity;
                        $descriptionEsc = mysqli_real_escape_string($conn, $description);
                        $specificationEsc = mysqli_real_escape_string($conn, $specification);
                        $sql = "INSERT INTO tbl_product (brand_id, category_id, subcategory_id, name, price, quantity, image, description, specification) VALUES ($resolvedBrandId, $resolvedCategoryId, " . ($resolvedSubcategoryId === null ? 'NULL' : $resolvedSubcategoryId) . ", '$productNameEsc', '$priceEsc', $quantityEsc, '', '$descriptionEsc', '$specificationEsc')";
                        if (mysqli_query($conn, $sql)) {
                            $productId = mysqli_insert_id($conn);
                            $dest = __DIR__ . '/images/products/' . $productId . '.' . $ext;
                            move_uploaded_file($_FILES['product_image']['tmp_name'], $dest);
                            $imageName = $productId . '.' . $ext;
                            mysqli_query($conn, "UPDATE tbl_product SET image = '$imageName' WHERE id = $productId");
                            logAuditAction($conn, $_SESSION['seller_id'] ?? 0, 'Add Product');
                            $message = 'Product saved successfully.';
                            $type = 'success';
                        } else {
                            $message = 'Unable to save the product.';
                            $type = 'danger';
                            }
                        }
                    }
                }
            }
        }
    }
}
$brands = mysqli_query($conn, 'SELECT id, name FROM tbl_brand ORDER BY name');
$categories = mysqli_query($conn, 'SELECT id, name FROM tbl_category ORDER BY name');
$subcategories = mysqli_query($conn, 'SELECT id, name FROM tbl_subcategory ORDER BY name');
$products = mysqli_query($conn, 'SELECT p.id, p.name, p.price, p.quantity, p.image, 
                    b.name AS brand_name, 
                    c.name AS category_name, 
                    s.name AS subcategory_name 
                FROM tbl_product p 
                LEFT JOIN tbl_brand b ON p.brand_id = b.id 
                LEFT JOIN tbl_category c ON p.category_id = c.id 
                LEFT JOIN tbl_subcategory s ON p.subcategory_id = s.id 
                ORDER BY p.id DESC');

require('seller_header.php');
?>

<div class="container py-4">
    <h2 class="mb-4">Inventory Management</h2>

    <?php if ($message): ?>
        <div class="alert alert-<?= $type; ?>" role="alert">
            <?= htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="h5">Manage Product Metadata</h4>
            <div class="row g-3">
                <div class="col-md-4">
                    <form method="post" class="d-flex flex-column gap-2">
                        <input type="hidden" name="metadata_action" value="add_brand">
                        <label class="form-label">Add Brand</label>
                        <input type="text" class="form-control" name="metadata_name" placeholder="Enter brand name" required>
                        <button type="submit" class="btn btn-outline-secondary">Save Brand</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form method="post" class="d-flex flex-column gap-2">
                        <input type="hidden" name="metadata_action" value="add_category">
                        <label class="form-label">Add Category</label>
                        <input type="text" class="form-control" name="metadata_name" placeholder="Enter category name" required>
                        <button type="submit" class="btn btn-outline-secondary">Save Category</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form method="post" class="d-flex flex-column gap-2">
                        <input type="hidden" name="metadata_action" value="add_subcategory">
                        <label class="form-label">Add Subcategory</label>
                        <input type="text" class="form-control" name="metadata_name" placeholder="Enter subcategory name" required>
                        <button type="submit" class="btn btn-outline-secondary">Save Subcategory</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="h5"><?= $editProduct ? 'Edit Product' : 'Add Product' ?></h4>
            <form method="post" enctype="multipart/form-data" class="row g-3">
                <?php if ($editProduct): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="product_id" value="<?= (int)$editProduct['id']; ?>">
                <?php else: ?>
                    <input type="hidden" name="action" value="add">
                <?php endif; ?>
                <div class="col-md-6">
                    <label class="form-label">Brand</label>
                    <select class="form-select" name="brand_id" required>
                        <option value="">Select Brand</option>
                        <?php while ($brand = mysqli_fetch_assoc($brands)): ?>
                            <option value="<?= (int)$brand['id']; ?>" <?= $editProduct && (int)$editProduct['brand_id'] === (int)$brand['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($brand['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category_id" required>
                        <option value="">Select Category</option>
                        <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                            <option value="<?= (int)$category['id']; ?>" <?= $editProduct && (int)$editProduct['category_id'] === (int)$category['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($category['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subcategory</label>
                    <select class="form-select" name="subcategory_id">
                        <option value="">Select Subcategory</option>
                        <?php while ($subcategory = mysqli_fetch_assoc($subcategories)): ?>
                            <option value="<?= (int)$subcategory['id']; ?>" <?= $editProduct && (int)$editProduct['subcategory_id'] === (int)$subcategory['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($subcategory['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" value="<?= htmlspecialchars($editProduct['name'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" id="priceField" value="<?= htmlspecialchars($editProduct['price'] ?? ''); ?>" required placeholder="0.00" oninput="validateNumericInput(this, true)">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Quantity</label>
                    <input type="text" class="form-control" name="quantity" id="quantityField" value="<?= htmlspecialchars($editProduct['quantity'] ?? ''); ?>" required placeholder="0" oninput="validateNumericInput(this, false)">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Optional description"><?= htmlspecialchars($editProduct['description'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Specification</label>
                    <textarea class="form-control" name="specification" rows="3" placeholder="Optional specification"><?= htmlspecialchars($editProduct['specification'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Picture</label>
                    <input type="file" class="form-control" name="product_image" accept=".png,.jpg,.jpeg" <?= $editProduct ? '' : 'required' ?>>
                </div>
                <div class="col-md-12">
                    <div id="numericWarning" class="alert alert-warning py-2 mb-0 d-none" role="alert"></div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary"><?= $editProduct ? 'Update Product' : 'Save Product' ?></button>
                    <?php if ($editProduct): ?>
                        <a href="inventory_management.php" class="btn btn-secondary ms-2">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="h5">Products</h4>
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = mysqli_fetch_assoc($products)): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['name']); ?></td>
                            <td><?= htmlspecialchars($product['brand_name'] ?? ''); ?></td>
                            <td><?= htmlspecialchars($product['category_name'] ?? ''); ?></td>
                            <td><?= htmlspecialchars($product['subcategory_name'] ?? ''); ?></td>
                            <td><?= htmlspecialchars($product['price']); ?></td>
                            <td><?= (int)$product['quantity']; ?></td>
                            <td>
                                <?php if (!empty($product['image'])): ?>
                                    <img src="images/products/<?= htmlspecialchars($product['image']); ?>" alt="Product image" style="max-height: 50px; width: auto;">
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <a href="inventory_management.php?edit=<?= (int)$product['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="post" class="d-inline-flex align-items-center gap-2" style="margin:0;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="product_id" value="<?= (int)$product['id']; ?>">
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-trigger">Delete</button>
                                        <div class="delete-confirm d-none border rounded p-2 bg-light">
                                            <div class="small mb-2 text-danger">Delete this product?</div>
                                            <button type="submit" class="btn btn-sm btn-danger">Continue to Delete</button>
                                            <button type="button" class="btn btn-sm btn-secondary cancel-delete">Cancel Action</button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-trigger').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const form = button.closest('form');
            const confirmBox = form ? form.querySelector('.delete-confirm') : null;
            if (confirmBox) {
                confirmBox.classList.remove('d-none');
            }
        });
    });

    document.querySelectorAll('.cancel-delete').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const form = button.closest('form');
            const confirmBox = form ? form.querySelector('.delete-confirm') : null;
            if (confirmBox) {
                confirmBox.classList.add('d-none');
            }
        });
    });
});

function showWarning(message) {
    const box = document.getElementById('numericWarning');
    if (!box) return;
    box.textContent = message;
    box.classList.remove('d-none');
    box.classList.remove('flash');
    void box.offsetWidth;
    box.classList.add('flash');
    setTimeout(() => box.classList.add('d-none'), 1400);
}

function validateNumericInput(input, allowDecimals) {
    const original = input.value;
    let value = original;
    if (allowDecimals) {
        value = value.replace(/[^0-9.]/g, '');
        const firstDot = value.indexOf('.');
        if (firstDot !== -1) {
            value = value.slice(0, firstDot + 1) + value.slice(firstDot + 1).replace(/\./g, '');
        }
    } else {
        value = value.replace(/\D/g, '');
    }
    value = value.replace(/-/g, '');
    if (original !== value || original.includes('-') || /[a-zA-Z]/.test(original)) {
        showWarning('Negative numbers and letters are not allowed.');
    }
    input.value = value;
}
</script>
<style>
.flash {
    animation: flashWarning 2s ease;
}
@keyframes flashWarning {
    0% { background-color: #fff3cd; }
    50% { background-color: #ffe082; }
    100% { background-color: #fff3cd; }
}
</style>

<?php require('footer.php'); ?>