<?php
session_start();
require('db.php');
require('header.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

    if ($action === 'add' && $productId > 0) {
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 0;
        }
        $_SESSION['cart'][$productId] += $quantity;
    } elseif ($action === 'update' && $productId > 0) {
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $quantity;
        }
    } elseif ($action === 'decrease' && $productId > 0) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = max(1, $_SESSION['cart'][$productId] - 1);
        }
    } elseif ($action === 'delete' && $productId > 0) {
        unset($_SESSION['cart'][$productId]);
    }

    header('Location: cart.php');
    exit();
}

$cartItems = [];
$subtotal = 0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(',',array_keys($_SESSION['cart']), );
    $sql = "SELECT p.id, p.name, p.price, p.image, b.name AS brand_name
        FROM tbl_product p
        LEFT JOIN tbl_brand b ON p.brand_id = b.id
        WHERE p.id IN ($ids)";
    $result = mysqli_query($conn_product, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $row['line_total'] = (float)$row['price'] * $row['quantity'];
        $subtotal += $row['line_total'];
        $cartItems[] = $row;
    }
}
$shipping = !empty($cartItems) ? 100 : 0;
$grandTotal = $subtotal + $shipping;
?>

<div class="row g-4">
    <div class="col-lg-8">
        <h2 class="mb-4">Your Cart</h2>
        <?php if (empty($cartItems)): ?>
            <div class="alert alert-info">Your cart is empty.</div>
        <?php else: ?>
            <div class="row g-3">
                <?php foreach ($cartItems as $item): ?>
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex flex-column flex-md-row align-items-md-center gap-3">
                                <?php $imagePath = !empty($item['image']) ? '../images/products/' . $item['image'] : '../images/products/default.png'; ?>
                                <img src="<?= htmlspecialchars($imagePath); ?>" alt="<?= htmlspecialchars($item['name']); ?>" class="img-fluid rounded" style="width: 120px; height: 120px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1"><?= htmlspecialchars($item['name']); ?></h5>
                                    <p class="text-muted mb-2">Brand: <?= htmlspecialchars($item['brand_name'] ?? 'Unknown'); ?></p>
                                    <p class="fw-bold mb-0">Unit Price: ₱<?= number_format((float)$item['price'], 2); ?></p>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <form action="cart.php" method="post" class="d-flex align-items-center gap-2">
                                        <input type="hidden" name="action" value="decrease">
                                        <input type="hidden" name="product_id" value="<?= (int)$item['id']; ?>">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                                    </form>
                                    <form action="cart.php" method="post" class="d-flex align-items-center gap-2">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="product_id" value="<?= (int)$item['id']; ?>">
                                        <input type="number" name="quantity" class="form-control" style="width: 80px;" min="1" value="<?= (int)$item['quantity']; ?>">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">Update</button>
                                    </form>
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="product_id" value="<?= (int)$item['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                                <div class="text-end" style="min-width: 120px;">
                                    <div class="fw-bold">Total</div>
                                    <div>₱<?= number_format((float)$item['line_total'], 2); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm sticky-top">
            <div class="card-body">
                <h4 class="h5 mb-3">Order Summary</h4>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <strong>₱<?= number_format((float)$subtotal, 2); ?></strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping</span>
                    <strong>₱<?= number_format((float)$shipping, 2); ?></strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span>Grand Total</span>
                    <strong>₱<?= number_format((float)$grandTotal, 2); ?></strong>
                </div>
                <a href="checkout.php" class="btn btn-primary w-100">Checkout</a>
            </div>
        </div>
    </div>
</div>

<?php require('../footer.php'); ?>