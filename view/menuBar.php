<div class="headerContainer">
    <div class="catchFraseContainer">
        <?php if (!isset($_SESSION["id"]) and !isset($_SESSION["signinUsername"])) {
            echo '<h3>For all your gaming needs.</h3>';
        } else if (isset($_SESSION["id"]) and isset($_SESSION["signinUsername"])) {
            echo '<h3>Hello, ' . $_SESSION['signinUsername'] . '!</h3>';
        }
        ?>
    </div>
    <div class="headerContent">
        <div class="logoContainer"><a href="index.php"><img src="./images/10.png" alt=""></a></div>
        <nav class="navbarContainer">
            <?php include("./view/modalMenu.php"); ?>
        </nav>
    </div>
</div>