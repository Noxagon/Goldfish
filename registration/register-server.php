<?php
session_start();

// initializing variables
$nric = "";
$errors = array(); 
$messages = array();

// connect to the database
//$db = mysqli_connect('localhost', 'root', '', 'registration', '3308');
$db = mysqli_connect('localhost', 'root', '', 'goldfish', '3308');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $nric = strtoupper(mysqli_real_escape_string($db, $_POST['inputNRICFIN']));
  $password_1 = mysqli_real_escape_string($db, $_POST['inputPassword']);
  $password_2 = mysqli_real_escape_string($db, $_POST['inputConfirmPassword']);

  // form validation: ensure that the form is correctly filled by adding (array_push()) corresponding error unto $errors array
  if (empty($nric)) { array_push($errors, "NRIC/FIN is required!"); }
  if (strlen($nric) != 9) { array_push($errors, "Invalid NRIC/FIN format!"); }
  if (empty($password_1)) { array_push($errors, "Password is required!"); }
  if (strlen($password_1) < 8) { array_push($errors, "Password must be at least 8 characters long!"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Both passwords do not match!");
  }

  // first check the database to make sure a user does not already exist with the same nric
  $user_check_query = "SELECT * FROM users WHERE user_id='$nric' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['user_id'] === $nric) {
      array_push($errors, "User already exists!");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (user_id, user_password) 
  			  VALUES('$nric', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['user_id'] = $nric;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: ../main_page.php');
  }
}

if (isset($_POST['login_user'])) {
  $nric = strtoupper(mysqli_real_escape_string($db, $_POST['inputNRICFIN']));
  $password = mysqli_real_escape_string($db, $_POST['inputPassword']);

  if (empty($nric)) { array_push($errors, "Username is required"); }
  if (strlen($nric) != 9) { array_push($errors, "Invalid NRIC/FIN format!"); }
  if (empty($password)) {	array_push($errors, "Password is required"); }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE user_id='$nric' AND user_password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['user_id'] = $nric;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: ../main_page.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

if (isset($_POST['update_user'])) {
  // receive all input values from the form
  $password_old = mysqli_real_escape_string($db, $_POST['inputOldPassword']);
  $password_new = mysqli_real_escape_string($db, $_POST['inputNewPassword']);
  $password_cfm = mysqli_real_escape_string($db, $_POST['inputConfirmPassword']);

  // form validation: ensure that the form is correctly filled by adding (array_push()) corresponding error unto $errors array
  if (empty($password_old)) { array_push($errors, "Old Password is required!"); }
  if (empty($password_new)) { array_push($errors, "New Password is required!"); }
  if (strlen($password_new) < 8) { array_push($errors, "Password must be at least 8 characters long!"); }
  if ($password_new != $password_cfm) { array_push($errors, "Both passwords do not match!"); }

  // first check the database to make sure a user does not already exist with the same nric
  $nric = $_SESSION['user_id'];
  $user_check_query = "SELECT * FROM users WHERE user_id='$nric' ";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $password_chk = md5($password_old);
  
  if ($user) { // if user exists
    if ($user['user_id'] === $nric) {
      //array_push($errors, "User already exists!");
      if ($user['user_password'] != $password_chk) {
        array_push($errors, "Password does not match!");
      }

      if (count($errors) == 0) {
        $password = md5($password_new);//encrypt the password before saving in the database
    
        $query = "UPDATE users SET user_password='$password' WHERE user_id='$nric' ";
        mysqli_query($db, $query);
        $_SESSION['user_id'] = $nric;
        $_SESSION['success'] = "You are now logged in";
        array_push($messages, "Password updated!");
        //header('location: ../main_page.php');
      }
    }
  }
}
