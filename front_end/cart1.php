<?php
//code to connect to out database
$serverName="localhost";
$userName="root";
$passName="";
$databaseName="shopping_db";
$conn=mysqli_connect($serverName,$userName,$passName,$databaseName);
//testing if the connection failed or not
if(!$conn)
die("connection failed ".mysqli_connect_error());

//code to detect which button in the homepage was pressed
$arr=array("category","sale");
$flag=0;
for($i=0;$i<count($arr);$i++)
{
    $key=$arr[$i];
    if(isset($_GET[$key]))
    {
        $flag=1;
        $value=$_GET[$key];
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Shadows+Into+Light&family=Sofia+Sans+Condensed:ital,wght@0,1;0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,1;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Work+Sans:wght@300&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="cart1.css">
</head>

<body>

    <!--start header-->
    <?php include "includes/header.html"; ?>
    <!--end header-->

    <br>
    <br><br><br><br>
    <!-- start products -->
    <table class="table1">
        <tr>
            <th>Product</th>
            <th class="dash">Brand</th>
            <th class="dash">price</th>
            <th class="dash">Sale</th>
        



        </tr>
        <tr>
            <td>White T-shirt</td>
            <td class="dash">LC Waikiki</td>
            <td class="dash">50$</td>
            <td class="dash">10%</td>
            <td class="dash1"> <input type="submit" value="Delete"> </td>



        </tr>

    </table>
    <div class="buy">
        <input type="submit" value="Buy Now">
    </div>
    <br><br><br>
    <!-- end products -->


    <!-- footer -->
    <?php include "includes/footer.html"; ?>
    <!--end footer-->
    <?php
var_dump($_GET);
?>

    <script src="index.js"></script>

</body>

</html>