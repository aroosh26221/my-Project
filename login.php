<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<?php require_once 'nav.php' ?>  
 
<main class="container mt-3">
<form method="POST">

<p class="font-weight-bold">Email </p>
<input style="border:5px solid black" class="form-control" type="email" name="email" required/>


<p class="font-weight-bold">Password</p>
<input style="border:5px solid black" class="form-control" type="password" name="password" required/>
<a  href="reset.php">forget</a><br>

<a style="border:3px solid black" class="btn btn-outline-dark mt-3" href="register.php">Register </a>
<button style="border:3px solid black" class="btn btn-warning mt-3" type="submit" name="login">Login</button>

</form>

<?php
if(isset($_POST['login'])){
include "conn.php";
$email=$_POST['email'];
$pass=$_POST['password'];
$login = $database->prepare("select * from users where 	email =:email and password =:password");
$login->bindParam("email",$email);
$login->bindParam("password",$pass);
$login->execute();
if($login->rowCount()===1){
$user = $login->fetchObject();
if($user->Acivated ==1){
    session_start();
$_SESSION['user'] = $user;

if($user->role ==="user"){  // role : account type user or admin or super_admin
header("location:user/index.php",true);
}else if($user->role ==="admin"){
    header("location:admin/index.php",true);
}else if($user->role ==="super-admin"){
    header("location:super-admin/index.php",true);}

}else{
    echo "<div class='alert alert-warning'>please activate your account first we have sent your account verification code to your email 😎</div> ";}
}else{
 echo "<div class='alert alert-warning'>the password or email is incorrect 🤦‍♀️</div>";
}}
?>
</main>
</body>
</html>

