<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){
    
   $firstName = mysqli_real_escape_string($conn, $_POST['Fname']);
   $lastName = mysqli_real_escape_string($conn, $_POST['Lname']);
   $user = mysqli_real_escape_string($conn, $_POST['LoginUser']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['LoginPassword']);
   $rpass = md5($_POST['LoginPassword2']);

   $select = " SELECT * FROM tb_user WHERE email = '$email' && password = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist';
   }
   else{
      if($pass != $rpass){
         $error[] = 'password not mathched!';
      }else{
         $insert = "INSERT INTO tb_user(firstname,lastname,usename,email,password) VALUES('$firstName','$lastName','$user','$email','$pass')";
         mysqli_query($conn, $insert);
         header('signin.php');
      }
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="create.css">
  <title>document</title>
</head> 
<body>
   <div class="login-wrapper">
       <form action="" method="post" name="F" class="form"  onsubmit="verif()">
           <img src="user.png" alt="">
           <h2>Create New account</h2>
           			                        
           <div class="input-group">
               <input type="text" name="Fname" id="LoginUser" placeholder="First Name" >
               <label for="Fname">First name</label>
            </div>

            <div class="input-group">
                <input type="text" name="Lname" id="LoginUser" placeholder="Last Name">
                <label for="Lname">Last name</label>
            </div>

            <div class="input-group">
                <input type="text" name="LoginUser" id="LoginUser" placeholder="Username">
                <label for="LoginUser">User name</label>
             </div>

            <div class="input-group">
                <input type="email" name="email" id="LoginUser" placeholder="Email Adress" >
                <label for="email">E-mail Address</label>
            
           <div class="input-group">
            <input type="password" name="LoginPassword" id="LoginPassword" placeholder="Password" oninput="return validate()" >
            <label for="LoginPassword">Password</label>
           </div>
 
           <div class="input-group">
            <ul>    
            <li id="lower">at least one lowercase </li>      
            <li id="upper">at least one uppercase</li>      
            <li id="length">at least 8 characters</li>      
            <li id="special_char">at least one speacial char</li>
            <li id="number">at least 1 number</li>           
            </ul>
           </div>
           <br>
           <div class="input-group">
            <input type="password" name="LoginPassword2" id="LoginPassword" placeholder="Re enter password" >
            <label for="LoginPassword2">Re-Enter Password</label>
           </div>
           <br /> 
           <input type="submit" value="Create" name='submit' class="submit-btn">
           
           
        </form>
        </div>

   </div>
   <script language=javascript >
    function validate() {
        var pass=document.getElementById('LoginPassword');
        var upper=document.getElementById('upper');
        var lower=document.getElementById('lower');
        var spec=document.getElementById('special_char');
        var num=document.getElementById('number');
        var length=document.getElementById('length');

        if(pass.value.match(/[0-9]/)) {
            num.style.color='green'
        }
        else{num.style.color='red'}
        if(pass.value.match(/[A-Z]/)) {
            upper.style.color='green'
        }
        else{upper.style.color='red'}

        if(pass.value.match(/[a-z]/)) {
            lower.style.color='green'
        }
        else{lower.style.color='red'}

        if(pass.value.match(/[!\@\*\$\^]/)) {
            spec.style.color='green'
        }
        else{spec.style.color='red'}

        if(pass.value.length< 8 ) {
            length.style.color='red'
        }
        else{length.style.color='green'}

        
    }
    function verif (){
       
      const UserName=F.LoginUser.value.trim();
      const LoginPassword=F.LoginPassword.value.trim();
      const LoginPassword2=F.LoginPassword2.value.trim();
      const Fname=F.Fname.value.trim();
      const Lname=F.Lname.value.trim();
      const Email=F.email.value.trim();

        if(Fname==="" || Fname.charAt(0)!= Fname.charAt(0).toUppercase()) {
            let message="INVALID  First NAME";
            window.alert(message);
            return false;
                                  }
        if(Lname==="" || Lname.charAt(0)!= Lname.charAt(0).toUppercase()) {
            let message="INVALID Last NAME";
            window.alert(message);
            return false ;  
                                  }
        var at=Email.indexOf("@");
        var p=Email.indexOf(".", at+2);
        var ch1=Email.slice(0,at);
        var ch2=Email.slice(at+1,p);
        var ch3=Email.slice(p+1,F.email.length);
    if ( Email===""){
        let message="Email is empty !";
        window.alert(message); 
        return false ; 
    }
    else if ((ch1=="") || (ch2="") || (ch3="") || (at==-1) || (p==-1) || (ch3.length<2)) {
        let message="Email is Invalid Form !";
        window.alert(message);  
        return false ;
    }
    if(validate(LoginPassword)==false){
        let message="Password is Invalid Form !";
        window.alert(message);  
        return false ;
    }
    if(LoginPassword != LoginPassword2) {
            let message="Password not matched";
            window.alert(message);
            return false ;  
}
    }
</script>
</body> 
</html>