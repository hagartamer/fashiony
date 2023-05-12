<?php
session_start();

// establishing a connection to our database
include "includes/connection.php";

// initializing variables
$email="";
$password="";
$flag=0;
$mess="";
$color="";

if(isset($_SESSION["state_login"]))
{
  if($_SESSION["state_login"]==0)
  {
    unset($_POST["signup_submit"]);
    unset($_POST["email"]);
    unset($_POST["password"]);

    $email="";
    $password="";
  }
}

$_SESSION["state_login"]=1;

// code to authorize a user 
if(isset($_POST["login_submit"]))
{
  if(isset($_POST["email"]))
  $email=$_POST["email"];
  if(isset($_POST["password"]))
  $password=$_POST["password"];

  if ($email == NULL || $password == NULL)
  {
    $flag=1;
    $mess="Please, make sure you fill in all the fields!!";
    $color="#f44336";
  }
  else
  {
    $sql="select* from client where email='$email';";
    $result=mysqli_query($conn,$sql);
    if(!mysqli_num_rows($result))
    {
      $flag=1;
      $mess="Incorrect email or password !!<br> Please try again.";
      $color="#f44336";
    }
    else
    {
      $row=mysqli_fetch_assoc($result);
      if($row["email"]==$email && password_verify($password,$row["passwd"]))
      {
        // $flag=1;
        // $mess="Wohoo!! logged in successfully.";
        // $color="#ff9800";

        $_SESSION["client_id"]=$row["client_id"];
        $_SESSION["count"]=0;
        $_SESSION["products"]=[];
        header("location: login-success.php");
      }
      else
      {
        $flag=1;
        $mess="Incorrect email or password !!<br> Please try again.";
        $color="#f44336";
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
    <link rel='stylesheet' href='new_main.css'>
    <title>Login</title>

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
    top: 300px;
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
    <div class="LOGIN">
      <h1>Login</h1>
      <form action="" method="post">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?php echo $email;?>" required>
          <label for="passwd">Password</label>
          <input type="password" id="passwd" name="password" value="<?php echo $password;?>" required>
          <input type="submit" name="login_submit" value="submit">
      </form>
      <p><a href="#">Forgot Password?</a></p>
  </div>
  <p class="p2">Not have an account? <a href="signup.php">Sign Up</a></p>
  </div>

  <?php
    include "includes/footer.html";
  ?>

</body>

</html>