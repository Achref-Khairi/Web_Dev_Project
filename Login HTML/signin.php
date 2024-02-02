<?php

@include 'config.php';

session_start();

if(isset($_POST['login'])){
    
   $user = mysqli_real_escape_string($conn, $_POST['LoginUser']);
   $pass = md5($_POST['LoginPassword']);

   $select = " SELECT * FROM tb_user WHERE usename = '$user' && password = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $_SESSION['LoginUser'] = $user;
      header('location:..\home page after SU.html');
   }else{
      $error[] = 'incorrect password or username.';
   }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>document</title>
</head> 
<body>
   <div class="login-wrapper">
       <form action="" class="form" method = "post">
           <img src="User.png" alt="">
           <h2>login</h2>
           
						                        
           <div class="input-group">
               <input type="text" name="LoginUser" id="LoginUser" required>
               <label for="LoginUser">User Name</label>
           </div>  
           <div class="input-group">
            <input type="password" name="LoginPassword" id="LoginPassword" required>
            <label for="LoginPassword">Password</label>
           </div>
           <input type="submit" value="Login" name='login' class="submit-btn">
           <a href="create.php" class="create" >Create New Account </a>
           <br>
           
        </form> 
        
              
           
        </form>
        </div>

   </div>
</body> 
  
  