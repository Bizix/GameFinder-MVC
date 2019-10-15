<?php 
$head=null;
ob_start(); ?>
<section class="firstSectionContainer">
    <div class="headerContainer">
        <?php include("menuBar.php"); ?>
    </div>
    <div class="searchBarContainer">
        <h2>Search for a game and have fun!</h2>
        <form action="index.php?action=searchResults" method="POST">
            <div class="searchField">
                <input type="text" class="searchBox" name="search" placeholder="What are you looking for?">
                <button type="submit" class=" btn searchButton"><i class="fas fa-search"></i></button>
            </div>
            <button type="submit" name="randomGame" value="randomGame" class="btn surpriseButton">Surprise me!</button>
            <!-- <button type="submit" class="btn otherButton">What?</button> -->
        </form>
    </div>
    <div class="saturnAnimation">
        <?php include("saturnAnimation.php") ?>
    </div>
    <div class="topFiveContainer">
        <div class="topFiveHeader">
            <h3>Top 5 games</h3>
        </div>
        <!-- include file of backend +
    do the while and include once-->
        <div class="topFiveContent">
            <?php
            $count = 0;
            while ($data = $games->fetch()) {
                include("smallcardgame.php");
                $count++;
            }
            ?>
        </div>
    </div>
    <div class="arrowsContainer">
        <div class="arrows">
            <a href="index.php#filterCatContainer"><span></span></a>
        </div>
    </div>
</section>
<section class="secondSectionContainer">
    <div id="filterCatContainer">
        <?php include("filterGamesCat.php"); ?>
    </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php require("template.php") ?>







