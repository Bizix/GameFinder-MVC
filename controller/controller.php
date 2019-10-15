<?php

require_once("model/GameManager.php");
require_once("model/UserManager.php");

function mainPage()
{
    $gameManager = new GameManager();
    $games = $gameManager->getTopFive();

    require("view/mainPage.php");
}

function searchResults($postParams)
{
    $gameManager = new GameManager();
    if (empty($postParams["filterCat"])) {
        $games = $gameManager->searchBackend($postParams);
        $checks = null;
    } else {
        $result = $gameManager->getResultsFromCat($postParams);
        $games = $result["db_result"];
        $checks =  $result["checks"];
       
    }
    $count = 0;
    require("view/searchGamesResults.php");
}

function  loadUserGames($userId) {
    $gameManager = new GameManager();
    $user_games = $gameManager->getUserGames($userId);

    require("view/myGames.php");
}

function addGame($postParams){
    $gameManager = new GameManager();
    $gameManager->addGame($postParams);
    header("Location:index.php?action=myGames");
}

function logOut() {
    $userManager = new UserManager();
    $userManager->logOut();
    header('Location: index.php');
}

function signIn($postParams) {
    $userManager = new UserManager();
    $location = $userManager->signIn($postParams);
    header($location); 
}

function signUp($postParams) {
    $userManager = new UserManager();
    $location = $userManager->signUp($postParams);
    header($location); 
}

function loadUserInfos($user_id) {
    $userManager = new UserManager();
    $user = $userManager->loadUserInfos($user_id);

    require("./view/memberAccount.php");
}

function uploadImgUser($user_id, $postParams, $files) {
    $userManager = new UserManager();
    $location = $userManager->uploadImgUser($user_id, $postParams, $files);

    header($location); 
}

function gameView($getParams){
    
    $gameManager = new GameManager();
    $gameManager->loadGame($getParams);
}

function ratingSystem($getParams){
    $gameManager = new GameManager();
    $ratings = $gameManager->getRatingsGame($getParams);

    $rate_bg    = $ratings['rate_bg'];
    $rate_value = $ratings['rate_value'];
    $rate_times = $ratings['rate_times'];
    $userRating = $ratings['userRating'];
    require("view/ratingView.php");
}
function  updateRatingGame($getParams) {
    $gameManager = new GameManager();
    $gameManager->updateRating($getParams);
    ratingSystem($getParams);
}
