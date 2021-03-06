<?php
if (dirname($_SERVER['PHP_SELF']) != "/Goldfish/registration") {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['msg'] = "You must log in first";
} else {
    $db = new mysqli('localhost', 'root', '', 'goldfish', '3308');

    if ($db->connect_errno) {
        die('Failed to connect to database!');
    }

    $stmt = $db->prepare("SELECT user_points FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);

    $user_id = $_SESSION['user_id'];
    $stmt->execute();
    $stmt->bind_result($result);
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    header("location: registration/login_page.php");
}

function checkReward()
{
    if (dirname($_SERVER['PHP_SELF']) == "/Goldfish/rewards") {
        echo "active";
    }
}

function checkProgram()
{
    if (dirname($_SERVER['PHP_SELF']) == "/Goldfish/programs") {
        echo "active";
    }
}

function checkLogin()
{
    switch ($_SERVER["SCRIPT_NAME"]) {
        case "/Goldfish/registration/login_page.php":
            echo "active";
            break;
        default:
            break;
    }
}

if(isset($_GET['search'])){
    $db = new mysqli('localhost', 'root', '', 'goldfish', '3308');

    if ($db->connect_errno) {
        die('Failed to connect to database!');
    }

    $stmt = $db->prepare("SELECT product_id FROM product_info WHERE product_name LIKE ? ");
    print_r($db->error_list);
    $stmt->bind_param("s", $search);

    $search = "%" . $_GET["search"] . "%";
    $stmt->execute();
    $stmt->bind_result($result);
    if ($stmt->fetch()) { 
        header("location: /Goldfish/rewards/products_info.php?id=$result");
    }
}
?>

<style>
    .dropdown-menu {
        border-radius: 0 0 0.5rem 0.5rem;
        margin-top: -0.5rem;
    }

    .dropdown-list {
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }
</style>

<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/Goldfish/main_page.php">Goldfish</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger <?php checkProgram(); ?>" href="/Goldfish/main_page.php #programs">Programmes</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger <?php checkReward(); ?>" href="/Goldfish/main_page.php  #rewards">Rewards</a></li>
                <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/Goldfish/main_page.php #about">About</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/Goldfish/main_page.php #contact">Contact</a></li> -->
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (dirname($_SERVER['PHP_SELF']) == "/Goldfish/rewards") : ?>
                    <form id="searchForm" name="searchForm" class="form-inline nav-item mx-0 mx-lg-1" style="margin-bottom: 0em;">
                        <input class="form-control ml-sm-2"  name="search" style="margin: 0rem 0rem; padding-right: 1rem;" type="search" placeholder="Search" aria-label="Search">
                        <button class="form-control ml-sm-2" type="submit" style="margin-left: 1rem;"><i class="fa fa-search"></i></button>
                    </form>
                <?php endif ?>

                <?php if (!isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger <?php checkLogin(); ?>" href="/Goldfish/registration/login_page.php"><i class="fas fa-user"></i> Login</a></li>
                <?php elseif (isset($_SESSION['user_id'])) : ?>
                    <li class="dropdown nav-item mx-0 mx-lg-1">
                        <a class="dropdown-toggle nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="dropdown" href="#"><i class="fas fa-user"></i> <?php echo $_SESSION['user_id'] ?><span class="caret"></span></a>
                        <ul class="dropdown-menu px-lg-4">
                            <li class="dropdown-list"><a href="#">Profile</a></li>
                            <li class="dropdown-list"> - Points: <?php if (isset($_SESSION['user_id'])) { if ($stmt->fetch()) { echo $result; } } ?></li>
                            <div class="dropdown-divider"></div>
                            <li class="dropdown-list"><a href="/Goldfish/registration/update_page.php">Update</a></li>
                            <div class="dropdown-divider"></div>
                            <li class="dropdown-list"><a href="/Goldfish/main_page.php?logout='1'">Logout</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="">Profile</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/Goldfish/main_page.php?logout='1'"><i class="fas fa-user"></i> Logout</a></li> -->
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>

<script>
$(document).ready(function () {
    $("#searchForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                alert("Successful");
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });
});
</script>