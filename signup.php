<?php 
    include("classes/connection.php");
    include("classes/signup.php");

    $firstName = "";
    $lastName = "";
    $gender = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $signup = new Signup();
        $result = $signup->evaluate($_POST);
        
        if($result != ""){
            echo $result;
        }else{
            header("Location: login.php");
            die;
        }

        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup</title>
        <link rel="stylesheet" href="./css/login.css">
    </head>
<body>
    <div class="bar">
    
        <div class="title">Mybook</div>
        <div class="signup_button"> 
            <a href="./login.php">Login</a>
        </div>

    </div>

    <div class="bar2">

        Sign up to Mybook<br><br>

        <form method="post" action="">
            <input value="<?php echo $firstName?>" name="first_name" type="text" class="text" placeholder="First name"><br><br>
            <input value="<?php echo $lastName?>" name="last_name" type="text" class="text" placeholder="Last name"><br><br>

            <span class="span__gender">Gender:</span><br>
            <select class="text" name="gender">
                <option><?php echo $gender?></option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select><br><br>

            <input value="<?php echo $email?>" name="email" type="text" class="text" placeholder="Email"><br><br>

            <input name="password" type="password" class="text" placeholder="Password"><br><br>
            <input name="password2" type="password" class="text" placeholder="Retyre Password"><br><br>

            <input type="submit" class="button" value="Log in">
            <br><br><br>
        </form>

    </div>
</body>
</html>