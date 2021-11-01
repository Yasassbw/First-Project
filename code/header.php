<?php
session_start();
include 'db.php';
$conn = OpenCon();
include 'functions.php';
$currentUser = checkLogin($conn);


?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="css/main.css">

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Student Management System</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="<?php echo (getCurrentPage() == 'index.php' ? 'active' : '') ; ?>"><a href="index.php">Students</a></li>
            <li class="<?php echo (getCurrentPage() == 'coursesList.php' ? 'active' : '') ; ?>"><a href="coursesList.php">Courses</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

            <?php

            if (!empty($GLOBALS['currentUserName'])) {
                echo '
                <li><a href="#">' . $GLOBALS['currentUserName'] . '</a></li>
                <li><a href="logout.php">Logout</a></li>
                    ';
            } else {
                echo '<li><a href="./registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
            }
            ?>


        </ul>
    </div>
</nav>