<?php ob_start(); ?>
    <link rel="stylesheet" href="styles/cardGame.css">
    <link type="text/css" rel="stylesheet" href="styles/rating.css">
<?php $head = ob_get_clean(); ?>

<?php ob_start(); ?>
<section class="firstSectionContainer">
    <?php include("menuBar.php"); ?>
</section>

<section class="secondSectionContainer">
    <div id="filterCatContainer">
        <?php include("filterGamesCat.php"); ?>
    </div>
</section>

<section class="sectionCont">
    <?php
    while ($data = $games->fetch()) {
        include('cardGame.php');
    }
    ?>
</section>
<?php $content = ob_get_clean(); ?>
<?php require("template.php") ?>