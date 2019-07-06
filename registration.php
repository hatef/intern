<?php

$host_name="127.0.0.1";
$database="intern";
try{
    $db= new PDO('mysql:host='.$host_name.';dbname='.$database,"root","");
    $name=$_POST["name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $sql="INSERT INTO users (name, email,password) VALUES('$name','$email','$password')";
    $stmt= $db->prepare($sql);
    if($password!=null){
        $stmt->execute();
        echo "User registration completed";
        header("location: login.php");
    }
}   catch(PDOException $pdo ){
    echo "unable";
}


?>


<html>
<head>
<title>User registration</title>
<link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
<div class="container">

<h1>User registration</h1>
<form action="registration.php" method="post">
    

    <div class="row" style="padding-bottom: 10px">
<div class="col-md-2">
<label for="">Name</label>
</div>
<div class="col-md-4">
<input type="text" name="name" class="form-control">
</div>
</div>
<div class="row" style="padding-bottom: 10px">
<div class="col-md-2">
<label for="">Email</label>
</div>
<div class="col-md-4">
<input type="email" name="email" class="form-control">
</div>
</div>
<div class="row" style="padding-bottom: 10px">
<div class="col-md-2">
<label for="">Password</label>
</div>
<div class="col-md-4">
<input type="password" name="password" class="form-control">
</div>
</div>
    <input type="submit" value="Register" class="btn btn-success">
    </form>
    </div>
    <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap.min.js"></script>

</body>
</html>

