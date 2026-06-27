<?php
require('db.php');

$sql = "SELECT * FROM tbldog ORDER BY id";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>