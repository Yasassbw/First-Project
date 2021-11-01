<?php
session_start();

include 'db.php';
include 'functions.php';

$conn = OpenCon();
$currentUser = checkLogin($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>


    <?php
    include './code/header.php';
    include './code/footer.php';
    ?>

</head>

<body>

<script src="js/validation.js"></script>
</body>
</html>







