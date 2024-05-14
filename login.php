<?php 
    session_start();

    include("classes/connection.php");
    include("classes/login.php");

    $email = "";
    $password = "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $login = new Login();
        $result = $login->evaluate($_POST);
        
        if($result != ""){
            echo $result;
        }else{
            header("Location: profile.php");
            die;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login to your account</title>
        <link rel="stylesheet" href="./css/login.css">
    </head>
<body>
    <div class = "bar">
    
        <div class="title">Mybook</div>
        <div class="signup_button">
            <a href="./signup.php">Signup</a>
        </div>

    </div>

    <div class="bar2">
        <form method="POST">
            Log in to Mybook<br><br>

            <input name="email" value="<?php echo $email?>" type="text" class="text" placeholder="Email"><br><br>
            <input name="password" value="<?php echo $password?>" type="password" class="text" placeholder="Password"><br><br>
            <input type="submit" class="button" value="Log in">
            <br><br><br>
        </form>

    </div>
</body>
</html>