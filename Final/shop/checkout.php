<?php
require('db.php');
require('header.php');

// $host = 'localhost';
// $user = 'root';
// $password = '';
// $dbname = 'db_product';

// $productConn = new mysqli($host, $user, $password, $dbname);
// if ($productConn->connect_error) {
//     die('Connection failed: ' . $productConn->connect_error);
// }

// $userHost = 'localhost';
// $userUser = 'root';
// $userPassword = '';
// $userDbname = 'db_user_profile';

// $userConn = new mysqli($userHost, $userUser, $userPassword, $userDbname);
// if ($userConn->connect_error) {
//     die('Connection failed: ' . $userConn->connect_error);
// }

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cartItems = [];
$subtotal = 0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
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

$billingFirstName = '';
$billingLastName = '';
$billingAddress = '';
$billingPhone = '';
$billingEmail = '';

if (!empty($_SESSION['username'])) {
    $currentEmail = mysqli_real_escape_string($conn_name, $_SESSION['username']);
    $profileSql = "SELECT first_name, last_name, address, contact, email FROM tbl_customer_profile WHERE email = '$currentEmail' LIMIT 1";
    $profileResult = mysqli_query($conn_name, $profileSql);
    if ($profileResult && mysqli_num_rows($profileResult) > 0) {
        $profile = mysqli_fetch_assoc($profileResult);
        $billingFirstName = $profile['first_name'] ?? '';
        $billingLastName = $profile['last_name'] ?? '';
        $billingAddress = $profile['address'] ?? '';
        $billingPhone = $profile['contact'] ?? '';
        $billingEmail = $profile['email'] ?? '';
    }
}
?>

<form method="post" class="row g-4">
    <div class="col-lg-8">
        <h2 class="mb-4">Checkout</h2>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="h5 mb-3">Order Items</h4>
                <?php if (empty($cartItems)): ?>
                    <div class="alert alert-info">Your cart is empty. Add items before checking out.</div>
                <?php else: ?>
                    <div class="row g-3">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-3 border rounded p-3">
                                    <?php $imagePath = !empty($item['image']) ? '../images/products/' . $item['image'] : '../images/products/default.png'; ?>
                                    <img src="<?= htmlspecialchars($imagePath); ?>" alt="<?= htmlspecialchars($item['name']); ?>" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1"><?= htmlspecialchars($item['name']); ?></h6>
                                        <div class="text-muted small">Price: ₱<?= number_format((float)$item['price'], 2); ?></div>
                                        <div class="text-muted small">Qty: <?= (int)$item['quantity']; ?></div>
                                    </div>
                                    <div class="fw-bold">₱<?= number_format((float)$item['line_total'], 2); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="h5 mb-3">Billing Address</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="billing_first_name" value="<?= htmlspecialchars($billingFirstName); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="billing_last_name" value="<?= htmlspecialchars($billingLastName); ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="billing_address" value="<?= htmlspecialchars($billingAddress); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="billing_phone" value="<?= htmlspecialchars($billingPhone); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="billing_email" value="<?= htmlspecialchars($billingEmail); ?>" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="h5 mb-3">Shipping Address</h4>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="same_as_billing" name="same_as_billing" checked>
                    <label class="form-check-label" for="same_as_billing">Shipping address is the same as billing address</label>
                </div>
                <div id="shipping-fields" style="display:none;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="shipping_first_name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="shipping_last_name">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="shipping_address">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="shipping_phone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="shipping_email">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="h5 mb-3">Payment Method</h4>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked disabled>
                    <label class="form-check-label text-muted" for="cod">Cash on Delivery</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" checked>
                    <label class="form-check-label" for="card">Credit / Debit Card</label>
                </div>
                <div class="alert alert-warning mt-3 mb-0">
                    Cash on delivery is only available if the shipping address is the same as the billing address.
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm sticky-top">
            <div class="card-body">
                <h4 class="h5 mb-3">Order Total</h4>
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
                <button type="submit" class="btn btn-primary w-100">Pay</button>
            </div>
        </div>
    </div>
</form>

<script>
    const sameAsBilling = document.getElementById('same_as_billing');
    const shippingFields = document.getElementById('shipping-fields');
    const codRadio = document.getElementById('cod');
    const cardRadio = document.getElementById('card');
    const codLabel = document.querySelector('label[for="cod"]');

    function updatePaymentOptions() {
        const enabled = sameAsBilling && sameAsBilling.checked;
        if (codRadio) {
            codRadio.disabled = !enabled;
        }
        if (codLabel) {
            codLabel.className = enabled ? 'form-check-label' : 'form-check-label text-muted';
        }
        if (!enabled && codRadio && codRadio.checked) {
            cardRadio.checked = true;
        }
    }

    if (sameAsBilling) {
        sameAsBilling.addEventListener('change', function () {
            shippingFields.style.display = this.checked ? 'none' : 'block';
            updatePaymentOptions();
        });
    }

    updatePaymentOptions();
</script>

<?php require('../footer.php'); ?>