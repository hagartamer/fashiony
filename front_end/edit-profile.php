<?php
session_start();
$client_id=$_SESSION["client_id"];

include "includes/connection.php";
$flag=0;
$mess="";
$color="";
if(isset($_POST["edit_profile"]))
{
    if(isset($_POST["phone"]))
    $phone=$_POST["phone"];
    if(isset($_POST["mobile"]))
    $mobile=$_POST["mobile"];

    $sql="select phone, mobile from client where client_id='$client_id';";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result))
    {
        $row=mysqli_fetch_assoc($result);
        if($row["phone"]!=NULL || $row["mobile"]!=NULL)
        {
            $flag=1;
            $mess="You 're about to overwritte your data";
            $color="#f44336";
        }
    }

    $sql="
    update client
    set phone='$phone' , mobile='$mobile'
    where client_id=$client_id;
    ";
    mysqli_query($conn,$sql);
    header("location: client-profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Shadows+Into+Light&family=Sofia+Sans+Condensed:ital,wght@0,1;0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,1;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Work+Sans:wght@300&display=swap"
        rel="stylesheet"
        />
        <link rel="stylesheet" href="product-details.css">
        <link rel="stylesheet" href="index.css" />
        <link rel='stylesheet' href='new_main.css'>
        <title>Edit Profile</title>
    </head>

    <body>
        <?php
        // include "includes/header.html" ;
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
                <h1>Edit Profile</h1>
                <form action="" method="POST">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" placeholder="012-34-56-789" 
                    pattern="[0-9]{10}" required>
                    <label for="mobile">Mobile</label>
                    <input type="tel" id="mobile" name="mobile" placeholder="01-234-567-890"
                    pattern="[0-9]{11}" required>
                    <input type="submit" name="edit_profile" value="edit">
                </form>
                <p>By clicking the Submit button, you agree to our<br>
                    <a href="#">Terms and Condition</a> and <a href="#">Policy and Privacy</a>
                </p>
            </div>
        </div>
        <?php
        include "includes/footer.html";
        ?>
    </body>

</html>