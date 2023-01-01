<?php

session_start();


$mysqli = require __DIR__ . '/database.php';
 



include "database.php";
if(isset($_POST['edit']))
{
   $id=$_SESSION['user_id'];
   $username = $_POST['username'];
   $password = $_POST['password'];
   $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

   $select= "SELECT * FROM user WHERE id = '$id'";
   $sql = mysqli_query($mysqli,$select);
   $row = mysqli_fetch_assoc($sql);
   $res= $row['id'];
   if($res === $id)
   {
  
      $update = "update user set username='$username',password_hash='$password_hash' where id='$id'";
      $sql2=mysqli_query($mysqli,$update);
if($sql2)
      { 
          /*Successful*/
          header('location:home.php');
      }
      else
      {
          /*sorry your profile is not update*/
          header('location:edit.php');
      }
   }
   else
   {
       /*sorry your id is not match*/
       header('location:edit.php');
   }
}
