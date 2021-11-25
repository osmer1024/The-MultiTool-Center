<?php
    include 'php/db_conn.php';
    include 'php/db_register.php';
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
    <link rel="stylesheet" href="css/styles.css">
    <!--CHECK!!!--><link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <title>Login/Register</title>
</head>
<body>
  <div class="container-fluid signin_register_form">
    <div class="row">
      <!--left area-->
      <div class="col-sm-6 border-right border-primary my-auto">
        <h1 class="title">Welcome To <br> The Multitool Center</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" id="logBtn">Log In</button>
            <button type="button" class="btn btn-light" id="regBtn">Register</button>
        </div>
      </div>
      <!--right area-->
      <div class="col-sm-6 my-auto">
        <!--login area-->
        <div id="loginSec">
          <h2>Log In</h2>
          <div class="row">
            <div class="col-md-8 mx-auto">
              <input class="form-control" type="text" id="signEmail" placeholder="Email Address">
            </div>
            <div class="col-md-8 mx-auto">
              <input class="form-control" type="password" id="signPass" placeholder="Password">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button id="signIn" class="btn btn-primary">Continue</button>
            </div>
            <div class="col-md-12">
              <br>
              <span id="accountMismatch" class="alert alert-danger">Sorry, we couldn't find that account.</span>
            </div>
            <div class="col-md-12">
              <br>
              <span id="accountIncomplete" class="alert alert-danger">Seems there's something missing.</span>
            </div>
          </div>
        </div>
        <!--register area-->
        <div id="registerSec">
          <h2>Create An Account</h2>                  
          <br>
          <div class="row">
            <label class="regLabel">Let's get to know a bit about you...</label>
            <hr class="col-lg-10">

            <div class="col-lg-6">
              <label for="fname">First Name</label><br>
              <input class="form-control registFormBox" type="text" id="fname" placeholder="John" >
            </div>
            <div class="col-lg-6">
              <label for="lname">Last Name</label><br>
              <input class="form-control registFormBox" type="text" id="lname" placeholder="Doe">
            </div>

            <div class="col-lg-8">
              <label for="fname">Address</label><br>
              <input class="form-control registFormBox" type="text" id="add" placeholder="Street Address or Village Name" >
            </div>
            <div class="col-lg-4">
              <label for="fname">District</label><br>
              <select class="form-select" id="dist" aria-label="Default select example">
                <option value="czl">Corozal</option>
                <option value="ow">Orange Walk</option>
                <option value="bz">Belize</option>
                <option value="cy">Cayo</option>
                <option value="sc">Stann Creek</option>
                <option value="td">Toledo</option>
              </select>
            </div>

            <label class="regLabel">Account details</label>
            <hr class="col-lg-10">

            <div class="col-lg-8">
              <label for="regEAddr">Email Address</label><br>
              <input class="form-control registFormBox" type="email" id="regEAddr" required placeholder="jd@outlook.com">
            </div>
            <div class="col-lg-4">
              <label for="pNum">Phone Number</label><br>
              <input class="form-control registFormBox" type="tel" pattern="[0-9]{3}-[0-9]{4}" id="pNum" required placeholder="654-0000">
            </div>

            <div class="col-lg-6">
              <label for="passField">Password</label><br>
              <input class="form-control registFormBox" type="password" id="passField" placeholder="Password">
            </div>
            <div class="col-lg-6">
              <label for="confField">Confirm Password</label><br>
              <input class="form-control registFormBox"  type="password" id="confField" placeholder="Confirm Password">
            </div>

            <div class="col-md-12">
              <!--<input id="createAccount" type="submit" class="btn btn-primary">-->
              <button id="createAccount" class="btn btn-primary">Create</button>
            </div>                        
            <div class="col-md-12">
              <br>
              <span id="passWarning" class="alert alert-danger">Oops! Passwords don't match!</span>
            </div>
            <div class="col-md-12">
              <br>
              <span id="fillWarning" class="alert alert-danger">Seems there's something missing.</span>
            </div>
            <div class="col-md-12">
              <br>
              <span id="emailWarning" class="alert alert-danger">Oh uh! This email has been used.</span>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</body>
<script src="js/main.js?v=<?php echo time(); ?>"></script>
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
</script> 
</html>