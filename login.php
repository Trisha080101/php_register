<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysql = require __DIR__ . "/database.php";
    $email = $_POST["email"];
    $sql = "SELECT * FROM user
            WHERE email = '$email'";
    // $mysql->real_escape_string($_POST["email"]));
    
    $result = $mysql->query($sql);
  
    $user = $result->fetch_assoc();
   
   
   // var_dump($result);
    
    //var_dump($_SESSION);
    
    //var_dump($user);
    

    
    if ($user) {
       
        if ($_POST["password"] == $user["password_hash"]) {
            var_dump($user);
           //die("Login Successful"); 
            session_start();
            
         session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
               
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Login
</title>



        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
         
    </head>
    <body>
        <h1>Login</h1>
        <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
        <form method="post">
            <label for="email">email</label>
            <input type="email" name="email" id="email" 
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            <label for="password">password</label>
            <input type="password" name="password" id="password">

           <input type="checkbox" onclick="myFunction()">Show Password
            
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
          }
        }
    </script>
    <br><br>
<button>Submit</button>
</form>
</body>
</html>