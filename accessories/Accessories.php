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
    <title>products</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Shadows+Into+Light&family=Sofia+Sans+Condensed:ital,wght@0,1;0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,1;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Work+Sans:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="dynamic.css">
</head>
<body>

    <!--start header-->
    <?php include "includes/header.html"; ?>
    <!--end header-->

    <p class="p1">
        <?php
        if($flag==1)
        {
            switch ($key)
            {
                case "category":
                    echo $value."'s products";
                    break;
                case "sale":
                    //code
            }
        }
        ?>
    </p>

    <form action="" method="get">
        <?php
        if($flag==1)
        echo "<input type=\"hidden\" name='$key' value='$value'>";
        ?>
        <div class="filter-box">
            <div class="label">
                Filter products to quickly find what you need?
            </div>
            <div class="select-container">
                <select name="name" id="name">
                    <option selected disabled>Accessories</option>
                    <option value="sunglasses">Sunglasses</option>
                    <option value="hat">Hat</option>
                    <option value="watch">Hand watch</option>
                    <option value="Necktie">Necktie</option>
                    <option value="bag">bag</option>
                    <option value="wallet">Wallet</option>
                    <option value="belt">Belt</option>
                    <option value="bracelet">Bracelet</option>


                </select>
            </div>
    
            <div class="select-container">
                <select name="price" id="price">
                    <option selected disabled>Price</option>
                    <option value="100">less than 20$</option>
                    <option value="150">less than 40$</option>
                    <option value="50">less than 60$</option>
                </select>
            </div>

            <div class="submit">
                <button type="submit" name="apply">apply</button>
            </div>
        </div>
    </form>
    <div class="products">
        <div class="container">
            <?php
            if($flag==1)
            {
                //initial query string based on homepage requests
                $sql="select* from product where $key='$value'";
                //detect if the filter button is pressed or not
                //if pressed the query string is updated according to the user needs
                if(isset($_GET["apply"]))
                {
                    if(isset($_GET["name"]))
                    {
                        if($_GET["name"]=="others")
                        $sql=$sql." and name not like '%blouse%' and name not like '%t-shirt%' and name not like '%pants%'";
                        else
                        $sql=$sql." and name like'%".$_GET["name"]."%'";

                    }
                    if (isset($_GET["brand"]))
                    $sql=$sql." and brand='".$_GET["brand"]."'";
                    if(isset($_GET["price"]))
                    $sql=$sql." and price <= '".$_GET["price"]."'";
                }

                $sql=$sql." order by arrival_date desc;";
                //sending the query string to database and receiving the results
                //products data(img_url, brand, name, price) for all matching products will be stored in $result
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0)
                {
                    for($i<0;$i<mysqli_num_rows($result);$i++)
                    {
                        $product=mysqli_fetch_assoc($result);
                        $id=$product["product_id"];
                        $img=$product["img_url"];
                        $brand=$product["brand"];
                        $name=$product["name"];
                        $price=$product["price"];
                        echo"
                        <div class=\"pro-box\">
          <div class=\"pro\">
            <a href=\"product-details.php?id=$id\"><img src=\"$img\" alt=\"\" /></a>
            <div class=\"description\">
              <span>$brand</span>
              <h5>$name</h5>
              
            </div>
            <div class=\"cart\">
              <a href=\"#\"><svg
                xmlns=\"http://www.w3.org/2000/svg\"
                width=\"25\"
                height=\"25\"
                fill=\"currentColor\"
                class=\"bi bi-cart-check\"
                viewBox=\"0 0 16 16\"
              >
                <path
                  d=\"M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z\"
                />
                <path
                  d=\"M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z\"
                />
              </svg></a>
            </div>
          </div>
        </div>
                        ";
                    }   
                }
            }
            ?>
        </div>
    </div>
    
    <!-- footer -->
    <?php include "includes/footer.html"; ?>
    <!--end footer-->
    <?php
var_dump($_GET);
?>

<script src="index.js"></script>

</body>
</html>
