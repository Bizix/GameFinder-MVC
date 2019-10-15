<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,700,700i&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7fdeb94f09.js"></script>

    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/saturnAnimation.css">
    <script defer src="scripts/playerslider.js"></script>

    <link type="text/css" rel="stylesheet" href="styles/rating.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?= $head ?>
    <title>Gamefinder</title>
</head>

<body>
    <div class="mainContainer">
    <?= $content ?>
    <?php include("footer.php"); ?>
    </div>
    <?php
    if (isset($_GET["modal"]) and $_GET["modal"] == "success") {
        ?>
    <script>
    var openAgain = document.querySelector("ul.navbar");
    let anchorTag = openAgain.lastElementChild.firstElementChild;
    anchorTag.click();
    </script>
    <?php
    } else if (isset($_GET["modal"]) and $_GET["modal"] == "phperror") {
        ?>
    <script>
    var openAgainError = document.querySelector("ul.navbar");
    let anchorTagError = openAgainError.lastElementChild.firstElementChild;
    anchorTagError.click();
    </script>
    <?php
    } else if (isset($_GET["modal"]) and $_GET["modal"] == "signuperror") {
        ?>
    <script>
    var openAgainSignUpError = document.querySelector("ul.navbar");
    let anchorTagSignUpError = openAgainSignUpError.lastElementChild.firstElementChild;
    anchorTagSignUpError.click();
    </script>
    <?php
    }
    ?>
    <script src="scripts/modelTemplate.js"></script>
</body>

</html>