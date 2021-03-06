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
        }else {
            return [];
        }
    }else {
        return [];
    }

    header('Location: login.php');
    exit;
}

function getCurrentPage()
{
    return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function getStudentsList($con)
{
    $data = [];
    $query = "SELECT * FROM students";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return $data;
    }else {
        return [];
    }
}

function getCoursesList($con)
{
    $data = [];
    $query = "SELECT * FROM courses";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return $data;
    }else {
        return [];
    }
}