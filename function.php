<?php
session_start();

$server ="localhost";
$user = "root";
$password = "";
$db = "phpdb";
$conn = new mysqli($server,$user,$password,$db);
if($conn->connect_error){
    die("Connection failed" . $conn->connect_error);
}

global $conn;

//Insert Query ********
if(isset($_POST['Register'])){
    $Name = $_POST['FirstName'];
    $Email = $_POST['email'];
    $Password =$_POST['pass'];

    $user_check = mysqli_query($conn,"SELECT * FROM register WHERE email = '$Email'");
    if(mysqli_num_rows($user_check) > 0 ){
        $_SESSION['message'] = "User Has Already Taken!";
        header('Location:index.php');
        exit;
    }

    $Insert = "INSERT INTO register (name, email, password) VALUES ('$Name', '$Email', '$Password')";
    $result = mysqli_query($conn,$Insert);
    if($result){
        $_SESSION['message'] = "Register Done Successfully!.";
        header("Location:login.php");
    }
}
//login Function
if(isset($_POST['LoginBTn'])){
    $logemail = $_POST['logemail'];
    $logpass = $_POST['logpass'];
    global $conn;
    $data=mysqli_query($conn,"SELECT * FROM register WHERE email='$logemail'");
    if(mysqli_num_rows($data) > 0 ){
        $row=mysqli_fetch_assoc($data);
        $_SESSION['logged'] = $row['email'];
        if($logpass == $row['password']){
            $_SESSION['logged'] = $row['email'];
            $_SESSION['loggID'] =  $row['ID'];
            $_SESSION['logmessage'] = "Login Success!";
           
            header('Location:dashbord.php');
            if($password !=""){
                header("Location:login.php");
            }else{
                $message = "Error Redirect";
            }
        }else{
            $_SESSION['logmessage'] = "Invalid password";
            header('Location:login.php');
        }
    }else{
        $_SESSION['logmessage'] = "Invalid User Email";
        header('Location:login.php');
        exit;    
    }
}
$conn->close();

//Lout Out function
if(isset($_POST['logout'])){
    session_destroy();
    header('Login.php');
}


 
