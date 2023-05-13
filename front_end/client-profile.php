<?php
//connection to our database
include "includes/connection.php";

//opening a session or resuming an already opened one
session_start();

if(isset($_POST["signout"]))
{
  session_unset();
  session_destroy();
}

if(!isset($_SESSION["client_id"]))
{
  if(isset($_POST["signout"]))
  {
    header("location: index.php");
  }
  else
  header("location: login.php");
}
else
{
  $client_id=$_SESSION["client_id"];
  $sql="select* from client where client_id='$client_id';";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result))  //one row returened
  {
    $row=mysqli_fetch_assoc($result);  //this is now array has 6 elements
    $f_name=$row["first_name"];
    $l_name=$row["last_name"];
    $email=$row["email"];
    $phone=$row["phone"];
    $mobile=$row["mobile"];
    $address=$row["address"];
  }
  else
  die("error occurred");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Shadows+Into+Light&family=Sofia+Sans+Condensed:ital,wght@0,1;0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,1;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Work+Sans:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="client-profile.css" />
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <!--start header-->
    <?php
    include "includes/header.html";
    ?>
    <section class="wrapper-main">
      <h1>My Profile</h1>
      <a href="edit-profile.php">
        <button style="border-radius: 6px">Edit profile</button>
      </a>
      <form action="" method="post">
        <table>
          <tr>
            <th><strong>Profile Information</strong></th>
          </tr>
          <tr>
            <td></td>
          </tr>
          <tr>
            <td><strong>Name:</strong></td>
          </tr>
          <tr>
            <td><i><?php echo "$f_name $l_name"; ?></i></td>
          </tr>
          <tr>
            <td></td>
          </tr>
          <tr>
            <td><strong>Email:</strong></td>
          </tr>
          <tr>
            <td><i><?php echo $email; ?></i></td>
          </tr>
          <tr>
            <td></td>
          </tr>
          <?php
          if($mobile!=NULL)
          echo "
          <tr>
            <td><strong>Mobile:</strong></td>
          </tr>
          <tr>
            <td><i>{$mobile}</i></td>
          </tr>
          ";
          ?>
          <tr>
            <td></td>
          </tr>
          <?php
          if($phone!=NULL)
          echo "
          <tr>
            <td><strong>Phone:</strong></td>
          </tr>
          <tr>
            <td><i>$phone</i></td>
          </tr>
          ";
          ?>
          <tr>
            <td></td>
          </tr>
          <?php
          if($address!=NULL)
          echo "
          <tr>
            <td><strong>Address:</strong></td>
          </tr>
          <tr>
            <td><i>$address</i></td>
          </tr>
          ";
          ?>
          <tr>
            <td></td>
          </tr>
          <tr>
            <td>
              <form action="" method="post">
              <button type="submit" name="signout" style="border-radius: 6px">Sign out</button>
              </form>
            </td>
          </tr>
          <tr>
            <td><br /><br /></td>
          </tr>
        </table>
      </form>
    </section>
    
    <?php
    include "includes/footer.html";
    ?>
    <script src="index.js"></script>
  </body>
</html>
