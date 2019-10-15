<?php
if (isset($_GET['modal']) and $_GET['modal'] == 'success') {
    echo "<p class = 'success'> Your registration was successful. Now Sign in! </p>";
} else if (isset($_GET['modal']) and $_GET['modal'] == 'phperror') {
    echo "<p class='phperror'> Incorrect ID or password : Please try again.</p>";
} else if (isset($_GET['modal']) and $_GET['modal'] == 'signuperror') {
    echo "<p class = 'error'>Username or email already exists.</p>";
}
?>

<form id="signIn" class="myForm" method="POST" action="index.php?action=signinDbAccess">
    <div class="inputIcons">
        <i class="fa fa-user icon"></i>
        <input type="text" placeholder="Username" name="signinUsername" id="signinusername">
        <span class="error"></span>
    </div>

    <div class="inputIcons">
        <i class="fas fa-key"></i>
        <input type="password" placeholder="Password" name="signinpsw" class="pw" id="pwSignin">
        <span class="error"></span>
        <div class="pwtoggle" id="pwsignin"><i class="far fa-eye"></i></div>
    </div>

    <div class="signinOptions">
        <input type="checkbox" name="checkbox"> Remember me
        <p> Forgot your<a href="#" onclick="alert('Please contact us 010-5749-5648');"> password</a>?</p>
    </div>

    <div class="clearfix">
        <input type="submit" class="signupbtn" name="signin" value="Sign In" id="signinBtn">
        <button type="button" onclick="document.getElementById('signUpAndIn').style.display='none'" class="cancelbtn"
            id="signinCancel">Cancel</button>
    </div>

    <div class="mediaSignup">
        <div class="msInnertext">or</div>
        <div id="kakaoLoginButtonContainer">
            <a id="kakaoLogin" name="isKakao"><img src="./images/kLoginButton.png" /></a>
        </div>
    </div>

    <div id="signupLink">Don't have an account? <a href="#" onclick="document.querySelector('#signUpTab').click();">Sign
            up</a>.</div>

</form>