<?php
$category = $_GET['category'];
$i = $_GET['id'];
$xmlDoc = new DOMDocument();

if (isset($category)) {
    switch ($category) {
        case "GR":
            $xmlDoc->load("../xml/grocery.xml");
            break;
        case "HW":
            $xmlDoc->load("../xml/health.xml");
            break;
        case "HL":
            $xmlDoc->load("../xml/home.xml");
            break;
    }
    
    $xa = $xmlDoc->getElementsByTagName('NAME');
    $ya = $xa-> item($i);
    
    $xb = $xmlDoc->getElementsByTagName('POINTS');
    $yb = $xb-> item($i);
    
    $xc = $xmlDoc->getElementsByTagName('URL');
    $yc = $xc-> item($i);
    
    $xd = $xmlDoc->getElementsByTagName('COUNTRY');
    $yd = $xd-> item($i);
    
    $xe = $xmlDoc->getElementsByTagName('INFO');
    $ye = $xe-> item($i);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Goldfish</title>
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
        <link href="../css/reward-styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php include '../utils/navbar.php'; ?>     

        <!-- Page Content -->
        <div class="container">

            <div class="row">

            <div class="col-lg-3">
            <h1 class="my-4">Categories</h1>
                <div class="list-group">
                    <a href="grocery_products.php" class="list-group-item <?php if($category=="GR") echo "active"; ?>"><h5>Groceries</h5></a>
                    <a href="health_products.php" class="list-group-item <?php if($category=="HW") echo "active"; ?>"><h5>Health & Wellcare</h5></a>
                    <a href="home_products.php" class="list-group-item <?php if($category=="HL") echo "active"; ?>"><h5>Home & Lifestyle</h5></a>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="card mt-4">
                <img class="card-img-top img-fluid" src="<?php echo "{$yc->nodeValue}"; ?>" alt="">
                <div class="card-body">
                    <hr/>
                    <h3 class="card-title"><?php echo "{$ya->nodeValue}"; ?></h3>
                    <h4><i class="fab fa-bitcoin"></i> <?php echo "{$yb->nodeValue}"; ?> Points</h4>
                    <hr/>
                    <p class="card-text"><b>Key Information:</b><br/> <?php echo "{$ye->nodeValue}"; ?></p>
                    <p class="card-text" style="margin-bottom: 0.5rem;"><b>Country of Origin:</b><br/> <?php echo "{$yd->nodeValue}"; ?></p>
                    <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span> 4.0 stars
                </div>
                </div>
                <!-- /.card -->

                <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Product Reviews
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                    <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                    <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                    <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                    <hr>
                    <a href="#" class="btn btn-success">Leave a Review</a>
                </div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col-lg-9 -->

            </div>

        </div>
        <!-- /.container -->

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
        <script src="../js/rewards-scripts.js"></script>
    </body>
</html>
