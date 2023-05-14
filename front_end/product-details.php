<?php
include "includes/connection.php";

//starting a session or resuming an existing one
session_start();

//function to filter input-data
function clean($input)
{
  $input=trim($input);
  $input=htmlspecialchars($input);
  return $input;
}

//check if the query string: (?id=somevalue) is existent in the requesting url or not
if(isset($_GET["id"]))
{
  $id=$_GET["id"];
  $sql="select* from product where product_id= $id ;"; 
  $result=mysqli_query($conn,$sql);
  //check if such an id is valid or not
  if(mysqli_num_rows($result))
  {
    $row=mysqli_fetch_assoc($result);
    $name=$row["name"];
    $img1=$row["img_url_o"];
    $img2=$row["img_url_f"];
    $img3=$row["img_url_b"];
    $color=$row["color"];
    $material=$row["material"];
    $brand=$row["brand"];
    $price=$row["price"];
    $sale=$row["sale"];
  }
  //if not valid die out
  else
  die("no such product id is existent");
}
else
die("error occured");

//processing_reveiws
if(isset($_POST["add_a_review"]))
{
  if(isset($_SESSION["client_id"]))
  {
    $client_id=$_SESSION["client_id"];
    if(isset($_POST["title"]))
    $title=clean($_POST["title"]);
    if(isset($_POST["string"]))
    $string=clean($_POST["string"]);
    if($title!=NULL && $string!=NULL)
    {
      $sql="insert into reviews(client_id,product_id,review_title,review_string) values('$client_id','$id','$title','$string');";
      mysqli_query($conn,$sql);
    }
  }
  else
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
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
    <title>Product-Details</title>
  </head>
  <body>
   <!--start header-->
   <?php 
  //  include "includes/header.html";
    ?>
    <!--end header-->   
  <section class="product-detail">
    <div class="img-container">
        <img src="<?php echo $img1;?>" alt="" class="big-img" />
        <div class="three-img">
          <a href="#"><img src="<?php echo $img1;?>" alt="" srcset=""></a>

          <?php
          $sql="select product_id from product where img_url_o='$img2';";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result))
          {
            $row=mysqli_fetch_assoc($result);
            $id2=$row["product_id"];
            $link2="product-details.php?id=".$id2;
          }
          else
          $link2="#";
          ?>
          
          <a href="<?php echo $link2;?>"><img src="<?php echo $img2;?>" alt="" srcset=""></a>

          <?php
          $sql="select product_id from product where img_url_o='$img3';";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result))
          {
            $row=mysqli_fetch_assoc($result);
            $id3=$row["product_id"];
            $link3="product-details.php?id=".$id3;
          }
          else
          $link2="#";
          ?>

          <a href="<?php echo $link3; ?>"><img src="<?php echo $img3;?>" alt="" srcset=""></a>
        </div>
    </div>
    <div class="details">
      <h1 class="product-title"><?php echo $name;?></h1>
      <br>
      <p class="product-info">
        This product is of <?php echo $brand;?> brand.<br>
        It is a high quality product made of <?php echo $material;?>. <br>
        It is available with <?php echo $color;?> color.<br>
        It costs only <?php echo $price;?>$.<br>
        However, you could get it with <?php echo $sale*100;?>% sale.
      </p>
      <div class="btn-container">
        <button class="product-cart-btn">Add to Cart</button>
      </div>
    </div>
  </section>

  <!--review section-->
  <section class="review-section">
    <h1 class="review-head">Reviews</h1>
    <div class="review-container">
      <?php
      $sql="select* from reviews where product_id=$id;";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>0)
      {
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
          $row=mysqli_fetch_assoc($result);
          $review_title=$row["review_title"];
          $review_string=$row["review_string"];
          $client_id=$row["client_id"];
          $sql="select first_name , last_name from client where client_id=$client_id;";
          $result=mysqli_query($conn,$sql);
          $row=mysqli_fetch_assoc($result);
          $first_name=$row["first_name"];
          $last_name=$row["last_name"];
          echo "
          <div class=\"review-card\">
          <div class=\"user-name\"><h2>$first_name $last_name</h2></div>
          <h3 class=\"review-title\">$review_title</h3>
          <p>
            $review_string
          </p>
        </div>
          ";
        }
      }
      else 
      echo "
      <div>
        <h3>UP to now, no reveiws for this unit.</h3>
      </div>
      ";
      ?>
    </div>
  </section>
  <!--end section-->
  <!--add review form-->
  <section class="add-review">
    <h1>Add a Review</h1>
    <form action="" method="post">
    <input
      type="text"
      class="review-headline"
      placeholder="review headline"
      name="title"
    />
    <textarea placeholder="Add a Review" class="review-field" name="string"></textarea>
  
    <button class="add-review-btn" type="submit" name="add_a_review">Add Review</button>
    </form>
  </section>

    <!-- footer -->
    <?php include "includes/footer.html"; ?>
    <!--end footer-->


  <script src="index.js"></script>
  </body>