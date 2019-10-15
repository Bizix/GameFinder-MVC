<?php

if (isset($_SESSION['signinUsername'])) {
    $username = $_SESSION['signinUsername'];
}

// print_r($_SESSION);
if (isset($_COOKIE["username"])) {
    $username = $_COOKIE['username'];
}
// print_r($_COOKIE);
?>

<head>
    <link rel="stylesheet" href="./styles/modalMenu.css">
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
</head>



<ul class="nav navbar">
    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="#" onclick="document.getElementById('aboutus').style.display='block'"><i
                class="far fa-address-card"></i> About Us </a></li>
    <!-- <li><a href="#"><i class="fas fa-dice"></i> Game Tools</a></li> -->
    <?php
    if (!isset($_SESSION["id"]) and !isset($_SESSION["signinUsername"])) {
        echo
            '<li><a href="#" onclick="document.getElementById(`signUpAndIn`).style.display=`block`"><i class="fas fa-user-lock"></i> Sign In</a></li>';
    } else if (isset($_SESSION["signinUsername"]) and isset($_SESSION["id"])) {
        echo  '<div class ="dropdown">
            <button onclick= "dropDown()" class ="dropbtn"><i class="far fa-user-circle"></i>Profile</button>
            <div class = "profileMenu" id ="profileMenuContent">
                <li><a href="#">Favorites</a></li>
                <li><a href="index.php?action=myGames">My Games</a></li>
                <li><a href="index.php?action=memberAccount">Account</a></li>
                <li><a href="index.php?action=logout"/>LogOut</a></li>
            </div>
        </div>';
    }
    ?>
</ul>

<!-- About us modal -->
<?php
include("./view/aboutUsModal.php");
?>

<!-- signup/registration modal -->

<div class="modal" id="signUpAndIn">
    <div onclick="document.getElementById('signUpAndIn').style.display='none'" class="close">×</div>
    <div class="modalContent">
        <div class="head">
            <div id="signInTab" class="modalHeader">Sign In</div>
            <div id="signUpTab" class="modalHeader">Sign Up</div>
        </div>
        <div class="modalBody">
            <?php
            include("./view/signInModal.php");
            include("./view/signUpModal.php");
            ?>
        </div>
    </div>
</div>

<script src="./scripts/modalMenu.js"></script>