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
        case "AC":
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
// function time_elapsed_string($datetime, $full = false)
// {
//     $now = new DateTime(null, new DateTimeZone('Asia/Singapore'));
//     $ago = new DateTime($datetime, new DateTimeZone('Asia/Singapore'));
//     $diff = $now->diff($ago);
//     $diff->w = floor($diff->d / 7);
//     $diff->d -= $diff->w * 7;
//     $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
//     foreach ($string as $k => &$v) {
//         if ($diff->$k) {
//             $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
//         } else {
//             unset($string[$k]);
//         }
//     }
//     if (!$full) $string = array_slice($string, 0, 1);
//     return $string ? implode(', ', $string) . ' ago' : 'just now';
// }

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
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <!-- Additional CSS -->
    <link href="../css/program-styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <?php include '../utils/navbar.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-fluid" src="http://placehold.it/750x500" alt="">
            </div>

            <div class="col-md-4">
                <h3 class="my-3">Project Description</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
                <h3 class="my-3">Project Details</h3>
                <ul>
                    <li>Lorem Ipsum</li>
                    <li>Dolor Sit Amet</li>
                    <li>Consectetur</li>
                    <li>Adipiscing Elit</li>
                </ul>
            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <h3 class="my-4">Related Projects</h3>

        <div class="row">

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="#">
                    <img class="img-fluid" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="#">
                    <img class="img-fluid" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="#">
                    <img class="img-fluid" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="#">
                    <img class="img-fluid" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

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
</body>

</html>