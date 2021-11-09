<?php

include './code/header.php';
$conn = OpenCon();
$coursesList = getCoursesList($conn);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $del = mysqli_query($conn, "DELETE FROM courses WHERE id = '$id'");

    if ($del) {
        header("location:coursesList.php?session-error-message=Successfully deleted");
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
    <a href="courseRegistration.php">Add Course</a><br>
    <ul class="list-group">

        <table class="table table-dark">
            <thead>

            <?php
            if (is_array($coursesList) && count($coursesList)) {

                echo ' <tr>
                <th scope="col">Course Code</th>
                <th scope="col">Course Name</th>
                <th scope="col">Location</th>
                <th scope="col">Instructor</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>';

                foreach ($coursesList as $item => $value) {
                    echo '
        <tr>
                <td>' . $value['code'] . '</td>
                <td>' . $value['name'] . '</td>
                <td>' . $value['location'] . '</td>
                <td>' . $value['instructor'] . '</td>
                <td><a href="courseRegistration.php?edit=' . $value['id'] . '">Edit</a></td>
                <td><a href="coursesList.php?delete=' . $value['id'] . '" onclick="return confirm(`Are you sure you want to delete this record (' . $value['name'] . ')?`)">Delete</a></td>
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
