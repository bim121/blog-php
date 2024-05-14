<?php 
    session_start();

    include("classes/connection.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");

    if(isset($_SESSION['mybook_userid']) && is_numeric($_SESSION['mybook_userid'])){
        $id = $_SESSION['mybook_userid'];
        $login = new Login();
        $result = $login->check_login($id);

        if($result){
            $user = new User();

            $user_data = $user->get_data($id);

            if(!$user_data){
                header("Location: login.php");
                die;
            }
        }else{
            header("Location: login.php");
            die;
        }
    }else{
        header("Location: login.php");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $filename = "uploads/" . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);

            if(file_exists($filename)){
                $userid = $user_data["userid"];
                $query = "update users set profile_image = '$filename' where userid = '$userid' limit 1";
                $DB = new Database();
                $DB->save($query);

                header("Location: profile.php");
                die;
            }
        }else{
            echo "please add a valid image!";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Image</title>
    <link rel="stylesheet" href="./css/timeline.css">
</head>
<body>
    
    <?php 
        include("header.php");
    ?>

    <div class="container__change__image">
        
        <div class="content">
            
            <div class="form__change__image">
            <form method="post" enctype="multipart/form-data">
                <div class="form__control">
                    <input type="file" name="file">
                    <input style="width: 60px;" class="post_button" type="submit" value="Change">
                    <br>
                </div>    
            </form>
            </div>
        </div>
    </div>

</body>
</html>