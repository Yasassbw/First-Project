<?php

include 'db.php';

function isShowErrorMsg()
{
    echo 'This email already exists. Try again';
}

$conn = OpenCon();

if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    exit('Empty Field(s)');
}

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
    exit('Values empty');
}

if ($statement = $conn->prepare('SELECT id, password, name FROM members WHERE email = ? ')) {
    $statement->bind_param('s', $_POST['email']);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows > 0) {
        header('Location: registration.php?session-error-message=This email already exists. Try again.');
        exit;
    } else {
        if ($statement = $conn->prepare('INSERT INTO members (name, email, password) VALUES (?, ?, ?)')) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $statement->bind_param('sss', $_POST['name'], $_POST['email'], $password);
            $statement->execute();
            header('Location: registration.php?session-success-message=Successfully Registered');
            exit;
        } else {
            echo 'Something went wrong. Please try again later';
        }
    }
    $statement->close();
} else {
    echo 'Something went wrong. Please try again later';
}

$conn->close();

