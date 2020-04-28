<?php

session_start();

if($_SESSION["admin_email"] == "" or $_SESSION["admin_id"] == "")
{
   $msg = "Please login first";
   header("Location: index.php?error=$msg");
}
         

   $conn = mysqli_connect("localhost","root","","control");
   if(isset($_FILES['doc'])){
      $errors= array();
      $file_name = $_FILES['doc']['name'];
      $file_size =$_FILES['doc']['size'];
      $file_tmp =$_FILES['doc']['tmp_name'];
      $file_type=$_FILES['doc']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['doc']['name'])));
      
      $extensions= array("pdf","txt","docx");

      //$newfile_name = $title.".".$file_ext;
      
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a pdf, txt, docx file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }

      $query = mysqli_query($conn,"select * from `upload` where `file_name`='$file_name'");
      $count_row = mysqli_num_rows($query);
      
      if($count_row > 0)
      {
         echo $msg =  "The file '$file_name' is already exist";
         header("Location: dashboard.php?error=$msg");
      }
      else{
      
      if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,"uploads/".$file_name))
         {
            mysqli_query($conn,"insert into `upload` (`file_name`) values ('$file_name')");
            header("Location: dashboard.php?msg=file uploaded successfully");
            
         }
         
      }
      else
      {
         header("Location: dashboard.php?error=$errors[0]");
      }
   }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styleB.css">
</head>
<body>
   <div><a href="logout.php"><span style="color: white;">Logout</span></a></div>
<div class=abc>
<form action="dashboard.php" method="POST" enctype="multipart/form-data">
    <h1>Select File to upload:</h1>
    <input type="file"  name="doc" id="doc">
     <input type="submit" value="Upload File" name="submit">
</form>
</div>
</body>
</html>