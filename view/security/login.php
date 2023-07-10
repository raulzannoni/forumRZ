<div class="loginMain">
    <h1>Login</h1>
    <form action="index.php?ctrl=security&action=login" method="post">
        <label>Email</label>
        <input type="text" name="mail" required>
        <br>
        <label>Password</label>
        <input type="password" name="password" required>
        <br>
        <input class="loginSubmit" type="submit" name="submit" value="Login">
    </form>
    <p class="switchLoginForm">Not registered yet?
        <a href="index.php?ctrl=security&action=registerForm">Click here</a>
    </p>

</div>