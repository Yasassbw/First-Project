<?php

function checkLogin($con)
{
    if (isset($_SESSION['member_id'])) {
        $id = $_SESSION['member_id'];
        $query = "SELECT * FROM members WHERE id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $GLOBALS['currentUserName'] = $data['name'];
            return $data;
        }
    }

    header('Location: login.php');
    die;
}