<?php

session_start();
if (isset($_SESSION['member_id'])) {
    unset($_SESSION['member_id']);
}

session_destroy();

header('Location: login.php');
