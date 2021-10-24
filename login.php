<?php include './index.php'?>
<form action="/action_page.php">
    <div class="container">
        <h1>Login</h1>
        <p>Please fill in this form to login.</p>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <button type="submit" class="registerbtn">Login</button>
    </div>

    <div class="container signin">
        <p>Forgot password? <a href="#">click here</a>.</p>
    </div>
</form>
