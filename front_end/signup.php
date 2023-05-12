<?php
session_start();

//establishing a connection to our databse
include "includes/connection.php"; 

// function to filter form input 
function clean($input)
{
  $input=trim($input);
  $input=htmlspecialchars($input);
  return $input;
}

//initializing values of inputs fields
$fname="";
$lname="";
if(isset($_POST["homepage_submit"]))
{
  if(isset($_POST["homepage_email"]))
  $email=$_POST["homepage_email"];
}
else {$email="";}
$password="";
$confirm="";
$flag=0;
$mess="";
$color="";

if(isset($_SESSION["state"]))
{
  if($_SESSION["state"]==0)
  {
    unset($_POST["signup_submit"]);
    unset($_POST["fname"]);  
    unset($_POST["lname"]);
    unset($_POST["email"]);
    unset($_POST["password"]);
    unset($_POST["confirm"]);
    $fname="";
    $lname="";
    $email="";
    $password="";
    $confirm="";
  }
}
$_SESSION["state"]=1;
//logic to do if the user submit the form
if(isset($_POST["signup_submit"]))
{
  if(isset($_POST["fname"]))
  $fname = $_POST["fname"];

  if(isset($_POST["lname"]))
  $lname = $_POST["lname"];

  if(isset($_POST["email"]))
  $email = $_POST["email"];

  if(isset($_POST["password"]))
  $password = $_POST["password"];
  
  if(isset($_POST["confirm"]))
  $confirm = $_POST["confirm"];

  //testing if all the input fields are filled or not
  if($fname==NULL || $lname==NULL || $email==NULL || $password==NULL || $confirm==NULL)
  {
    $flag=1;
    $mess="Please, make sure you fill in all the fields!!";
    $color="#f44336";
  }
  else
  {
    $fname=clean($fname);
    $lname=clean($lname);
    $email=clean($email);
  
    $sql="select email from client where email='$email';";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result))
    {
      $row=mysqli_fetch_assoc($result);
      if($row["email"]==$email)
      {
        $flag=1;
        $mess="This email is already in use!! Try use another one.";
        $color="#f44336";
      }
    }
    else 
    {
      if($password!=$confirm)
      {
        $flag=1;
        $mess="Please, make sure the passwords match each other!!";
        $color="#e266b7";
      }
      else
      {
        $password= password_hash($password,PASSWORD_DEFAULT);
        $sql="insert into client(first_name,last_name,email,passwd) values ('$fname', '$lname', '$email', '$password');";
        mysqli_query($conn,$sql);
        header("location: signup-success.php");
        // $flag=1;
        // $mess="Wohoo!! Successfully signed up.";
        // $color="#ff9800";
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Shadows+Into+Light&family=Sofia+Sans+Condensed:ital,wght@0,1;0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,1;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Work+Sans:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="new_main.css">
    <title>signup</title>
</head>

<body>
  <?php
  include "includes/header.html";
  ?>
  <?php
  if($flag==1)
  {
    echo "
    <div class=\"alert\" style=\"
    background-color:$color;
    width: 350px;
    position: absolute;
    top: 500px;
    right: 20px;
    color: white;
    padding: 20px;
    border-radius:10px ;
    z-index: 100000;\">
        <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\"
          style=\"float: right;
          font-weight: bold;
          font-size: 20px;
          cursor: pointer;\">&times;</span>
        $mess
    </div>
    ";
  }
  ?>
  <div class="outmost">
    <div class="sign-up">
      <h1>Sign Up</h1>
      <h4>It's free and only take a minute</h4>
      <form action="" method="post">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" value="<?php echo $fname;?>" required>
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lname" value="<?php echo $lname;?>" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $email;?>"
        <?php if(isset($_POST["homepage_email"])) echo "autofocus"; ?> required>
        <label for="passwd">Password</label>
        <input type="password" id="passwd" name="password" value="<?php echo $password;?>" required>
        <label for="confirm">Confirm Password</label>
        <input type="password" id="confirm" name="confirm" value="<?php echo $confirm;?>" required>
        <input type="submit" name="signup_submit" value="submit">
      </form>
      <p>By clicking the Submit button, you agree to our<br>
        <a href="Terms and Condition.php">Terms and Condition</a> and <a href="PRIVACY POLICY.php">Policy and Privacy</a>
      </p>
    </div>
    <p class="p2">Already have an account? <a href="login.php">Login</a></p>
  </div>  
  <?php
    include "includes/footer.html";
  ?>    
  <script src="index.js"></script>
</body>
</html>