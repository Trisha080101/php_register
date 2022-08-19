<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/", $_POST["password"])) {
    die("Password must contain at least one letter");
}


if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}


//$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysql = require __DIR__ . "/database.php";


$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysql->stmt_init();



if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysql->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $_POST["password"]);
                  
                  if ($stmt->execute()) {

                    header("Location: signup-success.html");
                    exit;
                    
                } else {
                    
                    if ($mysql->errno === 1062) {
                        die("email already taken");
                    } else {
                        die($mysql->error . " " . $mysql->errno);
                    }
                }
                
                
       

/*

if(isset($_POST['save_user'])){
        $name=$_POST['name'];
        $email= $_POST['email'];
        $password_hash= $_POST['password'];
    
        $query = "INSERT INTO crud(name,email,password) VALUES('$name','$email','$password_hash')";
    
        $query_run = mysql_query($query, $con);
    
        if($query_run){

        echo "User Created Successfully";
           // $_SESSION['message']= "Intern Created Successfully";
      //  header("Location: process-signup.php");
            exit(0);
        }
        else{
            echo "User Not Created";
           // $_SESSION['message']= "Intern Not Created";
         // header("Location: process-signup.php");
            exit(0);
        }
        
    }
    */ 
?>