<?php
$conn = OpenCon();
$studentsList = getStudentsList($conn);
?>
<div class="container">
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
                <th scope="col">Course ID</th>
            </tr>
            </thead>
            <tbody>';

                foreach ($studentsList as $item => $value) {
                    echo '
        <tr>
                <th scope="row"><img src="" width="80px" height="80px"></th>
                <td>' . $value['student_id'] . '</td>
                <td>' . $value['name'] . '</td>
                <td>' . $value['email'] . '</td>
                <td>' . $value['address'] . '</td>
                <td>' . $value['course_id'] . '</td>
            </tr>
        ';
                }
            }else {
                echo '<p class="list-group-item d-flex justify-content-between align-items-center">No items found</p>';
            }

            ?>
            </tbody>
        </table>
    </ul>
</div>