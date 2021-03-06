<?php
include '../utils/navbar.php';

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
            $json = file_get_contents("../json/art_craft.json"); //convert into iterator
            break;
        case "CK":
            $json = file_get_contents("../json/cooking.json");
            break;
        case "GM":
            $json = file_get_contents("../json/games.json");
            break;
        case "MD":
            $json = file_get_contents("../json/music_dance.json");
            break;
        case "SP":
            $json = file_get_contents("../json/sport.json");
            break;
        case "WS":
            $json = file_get_contents("../json/workshop.json");
            break;
    }

    // $data = json_decode($json, true); 
    // echo $data[0]["id"];

    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($json, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($jsonIterator as $key => $val) {
        if (is_array($val)) {
            if ($key == $index) {
                $prog_id = $val["id"];
                $name = $val["type"];
                $description = $val["description"];
                $point = $val["point"];
                $price = $val["price"];
                $date_start = $val["datestart"];
                $date_end = $val["dateend"];
                $time_start = $val["timestart"];
                $time_end = $val["timeend"];
                $location = $val["location"];
                $url = $val["url"];
            } else {
                $images[$key] = $val["url"];
                $code[$key] = $val["id"];
            }
        }
    }
}

if (isset($_POST['status'])) {
    $stmt = $db->prepare("INSERT INTO program_members (program_id, user_id) VALUES (?,?)");
    $stmt->bind_param("ss", $program_id, $user_id);

    // set parameters and execute
    $program_id = $prog_id;
    $user_id = $_SESSION['user_id'];
    $stmt->execute();

    $stmt2 = $db->prepare("UPDATE users SET user_points = ? WHERE user_id = ?");
    $stmt2->bind_param("ss", $program_points, $user_id);

    $program_points = $point;
    $user_id = $_SESSION['user_id'];
    $stmt2->execute();

    $stmt->close();
    $stmt2->close();
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
    <link href="../css/program-styles.css" rel="stylesheet" />
</head>

<body id="page-top">

    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <h1 class="my-4"><?php echo $name ?>
            <!-- <small>Secondary Text</small> -->
        </h1>

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-6" style="margin-top: auto; margin-bottom: auto;">
                <img class="card-img-top" src="<?php echo $url; ?>" alt="">
                <?php if ($price > 0) : ?>
                    <div id="paypal-button-container" class="mt-5"></div>
                    <script src="https://www.paypal.com/sdk/js?client-id=AQ-gIccUkYgzY1gR2lxa-Fijjis24pM_-ky7w5LnX9j1IzifV64yBhlQNQ73rZ6JbOaUx_5FVGqtT-pw&currency=SGD" data-sdk-integration-source="button-factory"></script>
                    <script>
                        var amt = "<?php echo $price; ?>";

                        paypal.Buttons({
                            style: {
                                shape: 'pill',
                                color: 'gold',
                                layout: 'vertical',
                                label: 'paypal',

                            },
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: amt,
                                            currency: "SGD"
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(details) {
                                    $.post( $(this).attr('action'), { status: "approved" } );
                                });
                            }
                        }).render('#paypal-button-container');
                    </script>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <h6><?php echo $description; ?></h6>
                <h3 class="my-1 mt-4"><u>Schedule</u></h3>
                <h5><?php echo $date_start; ?> - <?php echo $date_end; ?> (<?php echo $time_start; ?> - <?php echo $time_end; ?>)</h5>

                <h3 class="my-1 mt-4"><u>Location</u></h3>
                <h5><?php echo $location; ?>

                    <?php if ($price > 0) : ?>
                        <h3 class="my-1 mt-4"><u>Price</u></h3>
                        <h5>SGD <?php echo $price; ?>
                        <?php endif; ?>

                        <!-- <button type="button" id="" name="" class="button btn btn-primary ml-auto"><h5><i class="fab fa-bitcoin"></i> <?php echo $point; ?> Points</h5></button> -->
            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <h3 class="my-4">Related Projects</h3>

        <div class="row">

            <?php if (isset($images[0])) : ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="programs_info.php?id=<?php echo $code[0]; ?>">
                        <img class="img-fluid" src="<?php echo $images[0]; ?>" alt="">
                    </a>
                </div>
            <?php endif; ?>

            <?php if (isset($images[1])) : ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="programs_info.php?id=<?php echo $code[1]; ?>">
                        <img class="img-fluid" src="<?php echo $images[1]; ?>" alt="">
                    </a>
                </div>
            <?php endif; ?>

            <?php if (isset($images[2])) : ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="programs_info.php?id=<?php echo $code[2]; ?>">
                        <img class="img-fluid" src="<?php echo $images[2]; ?>" alt="">
                    </a>
                </div>
            <?php endif; ?>

            <?php if (isset($images[3])) : ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="programs_info.php?id=<?php echo $code[3]; ?>">
                        <img class="img-fluid" src="<?php echo $images[3]; ?>" alt="">
                    </a>
                </div>
            <?php endif; ?>

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