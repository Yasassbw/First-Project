<?php
include './code/header.php';

$conn = OpenCon();

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT email FROM members WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        header('Location: registration.php?session-error-message=This email already exists. Try again.');
        exit;
    } else {
        $query1 = "INSERT INTO members (name, email, password) VALUES ('$name', '$email', '$password')";
        $result1 = mysqli_query($conn, $query1);
        header('Location: registration.php?session-success-message=Successfully Registered');
        exit;
    }
}
?>
<form name="student-registration-form" action="" method="post">
    <div class="container">
        <h1>Add Student</h1>
        <p>Please fill in this form to add a new student.</p><br>
        <span class="registration-error" id="registration-error"></span>
        <?php
        if (isset($_GET['session-success-message'])) {
            echo '<span class="success-msg">' . $_GET['session-success-message'] . '</span>';
        }
        if (isset($_GET['session-error-message'])) {
            echo '<span class="error-msg">' . $_GET['session-error-message'] . '</span>';
        }
        ?>

        <hr>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" id="name" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" id="email" required>

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="address" id="address" required>

        <label for="gender"><b>Gender</b></label><br>
        <input type="radio" id="male" name="gender" value="HTML" required>
        <label for="gender">Male</label><br>
        <input type="radio" id="female" name="gender" value="CSS" required>
        <label for="css">female</label><br><br>

        <label for="course"><b>Course</b></label>
        <select name="course" id="course" required>
            <option disabled>Choose one</option>
            <?php
            // A sample product array
            $products = array("Mobile", "Laptop", "Tablet", "Camera");

            // Iterating through the product array
            foreach ($products as $item) {
                echo "<option value='strtolower($item)'>$item</option>";
            }
            ?>
        </select>
        <hr>

        <button type="submit" class="registerbtn">Submit</button>
    </div>

</form>
