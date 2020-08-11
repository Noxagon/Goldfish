<?php
    switch ($_SERVER["SCRIPT_NAME"]) {
        case "/Goldfish/registration/login_page.php":
            break;
        case "/Goldfish/registration/register_page.php":
            break;
        default:
            session_start(); 
            break;
    }

    if (!isset($_SESSION['nric'])) {
        $_SESSION['msg'] = "You must log in first";
        //header('location: registration/login_page.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['nric']);
        header("location: registration/login_page.php");
    }

    function checkReward() {
        switch ($_SERVER["SCRIPT_NAME"]) {
            case "/Goldfish/rewards/grocery_products.php":
                echo "active";
                break;
            case "/Goldfish/rewards/health_products.php":
                echo "active";
                break;
            case "/Goldfish/rewards/home_products.php":
                echo "active";
                break;
            default:
                break;
        }
    }

    function checkLogin() {
        switch ($_SERVER["SCRIPT_NAME"]) {
            case "/Goldfish/registration/login_page.php":
                echo "active";
                break;
            default:
                break;
        }
    }
?>

<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/Goldfish/main_page.php">Goldfish</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/Goldfish/main_page.php #programs">Programmes</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger <?php checkReward(); ?>" href="/Goldfish/main_page.php  #rewards">Rewards</a></li>
                <!-- <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/Goldfish/main_page.php #about">About</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/Goldfish/main_page.php #contact">Contact</a></li> -->
                <?php if(!isset($_SESSION['nric'])) : ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/Goldfish/registration/login_page.php"><i class="fas fa-user"></i> Login</a></li>
                <?php elseif(isset($_SESSION['nric'])): ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="">Profile</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="main_page.php?logout='1'"><i class="fas fa-user"></i> Logout</a></li>
                <?php endif ?>
            </ul>
        </div>
        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger text-white" href="#contact"></a>
    </div>
</nav>

<!-- Old nav -->
<!-- <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="main_page.html">Goldfish</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#programs">Programmes</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger active" href="#rewards">Rewards</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">About</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav> -->