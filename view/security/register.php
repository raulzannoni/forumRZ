<div class="loginMain">

    <h1>Register</h1>

    <form action="index.php?ctrl=security&action=register" method="post">
        <label>Nickname</label>
        <input type="text" name="nickname" required />
        <br>
        <label>Email</label>
        <input type="text" name="mail" required />
        <br>
        <label>Password</label>
        <input type="password" name="password" id="password" required />
        <br>
        <label>Repeat password</label>
        <input type="password" name="passwordCheck" id="passwordCheck" required />
        <br>

        <input class="loginSubmit" type="submit" name="submit" value="Register" />
    </form>

    <p class="switchLoginForm">Already have an account?
        <a href="index.php?ctrl=security&action=loginForm">Click here</a>
    </p>


</div>