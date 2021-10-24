<?php include './index.php'?>
<form name="registration-form" action="/action_page.php" onsubmit="return validateForm()" >
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p><br>
        <span class="registration-error" id="registration-error"></span>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" id="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password-repeat" id="psw-repeat" required>
        <hr>

        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="/login.php">Login</a>.</p>
    </div>
</form>