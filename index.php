<?php
session_start();
?>

<?php
require("controller/controller.php");

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'mainPage') {
            mainPage();
        } 
        elseif ($_GET['action'] == 'searchResults') {
            searchResults($_POST);
        }  elseif ($_GET['action'] == 'myGames') {
                loadUserGames( $_SESSION["id"]);
        } 
        elseif ($_GET['action'] == 'addGame') {
            addGame($_POST);
        }elseif ($_GET['action'] == 'logout') {
            logOut();
        } 
        elseif ($_GET['action'] == 'signinDbAccess') {
            signIn($_POST);
        }
        elseif ($_GET['action'] == 'signUpDbEntry') {
            signUp($_POST);
        }
        elseif ($_GET['action'] == 'memberAccount') {
            loadUserInfos($_SESSION["id"]);
        }
        elseif ($_GET['action'] == 'uploadImgUser') {
            uploadImgUser($_SESSION["id"], $_POST, $_FILES);
        }
        elseif ($_GET['action'] == 'gameView') {
            gameView($_GET);
        }
        elseif ($_GET['action'] == 'rating') {
            ratingSystem($_GET);
        }
        elseif ($_GET['action'] == 'updateRating') {
            updateRatingGame($_GET);
        }
    } else {
        mainPage();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    print_r($errorMessage);
    // require('view/errorView.php');
}