<?php ob_start(); ?>
<link rel = "stylesheet" href="./styles/memberAccount.css">
<?php 
$head = ob_get_clean(); 
ob_start(); 
?>

<?php include("menuBar.php"); ?>
<div class="user_acc_container">
    <h2 class ="userHeader">My Account</h2>
    <div id = accountForm>
        <div id ="imgUpload">
            <div id = 'imgResult'>
                <img class = 'profileImg' src ="./images/uploads/<?php echo ($user['profImage'])? $user['profImage'] :  "profiledefault.jpg";?>">
            </div>
            <form id = "uploadImgForm" method ="POST" action ="index.php?action=uploadImgUser" enctype='multipart/form-data'>
            <!-- ^ add file permission to the directory upload.php where we plan to store the files after uploading it -->
                <input type ="hidden" name = "size" value = "1000000">
                    <div>
                        <input type ="file" name="profImage">
                    </div>
                    <div>
                        <input type ="submit" name ="upload" value="Upload">
                    </div>      
            </form>

            <?php
            if(isset($_GET["upload"]) AND $_GET["upload"] == "sizeerror"){
                echo "Maximum file size is 250 KB.";
            }else if(isset($_GET["upload"]) AND $_GET["upload"] == "uploaderror"){
                echo "Error: failed to upload."; 
            }else if(isset($_GET["upload"]) AND $_GET["upload"] == "typeerror"){
                echo "You cannot upload files of this type."; 
            }
            ?>
        </div>
        <div class = "info">
            <!-- <li> Full Name:  </li> -->
            <li><b>Email Address</b>: <?= $user["email"];?> <a href = "#" > Edit </a> </li>
            <li><b>User Name</b>: <?= $user["username"];?><a href = "#" > Edit </a> </li>
            <li><b>Password</b>: <?=$user["password"];?> <a href = "#" > Edit </a> </li>
            <li><b>Date of Birth</b>: </li>
            <li><b>Country</b>: </li>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require("template.php") ?>
<script src="./scripts/modalMenu.js"></script>