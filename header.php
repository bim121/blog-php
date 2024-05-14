<?php 
    $image = "";
    if(file_exists($user_data["profile_image"])){
        $image = "./" . $user_data['profile_image'];
    }
?>

<div class="blue_bar">
    <div class="header">
        <a href="./profile.php" style="color: white;">Mybook </a>
        <a href="./profile.php">
            <img src=<?php echo $image?> style="width: 50px; float: right;">
        </a>
        <a href="./logout.php">
            <span class="logout__button">Logout</span>
        </a>
    </div>
</div>