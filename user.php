<div class="friends">
    <?php
        if(file_exists($FRIEND_ROW["profile_image"])){
            $image = "./" . $FRIEND_ROW['profile_image'];
        }else{
            $image = "./images/user_male.jpg";
            if($FRIEND_ROW['gender'] == "Female"){
                $image = "./images/user_female.jpg";
            }
        }
    ?>
    <a href="profile.php?id=<?php echo $FRIEND_ROW['userid']; ?>">
        <img class="friends_img" src=<?php echo $image?>>
        <br>
        <?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name']?>
    </a>
</div>