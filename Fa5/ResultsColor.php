
<?php
session_start();

if (isset($_POST['submit'])) {
    $_SESSION['colors'] = [
        $_POST['color1'],
        $_POST['color2'],
        $_POST['color3'],
        $_POST['color4'],
        $_POST['color5']
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Favorite Colors</title>
</head>
<body>

<h2>Your Favorite Colors</h2>

<?php
if (isset($_SESSION['colors'])) {
    $count = 1;

    foreach ($_SESSION['colors'] as $colorname) {
        echo "<p>Favorite Color $count: 
              <span style='color: $colorname; font-weight: bold;'>
              $colorname
              </span>
              </p>";
        $count++;
    }
} else {
    echo "No colors found.";
}
?>

</body>
</html>
