<?php
// AJAX -PHP - XML (Jaron)
$xmlDoc = new DOMDocument();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = substr($id, 0, 2);
    $index = substr($id, -1);

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
    $ya = $xa-> item($index);
    
    $xb = $xmlDoc->getElementsByTagName('POINTS');
    $yb = $xb-> item($index);
    
    $xc = $xmlDoc->getElementsByTagName('URL');
    $yc = $xc-> item($index);
    
    $xd = $xmlDoc->getElementsByTagName('COUNTRY');
    $yd = $xd-> item($index);
    
    $xe = $xmlDoc->getElementsByTagName('INFO');
    $ye = $xe-> item($index);
} else {
    exit('Invalid page ID.');
}

// Reviews system + SQL (Jaron)
try {
    $pdo = mysqli_connect('localhost', 'root', '', 'goldfish', '3308');
} catch (PDOException $exception) {
    exit('Failed to connect to database!');
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

if (isset($_GET['id'])) {
    if (isset($_POST['name'], $_POST['rating'], $_POST['content'])) {
        // Insert a new review (user submitted form)
        $stmt = $pdo->prepare('INSERT INTO reviews (page_id, name, content, rating, submit_date) VALUES (?,?,?,?,NOW())');
        $stmt->execute([$_GET['id'], $_POST['name'], $_POST['content'], $_POST['rating']]);
        exit('Your review has been submitted!');
    }
    
    // Get all reviews by the Page ID ordered by the submit date
    $stmt = $pdo->prepare('SELECT * FROM reviews WHERE page_id = ? AND ORDER BY submit_date DESC');
    // $stmt -> bind_param("sss", $firstname, $lastname, $email);

    // $stmt->execute([$_GET['id']]);
    // $reviews = $stmt->fetch(PDO::FETCH_ASSOC);
    // // Get the overall rating and total amount of reviews
    // $stmt = $pdo->prepare('SELECT AVG(rating) AS overall_rating, COUNT(*) AS total_reviews FROM reviews WHERE page_id = ?');
    // $stmt->execute([$_GET['id']]);
    // $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('Invalid page ID.');
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
        <link href="../css/product-styles.css" rel="stylesheet" />
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

            <div class="col-lg-8">

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
                        Product Ratings
                    </div>
                    <span class="heading" style="margin-top: 0.5rem; margin-left: 1rem;">User Rating</span>
                    <span class="heading" style="margin-left: 1rem;"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></span>
                    <p style="margin-top: 0.5rem; margin-left: 1rem;">4.1 average based on 254 reviews.</p>
                    <hr style="border:3px solid #f1f1f1">

                    <div class="row-ratings">
                        <div class="side">
                            <div>5 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                            <div class="bar-5"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>150</div>
                        </div>
                        <div class="side">
                            <div>4 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                            <div class="bar-4"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>63</div>
                        </div>
                        <div class="side">
                            <div>3 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                            <div class="bar-3"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>15</div>
                        </div>
                        <div class="side">
                            <div>2 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                            <div class="bar-2"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>6</div>
                        </div>
                        <div class="side">
                            <div>1 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                            <div class="bar-1"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>20</div>
                        </div>
                    </div>
                </div>

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
                    <form id="reviewForm" name="reviewForm">
                        <textarea class="form-control" id="reviewMessage" name="reviewMessage" rows="3" placeholder="Message" required="required" data-validation-required-message="Please enter a message." style="margin-bottom: 0.5rem;"></textarea>
                        <span class="heading"><i id="star1" onmouseover="color(1)" onmouseout="nocolor()" class="fa fa-star"></i> <i id="star2" onmouseover="color(2)" onmouseout="nocolor()" class="fa fa-star"></i> <i id="star3" onmouseover="color(3)" onmouseout="nocolor()" class="fa fa-star"></i> <i id="star4" onmouseover="color(4)" onmouseout="nocolor()" class="fa fa-star"></i> <i id="star5" onmouseover="color(5)" onmouseout="nocolor()" class="fa fa-star"></i></span>
                        <p class="help-block text-danger" style="margin-bottom: 0.5rem;"></p>
                        <button class="btn btn-primary" id="sendMessageButton" disabled>Leave a Review</button>
                    </form>
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
        <script>
            var inputReview = document.getElementById("reviewMessage");

            const reviewHandler = function(e) {
                if (e.target.value.length > 0) {
                    document.getElementById("sendMessageButton").disabled = false;
                } else {
                    document.getElementById("sendMessageButton").disabled = true;
                }
            }

            inputReview.addEventListener('input', reviewHandler);
            inputReview.addEventListener('propertychange', reviewHandler);

            function color(num) {
                switch (num) {
                    case 5:
                        document.getElementById("star5").style.color = "orange";
                    case 4:
                        document.getElementById("star4").style.color = "orange";
                    case 3:
                        document.getElementById("star3").style.color = "orange";
                    case 2:
                        document.getElementById("star2").style.color = "orange";
                    case 1:
                        document.getElementById("star1").style.color = "orange";
                        break;
                }
            }

            function nocolor() {
                document.getElementById("star5").style.color = "black";
                document.getElementById("star4").style.color = "black";
                document.getElementById("star3").style.color = "black";
                document.getElementById("star2").style.color = "black";
                document.getElementById("star1").style.color = "black";
            }
        </script>
    </body>
</html>
