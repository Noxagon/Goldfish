<?php include('register-server.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Goldfish - Register</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <!-- Additional CSS -->
        <link href="register-styles.css" rel="stylesheet" />
    </head>
    <body id="page-top" onload="checkCookie()">
        <!-- Navigation-->
        <?php include "../utils/navbar.php"; ?>

        <div class="container">
            <div class="row">
              <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                  <div class="card-body">
                    <h5 class="card-title text-center">Login</h5>
                    <form id="loginForm" class="form-signin" method="post" action="login_page.php">
                    <hr class="my-4">
                    
                      <div class="form-label-group">
                        <input type="text" name="inputNRICFIN" id="inputNRICFIN" class="form-control" placeholder="NRIC/FIN" autofocus></input>
                        <label for="inputNRICFIN">NRIC/FIN</label>
                      </div>
        
                      <div class="form-label-group">
                        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password"/>
                        <!-- onfocus="this.value=''" value="********"  -->
                        <label for="inputPassword">Password</label>
                      </div>
        
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember password</label>
                      </div>

                      <?php include('register-errors.php'); ?>
                      <hr class="my-4">

                      <button id="sign-in-button" class="btn btn-lg btn-primary btn-block text-uppercase" name="login_user" type="submit" disabled>Sign in</button>
                      <a class="btn btn-lg btn-secondary btn-block text-uppercase" href="register_page.php">Or Register here</a>
                      <!-- <hr class="my-4">
                      <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
                      <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <?php include "../utils/footer.php"; ?>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="../assets/mail/jqBootstrapValidation.js"></script>
        <script src="../assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="../js/login-scripts.js"></script>
    </body>
</html>
