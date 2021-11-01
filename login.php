<?php
session_start();
include './code/header.php';
include 'db.php';

$conn = OpenCon();

if (isset($_POST['email'], $_POST['password'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM members WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        if ($userData['password'] === $password) {
            $_SESSION['member_id'] = $userData['id'];
            header('Location: index.php');
            exit;
        } else {
            header('Location: login.php?session-error-message=Please enter valid information. Try again.');
        }
    } else {
        header('Location: login.php?session-error-message=Please enter valid information. Try again.');
    }

    $conn->close();
}
?>

<form action="" method="post">
    <div class="container">
        <h1>Login</h1>
        <p>Please fill in this form to login.</p>

        <?php
        if (isset($_GET['session-success-message'])) {
            echo '<span class="success-msg">' . $_GET['session-success-message'] . '</span>';
        }
        if (isset($_GET['session-error-message'])) {
            echo '<span class="error-msg">' . $_GET['session-error-message'] . '</span>';
        }
        ?>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>

        <button type="submit" class="registerbtn">Login</button>
    </div>

    <div class="container signin">
        <p>Forgot password? <a href="#">click here</a>.</p>
    </div>
</form>
