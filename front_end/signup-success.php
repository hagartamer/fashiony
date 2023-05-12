<?php
session_start();
$_SESSION["state"]=0;
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
    <style>
    .outmost{
        margin:160px 0px 60px 0px;
    }
    .outmost img{
        width:200px; 
        object-fit:cover; 
        display:block; 
        margin:auto;
        
    }
    h5{
        color:var(--main-color);
        text-align:center;
        margin:40px;
    }
    input[type=submit] {
    width: 80px;
    height: 25px;
    border: none;
    background-color: var(--main-color);
    color: white;
    font-size: 15px;
    cursor: pointer;
    border-radius: 6px;
    font-family: 'Times New Roman', Times, serif;
    margin-top: 20px;
    margin-left: 600px;

}

    </style>
</head>
<body>
    <?php include "includes/header.html"; ?>
    <div class=outmost>
    <img src="success.png" alt="singned-up successfully">
    <h5>Your submission has been sent<br> successfully.</h5>
    <a href="login.php">
    <input type="submit" value="Log in">
    </a>
    </div>
    <?php include "includes/footer.html"?>

</body>
</html>