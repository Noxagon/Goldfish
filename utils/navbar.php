<?php
if (!dirname($_SERVER['PHP_SELF']) == "/Goldfish/registration") {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['msg'] = "You must log in first";
    //header('location: registration/login_page.php');
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
                    <form class="form-inline nav-item mx-0 mx-lg-1" style="margin-bottom: 0em;">
                        <input class="form-control ml-sm-2" style="margin: 0rem 0rem;" type="search" placeholder="Search" aria-label="Search">
                    </form>
                <?php endif ?>

                <?php if (!isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger <?php checkLogin(); ?>" href="/Goldfish/registration/login_page.php"><i class="fas fa-user"></i> Login</a></li>
                <?php elseif (isset($_SESSION['user_id'])) : ?>
                    <li class="dropdown nav-item mx-0 mx-lg-1">
                        <a class="dropdown-toggle nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="dropdown" href="#"><i class="fas fa-user"></i> <?php echo $_SESSION['user_id'] ?><span class="caret"></span></a>
                        <ul class="dropdown-menu px-lg-4">
                            <li class="dropdown-list"><a href="#">Profile</a></li>
                            <li class="dropdown-list"> - Points: </li>
                            <li class="divider"></li>
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