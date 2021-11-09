<?php
include './code/header.php';

$conn = OpenCon();

$id = null;
$code = null;
$name = null;
$location = null;
$instructor = null;

$update = false;

if (isset($_POST['save']) && isset($_POST['code'], $_POST['name'], $_POST['location'], $_POST['instructor'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $instructor = $_POST['instructor'];

    $query = "SELECT code FROM courses WHERE code = '$code'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        header('Location: courseRegistration.php?session-error-message=This course is already exists. Try again.');
        exit;
    } else {
        $query1 = "INSERT INTO courses (code, name, location, instructor) VALUES ('$code', '$name' , '$location', '$instructor')";
        $result1 = mysqli_query($conn, $query1);
        header('Location: courseRegistration.php?session-success-message=Successfully added');
        exit;
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "SELECT * FROM courses WHERE id='$id'");

    if ($record) {
        $n = mysqli_fetch_array($record);
        $code = $n['code'];
        $name = $n['name'];
        $location = $n['location'];
        $instructor = $n['instructor'];
    }
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $instructor = $_POST['instructor'];

    mysqli_query($conn, "UPDATE courses SET name='$name', code='$code' , location='$location' , instructor='$instructor' WHERE id='$id'");
    header('Location: coursesList.php?session-success-message=Successfully updated');
}

?>
<form name="course-registration-form" action="" method="post">
    <div class="container">
        <h1>Add Course</h1>
        <p>Please fill in this form to add a new course.</p><br>
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

        <label for="code"><b>Course Code</b></label>
        <input type="text" placeholder="Enter Course Code" name="code" id="code" value="<?php echo $code ?>" required>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Course Name" name="name" id="name" value="<?php echo $name ?>" required>

        <label for="location"><b>Location</b></label>
        <input type="text" placeholder="Enter Location" name="location" id="location" value="<?php echo $location ?>" required>

        <label for="instructor"><b>Instructor</b></label>
        <input type="text" placeholder="Enter Instructor Name" name="instructor" id="instructor" value="<?php echo $instructor ?>" required>

        <hr>
        <?php if ($update == true): ?>
            <button type="submit" class="registerbtn" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button type="submit" name="save" class="registerbtn">Submit</button>
        <?php endif ?>

    </div>

</form>
