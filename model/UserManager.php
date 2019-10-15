<?php
require_once("Manager.php");
class UserManager extends Manager
{

    public function logOut() {
        session_start();
        session_unset();
        session_destroy();

        setcookie('username', '');
        setcookie('passwordHash', '');
    }


    public function signIn($postParams) {
        // Connexion to the database
        $db = $this->dbConnect();

        session_start();
        setcookie('username', ($postParams['signinUsername']), time()+365 * 24 * 3600, null, null, false, true);
        setcookie('passwordHash',  password_hash(($postParams['signinpsw']), PASSWORD_DEFAULT), time()+365 * 24 * 3600, null, null, false, true);



        $username = htmlspecialchars($postParams['signinUsername']);
        $password = password_hash(htmlspecialchars($postParams['signinpsw']), PASSWORD_DEFAULT);


        $req = $db->prepare("SELECT id, password FROM members WHERE username = :username");
        $req->execute(array(
            'username' => $username));

        $result = $req->fetch();
        $passwordVerify = password_verify($postParams['signinpsw'], $result['password']);

        if (!$passwordVerify){
           return "Location:index.php?modal=phperror"; 

        }else {
            if ($passwordVerify){ 
                $_SESSION['id'] = $result['id'];
                $_SESSION['signinUsername'] = $username;
                $checkBox = isset($postParams['checkbox'])? $postParams['checkbox'] : 0; 
                if ($checkBox===1){
                    setcookie("username", $username, time()+365*24*3600);   
                }
               return "Location:index.php";
            }else{
               return "Location:index.php?modal=phperror";
            };
        };
    }

    public function signUp($postParams) {
        // Connexion to the database
        $db = $this->dbConnect();

        if (isset($postParams['username']) AND isset($postParams['psw']) AND isset($postParams['email']) AND isset($postParams['pswconfirm']) AND preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$postParams['email'])){
            $username = addslashes(htmlspecialchars(htmlentities(trim($postParams['username']))));
            $password = $postParams['psw'];
            $passwordConfirm = $postParams['pswconfirm'];   
            $email = addslashes(htmlspecialchars(htmlentities(trim($postParams['email']))));
            $password_hash = password_hash($postParams['psw'], PASSWORD_DEFAULT);
            
            try
            {
                if($password != $passwordConfirm){ throw new Exception("<p class = 'error'>Passwords do not match</p>");}
                $params = array(
                    'username' => $username,
                    'password' => $password_hash,
                    // 'profImage' => 1,
                    'email' =>$email);
                $req = $db->prepare("INSERT INTO members(username, password, email, profImage, registrationDate) VALUES (:username, :password, :email, 1, NOW())");
                $req->execute($params);
                
                return "Location: ./index.php?modal=success"; 
            }catch (Exception $ex){
                
                return "Location: ./index.php?modal=signuperror"; 
            }catch (Exception $exc) {
                echo $exc->getMessage();
            }
        }
    }

    public function loadUserInfos($user_id) {
        // Connexion to the database
        $db = $this->dbConnect();
        $req = $db->query("SELECT * FROM members WHERE id= $user_id");
        return $req ->fetch();
    }

    public function uploadImgUser($user_id, $postParams, $files){
        $db = $this->dbConnect();

        // Check the file if it is allowed for upload or not
        // Place the file in required directory and then give necessary file permission

        if(isset($postParams["upload"])){
            $file = $files["profImage"];
            $fileName = $files["profImage"]["tmp_name"]; 
            $fileTmpName = $files["profImage"]["name"]; 
            $fileSize = $files["profImage"]["size"];
            $fileError = $files["profImage"]["error"];
            $fileType = $files["profImage"]["type"];
            // to set what file types are allowed and where the file is stored 
            $fileExt = explode(".",$fileTmpName); 
            $fileActualExt = strtolower($fileExt[1]);
            $allowed = array("jpg", "jpeg", "png"); 
            // print_r($fileActualExt);

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize <5000000){
                        $fileNameNew = "/profile".$user_id.".".$fileActualExt;
                        $fileDestination = "./images/uploads".$fileNameNew;
                        $success = move_uploaded_file($fileName, $fileDestination); 
                        $userUpload = "UPDATE members SET profImage = '$fileNameNew' WHERE id ='$user_id'"; 
                        // print_r($userUpload);
                        $req = $db->query($userUpload); 

                        return "Location: index.php?action=memberAccount&upload=uploadsuccess"; 
                    }else{
                        return "Location: index.php?action=memberAccount&upload=sizeerror"; 
                        // echo "Maximum file size is 250 KB.";
                        // $fileUploadFlag = "false"; 
                    }
                }else{
                    return "Location: index.php?action=memberAccount&upload=uploaderror"; 
                    // echo "Error: failed to upload."; 
                }
            }else{
                return "Location: index.php?action=memberAccount&upload=typeerror"; 
                // echo "You cannot upload files of this type."; 
            }
        }


    }
} //End of class
