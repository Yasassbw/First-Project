<?php include './index.php'; ?>

<form name="registration-form" action="server.php" method="post" onsubmit="return validateForm()">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p><br>
        <span class="registration-error" id="registration-error"></span>
            <?php
            if (isset($_GET['session-success-message'])) {
                echo '<span class="success-msg">'.$_GET['session-success-message'].'</span>';
            }
            if (isset($_GET['session-error-message'])) {
                echo '<span class="error-msg">'.$_GET['session-error-message'].'</span>';
            }
            ?>

        <hr>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" id="name" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" id="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password-repeat" id="psw-repeat" required>
        <hr>

        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="/login.php">Login</a>.</p>
    </div>
</form>

