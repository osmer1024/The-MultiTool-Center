<?php
  include 'php/db_conn.php';
  include 'php/placeOrder.php';

  if(!isset($_SESSION['email'])){
    header('location:./index.php');
    die;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/styles.css">
  <!--CHECK!!!--><link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
  <title>Home</title>
</head>
<body>
  <!--Nav Bar-->
  <nav class="navbar navbar-expand-lg navbar-light border-bottom border-light sticky-top">
    <!--logo-->
    <img class="mainlogo my-auto" src="./images/logo.png" alt="logo">
    <!--collapse button-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="collapsibleNavbar">
      <!--nav content-->
      <ul class="navbar-nav">
        <!--spacer--> 
        <li class="nav-item my-auto mr-5">
          <div id="navbarSpacer"></div>
        </li>

        <!--text-->
        <li class="nav-item my-auto">
          <h3>Shopping</h3>
        </li> 

        <!--cart container-->
        <li class="nav-item my-auto" id="cartButton">
          <div class="btn-group rounded cartGroup border border-dark" role="group">
            <img src="./images/cart.png" alt="cart icon">
            <input id="cartCounter" type="text" disabled value="0">
          </div>
        </li>

        <!--account container-->
        <li class="nav-item my-auto">
          <div class="btn-group rounded accountGroup border border-dark" id="accountButton" role="group">
            <img src="./images/account.png" alt="user icon">
            <input id="cartCounter" type="text" disabled value="<?php echo($_SESSION["fname"]. ' '. $_SESSION["lname"]) ?>">
          </div>
          <br>
          <div class="bg-info rounded border border-dark" role="group" id="signOutButton">
            <a href="./php/logout.php" style="text-decoration: none"><h3>Sign Out</h3></a>            
          </div>
        </li>
      </ul>
    </div>  
  </nav>

  <!--shopping items-->

  <div class="container-fluid" id="shoppingHomePage">
    <div class="row">
      <div class="col-sm-6 multitoolItem">
        <!--item 1-->
        <div class="card">
          <div class="row">
            <!--item name & image-->
            <div class="col-lg-6">
              <h2 class="toolName">Heritage</h2>
              <img class="toolImage" id="HeritageImage" src="./images/heritage-supertool-300.jpg" alt="multitool">
            </div>
            <!--item description and purchase-->
            <div class="col-lg-6">
              <h4>Description</h4>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque tempora facilis ipsam itaque enim suscipit, aut excepturi iste, mollitia ullam delectus dolore placeat fugit doloribus earum dignissimos, possimus illo?</p>
              <p class="toolPriceBox">$<span id="HeritagePrice">45.00</span></p>
              <hr>
              <!--add to cart-->
              <div class="row">  
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control amountInput" type="number" id="HeritageInput">
                    <div class="input-group-append">
                      <button class="btn btn-primary" onclick="queueItemNew('Heritage')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 multitoolItem">
        <!--item 2-->
        <div class="card">
          <div class="row">
            <!--item name & image-->
            <div class="col-lg-6">
              <h2 class="toolName">Supertool 300m</h2>
              <img class="toolImage" id="SupertoolImage" src="./images/supertool-300m-black-fanned.jpg" alt="multitool">
            </div>
            <!--item description and purchase-->
            <div class="col-lg-6">
              <h4>Description</h4>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque tempora facilis ipsam itaque enim suscipit, aut excepturi iste, mollitia ullam delectus dolore placeat fugit doloribus earum dignissimos, possimus illo?</p>
              <p class="toolPriceBox">$<span id="SupertoolPrice">42.00</span></p>
              <hr>
              <!--add to cart-->
              <div class="row">  
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control amountInput" type="number" id="SupertoolInput">
                    <div class="input-group-append">
                      <button class="btn btn-primary" onclick="queueItemNew('Supertool')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6 multitoolItem">
        <!--item 1-->
        <div class="card">
          <div class="row">
            <!--item name & image-->
            <div class="col-lg-6">
              <h2 class="toolName">Skeletool</h2>
              <img class="toolImage" id="SkeletoolImage" src="./images/skeletool-silver-fanned.jpg" alt="multitool">
            </div>
            <!--item description and purchase-->
            <div class="col-lg-6">
              <h4>Description</h4>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque tempora facilis ipsam itaque enim suscipit, aut excepturi iste, mollitia ullam delectus dolore placeat fugit doloribus earum dignissimos, possimus illo?</p>
              <p class="toolPriceBox">$<span id="SkeletoolPrice">38.00</span></p>
              <hr>
              <!--add to cart-->
              <div class="row"> 
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control amountInput" type="number" id="SkeletoolInput">
                    <div class="input-group-append">
                      <button class="btn btn-primary" onclick="queueItemNew('Skeletool')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 multitoolItem">
        <!--item 2-->
        <div class="card">
          <div class="row">
            <!--item name & image-->
            <div class="col-lg-6">
              <h2 class="toolName">Mut Fanned</h2>
              <img class="toolImage" id="MutImage" src="./images/mut-eod-fanned.jpg" alt="multitool">
            </div>
            <!--item description and purchase-->
            <div class="col-lg-6">
              <h4>Description</h4>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque tempora facilis ipsam itaque enim suscipit, aut excepturi iste, mollitia ullam delectus dolore placeat fugit doloribus earum dignissimos, possimus illo?</p>
              <p class="toolPriceBox">$<span id="MutPrice">48.00</span></p>
              <hr>
              <!--add to cart-->
              <div class="row">  
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control amountInput" type="number" id="MutInput">
                    <div class="input-group-append">
                      <button class="btn btn-primary" onclick="queueItemNew('Mut')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-6 multitoolItem">
        <!--item 1-->
        <div class="card">
          <div class="row">
            <!--item name & image-->
            <div class="col-lg-6">
              <h2 class="toolName">Surge</h2>
              <img class="toolImage" id="SurgeImage" src="./images/surge-fanned.jpg" alt="multitool">
            </div>
            <!--item description and purchase-->
            <div class="col-lg-6">
              <h4>Description</h4>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque tempora facilis ipsam itaque enim suscipit, aut excepturi iste, mollitia ullam delectus dolore placeat fugit doloribus earum dignissimos, possimus illo?</p>
              <p class="toolPriceBox">$<span id="SurgePrice">35.00</span></p>
              <hr>
              <!--add to cart-->
              <div class="row"> 
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control amountInput" type="number" id="SurgeInput">
                    <div class="input-group-append">
                      <button class="btn btn-primary" onclick="queueItemNew('Surge')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 multitoolItem">
        <!--item 2-->
        <div class="card">
          <div class="row">
            <!--item name & image-->
            <div class="col-lg-6">
              <h2 class="toolName">Wingman</h2>
              <img class="toolImage" id="WingmanImage" src="./images/wingman-silver-fanned.jpg" alt="multitool">
            </div>
            <!--item description and purchase-->
            <div class="col-lg-6">
              <h4>Description</h4>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque tempora facilis ipsam itaque enim suscipit, aut excepturi iste, mollitia ullam delectus dolore placeat fugit doloribus earum dignissimos, possimus illo?</p>
              <p class="toolPriceBox">$<span id="WingmanPrice">32.00</span></p>
              <hr>
              <!--add to cart-->
              <div class="row">
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control amountInput" type="number" id="WingmanInput">
                    <div class="input-group-append">
                      <button class="btn btn-primary" onclick="queueItemNew('Wingman')">Add to Cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!--Cart Form-->
  <div class="container-fluid topWindow" id="shoppingCartContainer">
    <h1 class="toolName">Shopping Cart</h1>
    <div class="container-fluid rounded cartListContainer">
      <!--cart header-->
      <div class="row" id="cartHeader">
        <div class="col-sm-6">
          Product
        </div>
        <div class="col-sm-2">
          Quantity
        </div>
        <div class="col-sm-2">
          Price
        </div>
        <div class="col-sm-2">
          Action
        </div>
      </div>
      <hr>

      <!--Shopping list-->
      <div class="row" id="cartList">
        <!--Dynamic Data inserted here-->
      </div>

      <hr>
      <!--list total-->
      <div class="row">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-2">
          TOTAL:
        </div>
        <div class="col-sm-2">
          <h3 id="cartTotal">$0.00</h3>
        </div>
        <div class="col-sm-2">
        </div>
      </div>
      <br>
      <!--Lower buttons-->
      <div class="row">
        <div class="col-sm-6">
          <button class="btn btn-primary mx-auto" id="closeCart">Continue Shopping</button>
        </div>
        <div class="col-sm-6">
          <button class="btn btn-dark mx-auto" id="cashout">Checkout</button>
        </div>
      </div>
    </div>
  </div>



  <!--Checkout Form-->
  <div class="container-fluid topWindow" id="checkoutContainer">
    <h1 class="toolName">Checkout</h1>
    <div class="container-fluid rounded cartListContainer">
      <form class="row" id="checkoutBill">
        <!--purchase Summary Section-->
        <h2 class="col-md-12">Purchase Summary</h2>
        <div class="col-sm-3">
          <label for="cartAm" class="form-label">Items in Cart</label>
          <input type="text" class="form-control" id="cartAm" value="0" disabled>
        </div>
        <div class="col-sm-3">
          <label for="gTotal" class="form-label">Subtotal (BZD)</label>
          <input type="text" class="form-control" id="subTotal" value="$0.00" disabled>
        </div>
        <div class="col-sm-3">
          <label for="gTotal" class="form-label">GST (12%)</label>
          <input type="text" class="form-control" id="gst" value="$0.00" disabled>
        </div>
        <div class="col-sm-3">
          <label for="gTotal" class="form-label">Total (BZD)</label>
          <input type="text" class="form-control" id="gTotal" value="$0.00" disabled>
        </div>
        
        <hr class="col-sm-10">
        <br class="col-sm-12">

        <!--Profile Section-->
        <h2 class="col-md-12">Your Profile</h2>
        <div class="col-sm-1">
          <label for="buyersID" class="form-label">Your ID</label>
          <input type="text" class="form-control" id="buyersID" disabled value="<?php echo($_SESSION['uid']) ?>">
        </div>
        <div class="col-sm-4">
          <label for="buyersName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="buyersName" disabled value="<?php echo($_SESSION['fname'].' '.$_SESSION['lname']) ?>">
        </div>
        <div class="col-sm-4">
          <label for="buyersEAdd" class="form-label">Email Address</label>
          <input type="text" class="form-control" id="buyersEAdd" disabled value="<?php echo($_SESSION['email']) ?>">
        </div>
        <div class="col-sm-3">
          <label for="buyersPhone" class="form-label">Phone Number</label>
          <input type="text" class="form-control" id="buyersPhone" value="<?php echo($_SESSION['phone']) ?>">
        </div>

        <hr class="col-sm-10">
        <br class="col-sm-12">

        <!--Address Section-->
        <h2 class="col-md-12">Delivery Address</h2>
        <div class="col-sm-7">
          <label for="buyersAddress1" class="form-label">Address 1</label>
          <input type="text" class="form-control" disabled id="buyersAddress1" value="<?php echo($_SESSION['address']) ?>">
        </div>
        <div class="col-sm-5">
          <label for="buyersDistrict1" class="form-label">District</label>
          <input type="text" class="form-control" disabled id="buyersDistrict1" value="<?php echo($_SESSION['district']) ?>">
        </div>
        <div class="col-sm-7">
          <label for="buyersAddress2" class="form-label">Address 2 (I Prefer this place)</label>
          <input type="text" class="form-control" id="buyersAddress2">
        </div>
        <div class="col-sm-5">
          <label for="buyersDistrict2" class="form-label">District</label>
          <br>
          <select class="form-select" id="buyersDistrict2" aria-label="Default select example">
            <option selected>Select District</option>
            <option value="czl">Corozal</option>
            <option value="ow">Orange Walk</option>
            <option value="bz">Belize</option>
            <option value="cy">Cayo</option>
            <option value="sc">Stann Creek</option>
            <option value="tld">Toledo</option>
          </select>
        </div>
        <hr class="col-sm-10">
        <br class="col-sm-12">
        
        <!--Payment Section-->
        <h2 class="col-md-12">Payment</h2>
        <div class="custom-control custom-radio  col-md-4">
          <input type="radio" name="paymentMethod" value="credit" checked>
          <label for="credit">Credit card</label>
        </div>
        <div class="custom-control custom-radio col-md-4">
          <input type="radio" name="paymentMethod" value="debit">
          <label for="debit">Debit card</label>
        </div>
        <div class="custom-control custom-radio col-md-4">
          <input type="radio" name="paymentMethod" value="paypal">
          <label for="paypal">Paypal</label>
        </div>
        <br class="col-md-12">
        <hr class="col-sm-10">

        <div class="col-md-6 mb-3">
          <label for="cc-name">Name on card</label>
          <input type="text" class="form-control" id="hldrName" placeholder="" required>
          <small class="text-muted">Full name as displayed on card</small>
        </div>
        <div class="col-md-6 mb-3">
          <label for="cc-number">Credit card number</label>
          <input type="number" class="form-control" id="hldrNumber" placeholder="" required>
        </div>
        <hr class="col-sm-10">
        <br class="col-sm-12">

        <!--Lower Button Section-->
        <div class="col-md-6">
          <input id="cancelCheckout" class="btn btn-danger col-md-6" value="Cancel">
        </div>
        <div class="col-md-6">
          <button id="formLog" class="btn btn-primary col-md-6">Finish Checkout</button>
        </div>
      </form>
    </div>
    <br>
  </div>

</body>
<script src="./js/home.js?v=<?php echo time(); ?>"></script>
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
</script> 
</html>