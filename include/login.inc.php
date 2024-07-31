<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email =$_POST["email"];
  $pwd =$_POST["pwd"];

  try {
   require_once 'dbh.inc.php';
   require_once 'login_model.inc.php';
   require_once 'login_contr.inc.php';

 //ERROR HANDLERS
 $errors =[];

      if (is_input_empty( $email,$pwd )){
        $errors["empty_input"]="Fill in all fields";
      }
    
      $result =get_user($pdo, $email);

      if (is_email_wrong($result)) {
        $errors["login_incorrect"] ="Incorrect login info";
      }
      if (is_email_wrong($result)&& is_password_wrong($pwd, $result["pwd"])) {
        $errors["login_incorrect"] ="Incorrect login info";
      }

      require_once 'config_session.inc.php';

      if($errors) {
        $_SESSION ["errors_signin"] = $errors;
        header("Location: ../accounts.php");
        die();
      }

      $newSessionId = session_create_id();
      $sessionId = $newSessionId . "_".$result["id"];
      session_id($sessionId);

      $_SESSION["user_id"] =$result["id"];
      $_SESSION["user_email"] =$result["email"];

      $_SESSION["last_regeneration"] =time();
      header("Location: ../product2 check.html");

      $pdo =null;
      $stmt=null;
      die();

  }catch (PDOException $e) {
    die("Query failed:" .$e->getMessage());
  }

} else {
  header("Location: ../accounts.php");
  die();
}