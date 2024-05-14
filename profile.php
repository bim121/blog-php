<?php
    session_start();

    include("classes/connection.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");
    include("classes/profile.php");

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

    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);

    if(is_array($profile_data)){
        $user_data = $profile_data[0];
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $post = new Post();
        $id = $user_data['userid'];
        $results= $post->create_post($id, $_POST);

        if($result == ""){
            header("Location: profile.php");
            die;
        }else{

        }
    }

    $post = new Post();
    $id = $user_data['userid'];

    $posts = $post->get_posts($id);

    $user = new User();
    $id = $user_data['userid'];

    $friends = $user->get_friends($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>
    
    <?php include("header.php")?>

    <div class="container">
        <div class="container__profile">
            <img src="./images/mountain.jpg" style="width:100%;">
            <span class="profile__image">
                <?php 
                    $image = "";
                    if(file_exists($user_data["profile_image"])){
                        $image = "./" . $user_data['profile_image'];
                    }
                ?>

                <img class="profile_pic" src=<?php echo $image?>><br>
                <a href="./change_profile_image.php" class="btn__change__image">Change Image</a>
            </span>
            <br>
                <div class="profile__details"><?php echo $user_data['first_name'] . " " . $user_data['last_name']?></div>
            <br>
        </div>

        <div class="content">
            <div class="container__friends">
                <div class="friends_bar">
                    Friends<br>

                    <?php
                        if($friends){
                            foreach($friends as $FRIEND_ROW){
                                include('user.php');
                            }
                        }
                    ?>
                </div>
            </div>
            
            <div class="container__posts">
                <div class="post__form">
                    <form method="post">
                        <textarea name="post" placeholder="Whats on your mind?"></textarea>
                        <input class="post_button" type="submit" value="Post">
                        <br>
                    </form>
                </div>
                <div class="post_bar">
                    <?php
                        if($posts){
                            foreach($posts as $ROW){
                                $user = new User();
                                $ROW_USER = $user->get_user($ROW['userid']);
                                include("post.php");
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>