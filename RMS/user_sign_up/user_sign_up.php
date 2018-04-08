<?php 

if(array_key_exists('email', $_POST) AND array_key_exists('password', $_POST)){
    $dbHost = "localhost";        //Location Of Database usually its localhost 
    $dbUser = "root";            //Database User Name 
    $dbPass = "";            //Database Password 
    $dbDatabase = "rail_connect";    //Database Name 
    if($_POST['password']!=$_POST['psw-repeat']){
        echo "Password Mismatch";
    }
    else{ 
    $db = mysqli_connect($dbHost,$dbUser,$dbPass) or die("Error connecting to database."); 
    //Connect to the databasse 
    mysqli_select_db($db, $dbDatabase)or die("Couldn't select the database."); 

    $usr = mysqli_real_escape_string($db,$_POST['email']); 
    $pas = mysqli_real_escape_string($db,$_POST['password']);
    $query = "SELECT `uid` FROM `users` WHERE `username` = '".mysqli_real_escape_string($db,$_POST['email'])."'"; 
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result) > 0){
        echo "<p>Email Id Already Exists.</p>";
    }
    else{
        if(mysqli_query($db ,"INSERT INTO `users`(`username`, `password`) VALUES ('$usr','$pas') ") == TRUE){ 
           echo "<p>User Created : Please Login </p>";
                   exit; 
        }
        else { echo "<p>Could not currently Signin.Please try again later.</p>";   sleep(5);
            exit ;
        }
    }}
}
 ?> 


