<?php
include '../utils/navbar.php';

// AJAX -PHP - XML (Jaron)
$xmlDoc = new DOMDocument();
$db = new mysqli('localhost', 'root', '', 'goldfish', '3308');

if ($db->connect_errno) {
    die('Failed to connect to database!');
}

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
    $ya = $xa->item($index);

    $xb = $xmlDoc->getElementsByTagName('POINTS');
    $yb = $xb->item($index);

    $xc = $xmlDoc->getElementsByTagName('URL');
    $yc = $xc->item($index);

    $xd = $xmlDoc->getElementsByTagName('COUNTRY');
    $yd = $xd->item($index);

    $xe = $xmlDoc->getElementsByTagName('INFO');
    $ye = $xe->item($index);

    if (isset($_POST['reviewMessage'], $_POST['reviewRatings'])) {
        // Insert a new review (user submitted form)
        $stmt = $db->prepare("INSERT INTO product_reviews (product_id, user_id, user_review, user_rating, submit_date) VALUES (?,?,?,?,NOW())");
        $stmt->bind_param("sssi", $product_id, $user_id, $user_review, $user_rating);

        // set parameters and execute
        $product_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];
        $user_review = $_POST['reviewMessage'];
        $user_rating = $_POST['reviewRatings'];
        $stmt->execute();

        $stmt->close();
    }
} else {
    exit('Invalid page ID.');
}

// Reviews system + SQL (Jaron)
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime(null, new DateTimeZone('Asia/Singapore'));
    $ago = new DateTime($datetime, new DateTimeZone('Asia/Singapore'));
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

// $stmt->execute([$_GET['id']]);
// $reviews = $stmt->fetch(PDO::FETCH_ASSOC);
// // Get the overall rating and total amount of reviews
// $stmt = $pdo->prepare('SELECT AVG(rating) AS overall_rating, COUNT(*) AS total_reviews FROM reviews WHERE page_id = ?');
// $stmt->execute([$_GET['id']]);
// $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <link rel="icon" type="image/x-icon" href="/Goldfish/assets/img/favicon.ico" />
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
    <?php  ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-3">
                <h1 class="my-4">Categories</h1>
                <div class="list-group">
                    <a href="grocery_products.php" class="list-group-item <?php if ($category == "GR") echo "active"; ?>">
                        <h5>Groceries</h5>
                    </a>
                    <a href="health_products.php" class="list-group-item <?php if ($category == "HW") echo "active"; ?>">
                        <h5>Health & Wellcare</h5>
                    </a>
                    <a href="home_products.php" class="list-group-item <?php if ($category == "HL") echo "active"; ?>">
                        <h5>Home & Lifestyle</h5>
                    </a>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-8">

                <div class="card mt-4">
                    <img class="card-img-top img-fluid" src="<?php echo "{$yc->nodeValue}"; ?>" alt="">
                    <div class="card-body">
                        <hr />
                        <h3 class="card-title"><?php echo "{$ya->nodeValue}"; ?></h3>
                        <!-- <h4><i class="fab fa-bitcoin"></i> <?php echo "{$yb->nodeValue}"; ?> Points</h4> -->
                        <button type="button" id="" name="" class="button btn btn-primary ml-auto"><h5><i class="fab fa-bitcoin"></i> <?php echo "{$yb->nodeValue}"; ?> Points</h5></button>
                        <hr />
                        <p class="card-text"><b>Key Information:</b><br /> <?php echo "{$ye->nodeValue}"; ?></p>
                        <p class="card-text" style="margin-bottom: 0.5rem;"><b>Country of Origin:</b><br /> <?php echo "{$yd->nodeValue}"; ?></p>
                    </div>
                </div>
                <!-- /.card -->

                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Product Ratings
                    </div>
                    <span class="heading" style="margin-top: 1rem; margin-left: 1rem;">
                        <?php
                        $stmt = $db->prepare("SELECT AVG(user_rating) AS overall_rating, COUNT(*) AS total_reviews FROM product_reviews WHERE product_id = ?");
                        //print_r($db->error_list);
                        $stmt->bind_param("s", $page_id);

                        $page_id = $_GET['id'];
                        $stmt->execute();

                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $reviews = $result->fetch_assoc();
                            $checked = round($reviews["overall_rating"]);
                            for ($i = 0; $i < $checked; $i++) {
                                echo "<i class=\"fa fa-star checked\"></i>";
                            }

                            for ($j = 0; $j < 5 - $checked; $j++) {
                                echo "<i class=\"fa fa-star\"></i>";
                            }

                            echo "<p style=\"margin-top: 0.5rem; margin-bottom: 0.5rem;\">" . number_format($reviews["overall_rating"], 1) . " average based on " . $reviews["total_reviews"] . " reviews.</p>";
                        } else {
                            for ($k = 0; $k < 5; $k++) {
                                echo "<i class=\"fa fa-star\"></i>";
                            }
                            echo "<p>There is no review yet.</p><hr>";
                        }

                        $stmt->close();
                        ?>
                    </span>
                    <!-- <hr style="border:3px solid #f1f1f1">
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
                    </div> -->
                </div>

                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Product Reviews
                    </div>
                    <div class="card-body">
                        <?php
                        // Get all reviews by the Page ID ordered by the submit date
                        $stmt = $db->prepare("SELECT * FROM product_reviews WHERE product_id = ? ORDER BY submit_date DESC");
                        $stmt->bind_param("s", $page_id);

                        $page_id = $_GET['id'];
                        $stmt->execute();

                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while ($reviews = $result->fetch_assoc()) {
                                echo "<p>" . $reviews["user_review"] . "</p><small class=\"text-muted\">" . time_elapsed_string($reviews["submit_date"]) . "</small><hr>";
                            }
                        } else {
                            echo "<p>There is no review yet.</p><hr>";
                        }

                        $stmt->close();
                        ?>

                        <form method="post" action="products_info.php?id=<?php echo $_GET['id']; ?>" id="reviewForm" name="reviewForm" <?php if (!isset($_SESSION['user_id'])) {
                                                                                                                                            echo "style=\"display: none;\"";
                                                                                                                                        } ?>>
                            <textarea class="form-control" id="reviewMessage" name="reviewMessage" rows="3" placeholder="Message" required="required" data-validation-required-message="Please enter a message." style="margin-bottom: 0.5rem;"></textarea>
                            <span class="heading">
                                <input type="hidden" id="star1_hidden" value="1">
                                <i id="star1" onmouseover="toggle(this.id)" class="fa fa-star"></i>
                                <input type="hidden" id="star2_hidden" value="2">
                                <i id="star2" onmouseover="toggle(this.id)" class="fa fa-star"></i>
                                <input type="hidden" id="star3_hidden" value="3">
                                <i id="star3" onmouseover="toggle(this.id)" class="fa fa-star"></i>
                                <input type="hidden" id="star4_hidden" value="4">
                                <i id="star4" onmouseover="toggle(this.id)" class="fa fa-star"></i>
                                <input type="hidden" id="star5_hidden" value="5">
                                <i id="star5" onmouseover="toggle(this.id)" class="fa fa-star"></i>
                            </span>
                            <input type="hidden" name="reviewRatings" id="reviewRatings" value="0">
                            <p class="help-block text-danger" style="margin-bottom: 0.5rem;"></p>
                            <input type="submit" name="submit_btn" class="button btn btn-primary" id="submit_btn" value="Leave a Review" disabled />
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
    <script src="../js/scripts.js"></script>
    <script src="../js/product-scripts.js"></script>
</body>

</html>