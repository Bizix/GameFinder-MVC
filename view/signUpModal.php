
<link rel="stylesheet" href="./styles/modalMenu.css">

<form id="signUp" class="myForm hidden" method="POST" action="index.php?action=signUpDbEntry">
    <div class="inputIcons">
        <i class="fa fa-user icon"></i>
        <input type="text" placeholder="Username" name="username" id="username">
        <span class="error"></span>
    </div>

    <div class="inputIcons">
        <i class="far fa-envelope"></i>
        <input type="text" placeholder="Email address" name="email" id="email">
        <span class="error"></span>
    </div>

    <div class="inputIcons">
        <i class="fas fa-key"></i>
        <input type="password" placeholder="Password" name="psw" class="pw" id="psw">
        <span class="error"></span>
        <div class="pwtoggle" id="pwtoggleSU"><i class="far fa-eye"></i></div>
    </div>

    <div class="inputIcons">
        <i class="fas fa-key visibility"></i>
        <input type="password" placeholder="Confirm Password" name="pswconfirm" class="pw" id="pswConfirm">
        <span class="error"></span>
        <div class="pwtoggle" id="pwtoggleConf"><i class="far fa-eye"></i></div>
    </div>

    <div class="clearfix">
        <input type="submit" class="signupbtn" name="signup" value="Sign Up" id="register">
        <button type="button" onclick="document.getElementById('signUpAndIn').style.display='none'" class="cancelbtn"
            id="signupCancel">Cancel</button>
    </div>

    <div id="terms">By creating an account you agree to our <a href="#">Terms & Privacy</a>.</div>
</form>