<?php
declare(strict_types=1);

function check_login_errors() {
  if(isset($_SESSION ["errors_signin"])) {
    $errors =$_SESSION ["errors_signin"];
    $output = '';

    foreach ($errors as $error) {
        $output .= '<p class="form-error">' . htmlspecialchars($error) . '</p>';
    }

    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const errorsDiv = document.getElementById("errors-div");
            if (errorsDiv) {
                errorsDiv.innerHTML = ' . json_encode($output) . ';
            }
        });
    </script>';

    unset($_SESSION['errors_signin']);
} elseif (isset($_GET["signin"]) && $_GET["signin"] === "success") {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const errorsDiv = document.getElementById("errors-div");
            if (errorsDiv) {
                errorsDiv.innerHTML = "<p class=\"form-success\">login success!</p>";
            }
        });
    </script>';
}
}