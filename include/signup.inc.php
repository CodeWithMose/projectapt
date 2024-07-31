<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
  $username =$_POST["username"];
  $email =$_POST["email"];
  $phone =$_POST["phone"];
  $location =$_POST["location"];
  $pwd =$_POST["pwd"];

  try {
    require_once 'dbh.inc.php';
    require_once 'signup_model.inc.php';
    require_once 'signup_contr.inc.php';

    //ERROR HANDLERS
    $errors =[];

    if (is_input_empty($username, $email, $phone,$location,$pwd )){
      $errors["empty_input"]="Fill in all fields";
    }
    if (is_email_invalid($email)){
      $errors["invalid_email"]="invalid email";
    }
    if (is_username_taken($pdo, $username)){
      $errors["username_taken"]="Username already taken";
    }
    if (is_email_registered($pdo,$username)){
      $errors["email_used"]="Email already registered!";
    }

    require_once 'config_session.inc.php';

    if($errors) {
      $_SESSION ["errors_signup"] = $errors;
      header("Location: ../accounts.php");
      die();
    }

    create_user($pdo, $username, $email, $phone,  $location, $pwd);

    header("Location: ../accounts.php?signup=success");

    $pdo = null;
    $stmt = null;

    die();

  }catch (PDOException $e) {
    die("Query failed:" .$e->getMessage());
  }
} else {
  header("Location: ../accounts.php");
  die();
}