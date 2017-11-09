<?php
   include('getSql.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $ses_sql = getSql("select username from user where username = :user ", array(':user' => $user_check));
   
   foreach ($ses_sql as $key => $row) {
   	 $login_session = $row['username'];
   }
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>