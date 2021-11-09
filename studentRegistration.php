<?php
include './code/header.php';

$conn = OpenCon();
$coursesList = getCoursesList($conn);

$id = null;
$student_id = null;
$name = null;
$email = null;
$address = null;
$gender = null;
$course_id = null;

$update = false;

if (isset($_POST['save']) && isset($_POST['name'], $_POST['email'], $_POST['address'], $_POST['gender'], $_POST['course_id'], $_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $course_id = $_POST['course_id'];

    $query = "SELECT email FROM students WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        header('Location: studentRegistration.php?session-error-message=This email already exists. Try again.');
        exit;
    } else {
        $query1 = "INSERT INTO students (student_id, name, email, address, gender, course_id) VALUES ('$student_id', '$name' , '$email', '$address', '$gender', '$course_id')";
        $result1 = mysqli_query($conn, $query1);
        header('Location: studentRegistration.php?session-success-message=Successfully added');
        exit;
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "SELECT * FROM students WHERE id='$id'");

    if ($record) {
        $n = mysqli_fetch_array($record);
        $student_id = $n['student_id'];
        $name = $n['name'];
        $email = $n['email'];
        $address = $n['address'];
        $gender = $n['gender'];
        $course_id = $n['course_id'];
    }
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $course_id = $_POST['course_id'];

    mysqli_query($conn, "UPDATE students SET name='$name', email='$email', address='$address', gender='$gender', course_id='$course_id' WHERE id='$id'");
    $_SESSION['message'] = "Updated!";
    header('location: index.php?session-success-message=Successfully updated');
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

        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

        <label for="student_id"><b>Student ID</b></label>
        <input type="text" placeholder="Enter Student ID" name="student_id" id="student_id" value="<?php echo $student_id ?>" required>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" id="name" value="<?php echo $name ?>" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" id="email" value="<?php echo $email ?>" required>

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="address" id="address" value="<?php echo $address ?>" required>

        <label for="gender"><b>Gender</b></label><br>
        <input type="radio" id="male" name="gender" value="male" <?php if ($gender == 'male') echo 'checked="checked"'; ?> required>
        <label for="gender">Male</label><br>
        <input type="radio" id="female" name="gender" value="female" <?php if ($gender == 'female') echo 'checked="checked"'; ?> required>
        <label for="css">female</label><br><br>

        <label for="course_id"><b>Course</b></label>
        <select name="course_id" id="course_id" required>
            <option disabled>Choose one</option>
            <?php

            foreach ($coursesList as $item => $value) {
                echo "<option value='".$value['id']."'>".$value['name']."</option>";
            }
            ?>
        </select>
        <hr>
        <?php if ($update == true): ?>
            <button type="submit" class="registerbtn" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button type="submit" name="save" class="registerbtn">Submit</button>
        <?php endif ?>

    </div>

</form>
