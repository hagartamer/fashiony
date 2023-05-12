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
        rel="stylesheet" />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="Payment.css">

    <title>Payment</title>


</head>

<body>
    <!--start header-->
    <?php include "includes/header.html"; ?>
    <!--end header-->

    <!-- start payment -->

    <div class="outmost">
        <form action="">
            <div class="pay">
                <div class="col111">
                    <h3>Billing Address</h3>

                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fname">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                    <label for="adress">Adress</label>
                    <input type="text" id="adress" name="aderss">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city">
                    <div class="flix1">
                        <div class="inbox">
                            <label for="State">State</label>
                            <input type="text" id="State" name="State">

                        </div>
                        <div class="inbox">
                            <label for="zip code">zip code</label>
                            <input type="text" id="zip code" name="zip code">

                        </div>

                    </div>
                </div>

                <div class="col1111">
                    <h3>Payment</h3>

                    <label for="fname">Accepted cards</label>
                    <img src="pay.png" alt="Credit">
                    <label for="lname">Name on card</label>
                    <input type="text" id="lname" name="lname">
                    <label for="adress">Credit card number</label>
                    <input type="text" id="adress" name="aderss">
                    <label for="city">Exp month</label>
                    <input type="text" id="city" name="city">
                    <div class="flix1">
                        <div class="inbox">
                            <label for="State">Exp year</label>
                            <input type="text" id="State" name="State">

                        </div>
                        <div class="inbox">
                            <label for="zip code">CVV</label>
                            <input type="text" id="zip code" name="zip code">

                        </div>
                    </div>
                </div>

            </div>

            <input type="submit" value="Submit">

        </form>

    </div>



    <!-- end payment -->

    <!-- footer -->
    <?php include "includes/footer.html"; ?>
    <!--end footer-->
    
    <script src="index.js"></script>
</body>

</html>