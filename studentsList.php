<?php

include './code/header.php';
$conn = OpenCon();
$studentsList = getStudentsList($conn);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $del = mysqli_query($conn, "DELETE FROM students WHERE id = '$id'");

    if ($del) {
        header("location:studentList.php?session-error-message=Successfully deleted");
        exit;
    } else {
        echo "Error deleting record";
    }
}
?>
<div class="container">
    <?php
    if (isset($_GET['session-success-message'])) {
        echo '<span class="success-msg">' . $_GET['session-success-message'] . '</span>';
    }
    if (isset($_GET['session-error-message'])) {
        echo '<span class="error-msg">' . $_GET['session-error-message'] . '</span>';
    }
    ?>
    <a href="studentRegistration.php">Add Student</a><br>
    <ul class="list-group">

        <table class="table table-dark">
            <thead>

            <?php
            if (is_array($studentsList) && count($studentsList)) {

                echo ' <tr>
                <th scope="col">Photo</th>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Course Code</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>';

                foreach ($studentsList as $item => $value) {

                    $courseID = $value['course_id'];
                    $courseCode = null;
                    $record = mysqli_query($conn, "SELECT code FROM courses WHERE id = '$courseID'");
                    if ($record) {
                        $n = mysqli_fetch_array($record);
                        $courseCode = $n['code'];
                    }

                    $photo = ($value['photo']) ? : './images/photo.jpeg';

                    echo '
        <tr>
                <th scope="row"><img src="' . $photo . '" width="80px" height="80px"></th>
                <td>' . $value['student_id'] . '</td>
                <td>' . $value['name'] . '</td>
                <td>' . $value['email'] . '</td>
                <td>' . $value['address'] . '</td>
                <td>' . $courseCode . '</td>
                <td><a href="studentRegistration.php?edit=' . $value['id'] . '">Edit</a></td>
                <td><a href="studentsList.php?delete=' . $value['id'] . '" onclick="return confirm(`Are you sure you want to delete this record (' . $value['name'] . ')?`)">Delete</a></td>
            </tr>
        ';
                }
            } else {
                echo '<p class="list-group-item d-flex justify-content-between align-items-center">No items found</p>';
            }

            ?>
            </tbody>
        </table>
    </ul>
</div>
