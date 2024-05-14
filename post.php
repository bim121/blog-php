<div class="post">
    <div>
        <?php
            $user1 = new User();
            $user_data1 = $user1->get_user($ROW['usercreate']);

            if(file_exists($user_data1["profile_image"])){
                $image = "./" . $user_data1['profile_image'];
            }else{
                $image = "./images/user_male.jpg";
                if($user_data1['gender'] == "Female"){
                    $image = "./images/user_female.jpg";
                }
            }
        ?>

        <img src=<?php echo $image?> style="width: 75px; margin-right: 4px;">
    </div>
    <div>
         <div style="font-weight: bold; color: #405d9b;"><?php echo $ROW['first_name'] . " " . $ROW['last_name']?></div>
            <?php echo $ROW['post'] ?>
            <br><br>
            <a href="#">Like</a> . <a href="#">Comment</a> . 
            <span style="color: #999;">
                <?php echo $ROW['date']; ?>
            </span>
        </div>
</div>