<?php
session_start();

if(!$_SESSION["name"]){
    header("location: login.php");
}
//retrieving data from the url
$contents =file_get_contents('https://ed808.com:92/latin/intern?parameter[page]=0&parameter[sort]=last');
//decoding json data into object
$contentsObj= json_decode($contents);
//getting the id of selected data to be bookmarked
$bookmarked= $_POST["bookmarked_id"];
//connection information
$host_name="127.0.0.1";
$database="intern";
//initializing a connection
$db= new PDO('mysql:host='.$host_name.';dbname='.$database,"root","");
//checking if bookmarked_id is not empty
if($_POST["bookmarked_id"]){
    //adding bookmark to the table
    $bID=$_POST["bookmarked_id"];
    $insertSQL="INSERT INTO bookmarks (content_id) VALUES ('$bID')";
    $stmt= $db->prepare($insertSQL);
    $stmt->execute();
}
//checking if removed_id is not empty
if($_POST["removed_id"]){
    //removing selected data from bookmarks table
    $rID=$_POST["removed_id"];
    $insertSQL="DELETE FROM bookmarks WHERE content_id=$rID";
    $stmt= $db->prepare($insertSQL);
    $stmt->execute();
}


?>
<html>
<head>
<title>
</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
  <div class="row">
  <div class="col-md-7">
  <ul class="list-group">
   
   <li class="list-group-item disabled" aria-disabled="true">Contents</li>
   <?php 
   
   //looping throung contents objects
   foreach ($contentsObj->contents as $value):?>
   <li class="list-group-item"><div class="row"><div class="col-md-9"><?=$value->title?></div> 
   
   <div class="col-md-3">
   <?php
   // checking if current value is bookmarked already or not to whether show the bookmark button or not
    $nid= $value->nid;
    $stmt= $db->prepare("SELECT *FROM bookmarks WHERE content_id=$nid");
    $stmt->execute();
  
    if(!$stmt->fetch()):
   ?>
   <form action="contents.php" method="post">
   <input type="submit" value="Bookmark" class="btn btn-success">
   <input type="hidden" name="bookmarked_id" value="<?=$value->nid?>">
   </form>
    <?php endif;?>
   </div></div></li>
 <?php endforeach;?>
 </ul>
  </div>
  <div class="col-md-5">
  <ul class="list-group">
   
   <li class="list-group-item disabled" aria-disabled="true">Bookmarked</li>
   <?php 
   
   //looping through contents object
   foreach ($contentsObj->contents as $value):
        $nid= $value->nid;
        $stmt= $db->prepare("SELECT *FROM bookmarks WHERE content_id=$nid");
        $stmt->execute();
      //checking if the current value exists in bookmarks
        if($stmt->fetch()):

    ?>
   
   <li class="list-group-item"><div class="row"><div class="col-md-9"><?=$value->title?></div> <div class="col-md-3">
   
   
   
   <form action="contents.php" method="post">
   <input type="submit" value="Remove" class="btn btn-danger">
   <input type="hidden" name="removed_id" value="<?=$value->nid?>">
   </form>
   
   </div></div></li>
        <?php endif; endforeach;?>
 </ul>
  </div>
  </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>