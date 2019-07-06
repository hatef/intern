<?php
//starting session
session_start();
//connection information
$host_name="127.0.0.1";
$database="intern";
$db= new PDO('mysql:host='.$host_name.';dbname='.$database,"root","");

$email= $_POST["email"];
$password= $_POST["password"];
$stmt= $db->prepare("SELECT *FROM users WHERE email = '$email' AND password= '$password'");

$stmt->execute();

$row=$stmt->fetch(PDO::FETCH_ASSOC);
//setting session
$_SESSION["name"]=$row["name"];
if($row){
    //redirect to contents after successful login
    header("location: contents.php");
}

?>



<html>
<head>
    <title>
    Login
    </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
<div class="container">
<form action="login.php" method="post">
<h1>User Login</h1>

<div class="row" style="padding-bottom: 10px">
<div class="col-md-2">
<label for="">Email</label>
</div>
<div class="col-md-4">
<input type="email" name="email" class="form-control">
</div>
</div>

<div class="row">
<div class="col-md-2">
<label for="">Password</label></div>
<div class="col-md-4">
<input type="password" name="password" class="form-control">
</div>
</div>
       

    <input type="submit" value="Login" class="btn btn-primary">
 </form>
</div>

 <script src="js/bootstrap.min.js"></script>

</body>
</html>

