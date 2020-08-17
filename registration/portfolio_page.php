<?php include('register-server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Goldfish - Portfolio</title>
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
    <link href="portfolio-styles.css" rel="stylesheet" />

</head>

<body id="page-top" class="bg-primary" onload="checkCookie()">
    <!-- Navigation-->
    <?php include "../utils/navbar.php"; ?>

    <!-- Page Content -->
    <div class="container">
        <!-- Portfolio Section Heading-->
        <h1 class="page-section-heading text-center text-uppercase text-white mt-5 mb-0">Our Company</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4 h-100">
                <div class="card border-0 shadow">
                    <div class="row">
                        <div class="col-7 align-self-center text-center">
                        <h1 class="text-uppercase text-secondary">Goldfish</h1>
                        <hr/>
                            <h4 class=" text-uppercase text-secondary">
                                We are a group of students from Singapore Polytechnic, studying in the Diploma in Electrical,Electronic,Engineering. Our goal here is to develop a website to help the elderly to lead active and dignified lives in the silver years.
                            </h4>
                        </div>
                        <div class="col-5">
                        <img src="/Goldfish/assets/img/goldfish/goldfish.png" class="card-img-top" alt="..." style="padding: 1rem; height: 450px; object-fit: scale-down;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Section Heading-->
        <h1 class="page-section-heading text-center text-uppercase text-white mt-5 mb-0">Location</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4 h-100">
                <div class="card border-0 shadow">
                    <div class="row">
                        <div class="col-lg-7 ml-auto">
                            <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAJzn_eurY-R1yVXDbYer5ukJvSnYVYPBY&q=500 Dover Rd, Singapore 139651" allowfullscreen></iframe>
                        </div>
                        <div class="col-lg-5 ml-auto align-self-center">
                            <h2 class="text-uppercase text-secondary">Address: </h2>
                            <h4 class=" text-uppercase text-secondary">
                                500 Dover Road, <br />
                                Singapore 139651.
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Section Heading-->
        <h1 class="page-section-heading text-center text-uppercase text-white mt-5 mb-0">About Us</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row">
            <!-- Team Member 1 -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="row">
                        <div class="col-5" style="padding-right: 0rem;">
                            <img src="/Goldfish/assets/img/portfolio/jaron.jpeg" class="card-img-top" alt="...">
                        </div>
                        <div class="col-7 text-center" style="padding-left: 0rem;">
                            <h5 class="text-uppercase text-secondary card-title mt-3 mb-0">Jaron Lee Jin-An</h5>
                            <h6 class="card-text text-black-50">P1844232</h6>
                            <hr />
                            <div class="card-text-2 text-black-50">
                                <ul>
                                    <li>Student</li>
                                    <li>Web Developer</li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="row">
                        <div class="col-5" style="padding-right: 0rem;">
                            <img src="/Goldfish/assets/img/portfolio/ben.jpeg" class="card-img-top" alt="...">
                        </div>
                        <div class="col-7 text-center" style="padding-left: 0rem;">
                            <h5 class="text-uppercase text-secondary card-title mt-3 mb-0">Lim Jun Ming Benjamin</h5>
                            <h6 class="card-text text-black-50">P1822814</h6>
                            <hr />
                            <div class="card-text-2 text-black-50">
                                <ul>
                                    <li>Student</li>
                                    <li>Web Developer</li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="row">
                        <div class="col-7 text-center" style="padding-right: 0rem;">
                            <h5 class="text-uppercase text-secondary card-title mt-3 mb-0">Chiok Yong Jie</h5>
                            <h6 class="card-text text-black-50">P1836419</h6>
                            <hr />
                            <div class="card-text-2 text-black-50">
                                <ul>
                                    <li>Student</li>
                                    <li>Web Developer</li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-5" style="padding-left: 0rem;">
                            <img src="/Goldfish/assets/img/portfolio/cyj.jpeg" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Member 4 -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="row">
                        <div class="col-7 text-center" style="padding-right: 0rem;">
                            <h5 class="text-uppercase text-secondary card-title mt-3 mb-0">Kong Tai Long</h5>
                            <h6 class="card-text text-black-50">P1820276</h6>
                            <hr />
                            <div class="card-text-2 text-black-50">
                                <ul>
                                    <li>Student</li>
                                    <li>Web Developer</li>
                                    <li>Goals & Motivation: To Be Able To Learn Coding.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-5" style="padding-left: 0rem;">
                            <img src="/Goldfish/assets/img/portfolio/ktl.jpeg" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- AIzaSyAJzn_eurY-R1yVXDbYer5ukJvSnYVYPBY -->
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
    <script src="../js/login-scripts.js"></script>
</body>

</html>